<?php

    namespace Database\Factories;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
     */
    class EmployerFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'name' => fake()->company(),
                'logo' => 'https://picsum.photos/seed/' . fake()->unique()->slug() . '/640/480',
                'user_id' => User::factory(),
            ];
        }
    }
