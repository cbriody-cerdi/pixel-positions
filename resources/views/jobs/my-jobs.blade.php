<x-layout>
    <x-page-heading>My Jobs</x-page-heading>

    @if ($jobs->isEmpty() && request()->page <= 1)
        <div class="mt-6 text-center text-white/50">
            <p>You haven't posted any jobs yet.</p>
            <a href="/jobs/create" class="mt-4 inline-block text-white hover:text-white/70">Post a job</a>
        </div>
    @else

        <div class="mt-8">
            {{ $jobs->links() }}
        </div>

        <div class="mt-6 space-y-6">
            @foreach ($jobs as $job)
                <x-job-card-wide :$job/>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $jobs->links() }}
        </div>
    @endif
</x-layout>
