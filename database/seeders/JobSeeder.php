<?php

    namespace Database\Seeders;

    use App\Models\Job;
    use App\Models\Tag;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Database\Eloquent\Factories\Sequence;

    class JobSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $tags = Tag::factory(20)->create();

            Job::factory(200)->create(new Sequence([
                'featured' => false,
                'schedule' => 'Full time',
            ], [
                'featured' => true,
                'schedule' => 'Part time',
            ]))->each(fn (Job $job) => $job->tags()->attach($tags->random(3)));

        }
    }
