<x-layout>
    <x-page-heading>Edit Profile</x-page-heading>

    <x-forms.form method="POST" action="/profile" enctype="multipart/form-data">
        @method('PATCH')
        <x-forms.input label="Name" name="name" :value="$user->name" />
        <x-forms.input label="Email" name="email" type="email" :value="$user->email" />
        <x-forms.input label="Password" name="password" type="password" />
        <x-forms.input label="Password Confirmation" name="password_confirmation" type="password" />

        <x-forms.divider />

        <x-forms.input label="Employer Name" name="employer" :value="$user->employer" />
        <x-forms.input label="Employer Logo" name="logo" type="file" class="file-upload"/>

        <x-forms.button>Update Profile</x-forms.button>
    </x-forms.form>
</x-layout>
