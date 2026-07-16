<?php

    namespace App\Http\Controllers;

    use App\Models\Job;
    use App\Models\Tag;
    use Illuminate\Http\Request;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Gate;
    use Illuminate\Validation\Rule;
    use Illuminate\Http\RedirectResponse;


    class JobController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $grouped = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

            $jobs = Job::latest()
                ->with(['employer', 'tags'])
                ->where('featured', false)
                ->paginate(25);

            return view('jobs.index', [
                'jobs' => $jobs,
                'featuredJobs' => collect($grouped[1] ?? [])->take(6),
                'tags' => Tag::all(),
            ]);
        }

        public function list()
        {
            $jobs = Job::query()
                ->latest()
                ->with(['employer', 'tags'])
                ->paginate(25)
                ->withQueryString();

            return view('jobs.list', [
                'jobs' => $jobs,
            ]);
        }


        public function myJobs()
        {
            $jobs = auth()->user()->employer->jobs()
                ->latest()
                ->with(['tags'])
                ->paginate(25);

            return view('jobs.my-jobs', [
                'jobs' => $jobs,
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('jobs.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $attributes = $request->validate([
                'title' => ['required'],
                'salary' => ['required'],
                'location' => ['required'],
                'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
                'url' => ['required', 'active_url'],
                'tags' => ['nullable'],
            ]);



            $attributes['featured'] = $request->has('featured');

            $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

            if ($attributes['tags'] ?? false) {
                foreach (explode(',', $attributes['tags']) as $tag) {
                    $job->tag($tag);
                }
            }

            return redirect('/');
        }


        public function edit(Job $job)
        {

            Gate::authorize('update', $job);

            return view('jobs.edit', ['job' => $job]);

        }


        public function update(Request $request, Job $job): \Illuminate\Http\RedirectResponse
        {
            Gate::authorize('update', $job);

            $attributes = $request->validate([
                'title' => ['required'],
                'salary' => ['required'],
                'location' => ['required'],
                'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
                'url' => ['required', 'active_url'],
                'tags' => ['nullable', 'string'],
            ]);

            $attributes['featured'] = $request->has('featured');

            // Update only job columns, not the tags input string.
            $job->update(Arr::except($attributes, 'tags'));

            // Parse comma-separated tags, normalize, dedupe, create missing tags, then sync.
            $tagIds = collect(explode(',', (string) ($attributes['tags'] ?? '')))
                ->map(fn (string $tag): string => strtolower(trim($tag)))
                ->filter(fn (string $tag): bool => $tag !== '')
                ->unique()
                ->map(fn (string $tag): int => Tag::firstOrCreate(['name' => $tag])->id)
                ->values()
                ->all();

            $job->tags()->sync($tagIds);

            return redirect('/')->with('success', 'Job updated successfully.');
        }


        public function destroy(Job $job){
            Gate::authorize('delete', $job);
        }






    }
