<x-layout>
    <x-page-heading>Jobs</x-page-heading>

    <div class="mt-8">
        {{ $jobs->links() }}
    </div>

    <div class="space-y-6 mt-8">
        @foreach($jobs as $job)
            <x-job-card-wide :$job />
        @endforeach
    </div>

    <div class="mt-8">
        {{ $jobs->links() }}
    </div>

</x-layout>
