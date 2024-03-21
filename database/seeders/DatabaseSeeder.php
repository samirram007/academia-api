<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\EducationBoard;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Country::create([
            'country_code' => 'IN',
            'name'         => 'INDIA',
        ]);
        \App\Models\State::create([
            'state_code' => 'WB',
            'name'         => 'WEST BENGAL',
            'country_id'   => 1,
        ]);
        \App\Models\Address::create([
            'address_line_1'=> fake()->streetAddress,
            'address_type'=>'permanent',
            'state_id'=>1,
            'country_id'   => 1,
        ]);
         \App\Models\SchoolType::create([
            'name' => 'HINDI MEDIUM',]);
            \App\Models\EducationBoard::create([
                'name' => 'Test Board',

            ]);
         \App\Models\School::create([
            'name' => 'Test School',
            'school_type_id' => 1,
            'education_board_id'=>1
        ]);
        \App\Models\Campus::create([
            'name' => 'Test Campus',
            'school_id' => 1,
            'education_board_id'=>1
        ]);
        \App\Models\AcademicYear::create([
            'year' => '2023-2024',
            'start_date'=>'2023-01-01',
            'end_date'=>'2024-12-31',
            'campus_id'=>1,
        ]);

        $this->call([
            UserSeeder::class,
        ]);
    }
}
