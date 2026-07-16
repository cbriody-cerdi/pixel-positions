<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;
    use Illuminate\Validation\Rules\Password;

    class UserController extends Controller
    {
        public function edit()
        {
            return view('user.edit', ['user' => auth()->user()]);
        }

        public function update(Request $request)
        {
            $user = auth()->user();

            $attributes = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
                'password' => ['nullable', 'confirmed', Password::min(6)],
            ]);

            if (empty($attributes['password'])) {
                unset($attributes['password']);
            }

            $user->update($attributes);

            return redirect('/profile/edit')->with('success', 'Profile updated.');
        }
    }
