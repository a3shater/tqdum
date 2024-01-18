<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        $admin = \App\Models\User::factory()->create([
            'name' => 'Ahmed Ali',
            'email' => 'ahmed@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        Role::insert([['name' => 'admin'], ['name' => 'interviewer'], ['name' => 'reviewer'], ['name' => 'applicant']]);
        $admin->assignRole('admin');
        \App\Models\Status::insert([['name' => 'new'], ['name' => 'review'], ['name' => 'exam'], ['name' => 'interview'], ['name' => 'except']]);
        // $this->call(ApplicantSeeder::class);
        // $this->call(FaqSeeder::class);
        // $this->call(ProgramSeeder::class);
        // $this->call(StatusSeeder::class);
        // $this->call(ApplicationSeeder::class);
        // $this->call(InterviewerSeeder::class);
        // $this->call(InterviewSeeder::class);
        // $this->call(InterviewResultSeeder::class);
        // $this->call(ReviewerSeeder::class);
        // $this->call(ReviewSeeder::class);
        // $this->call(ExamSeeder::class);
        // $this->call(ExamResultSeeder::class);
        // $this->call(CriteriaSeeder::class);
    }
}
