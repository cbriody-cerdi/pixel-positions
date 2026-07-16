<x-layout>
    <x-page-heading>My Details</x-page-heading>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-400/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
            {{ session('success') }}
        </div>
    @endif


    <x-forms.form method="POST" action="/profile" enctype="multipart/form-data">
        @method('PATCH')

        <x-forms.input label="Name" name="name" :value="$user->name"/>
        <x-forms.input label="Email" name="email" type="email" :value="$user->email"/>
        <x-forms.input label="New Password" name="password" type="password"/>
        <x-forms.input label="Confirm Password" name="password_confirmation" type="password"/>

        <x-forms.button>Save Changes</x-forms.button>
    </x-forms.form>
</x-layout>
