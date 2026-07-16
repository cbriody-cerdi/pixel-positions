
<x-layout>
    <x-page-heading>Edit Job</x-page-heading>

    <x-forms.form method="POST" :action="'/jobs/' . $job->id">
        @method('PATCH')

        <x-forms.input label="Title" name="title" :value="old('title', $job->title)" />
        <x-forms.input label="Salary" name="salary" :value="old('salary', $job->salary)" />
        <x-forms.input label="Location" name="location" :value="old('location', $job->location)" />

        <x-forms.select label="Schedule" name="schedule">
            <option value="Part Time" @selected(old('schedule', $job->schedule) === 'Part Time')>Part Time</option>
            <option value="Full Time" @selected(old('schedule', $job->schedule) === 'Full Time')>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" :value="old('url', $job->url)" />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" :checked="old('featured', $job->featured)" />

        <x-forms.divider />

        <x-forms.input
            label="Tags (comma separated)"
            name="tags"
            :value="old('tags', $job->tags->pluck('name')->implode(', '))"
            placeholder="laravel, php, remote"
        />

        <div class="flex items-center gap-4">
            <x-forms.button>Save Changes</x-forms.button>
            <a href="/" class="text-sm text-white/70 hover:text-white">Cancel</a>
        </div>
    </x-forms.form>
</x-layout>
