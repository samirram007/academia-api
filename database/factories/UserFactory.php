<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            // 'username'=>fake()->unique()->text(),
            'user_type'=>fake()->randomElement(\App\Enums\UserTypeEnum::cases()),
            'contact_no' => fake()->numerify('##########') ,
            'status'=>\App\Enums\UserStatusEnum::ACTIVE,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'gender'=>fake()->randomElement([\App\Enums\GenderEnum::MALE,\App\Enums\GenderEnum::FEMALE,]),
            'emergency_contact_name'=>fake()->name(),
            'emergency_contact_no'=>fake()->numerify('##########') ,
            'birth_mark'=>fake()->word(),
            'medical_conditions'=>fake()->word(),
            'allergies'=>fake()->word(),
            'nationality'=>fake()->randomElement([\App\Enums\NationalityEnum::INDIAN]),
            'language'=>fake()->randomElement(\App\Enums\LanguageEnum::cases()),
            'guardian_type'=>fake()->randomElement(\App\Enums\GuardianTypeEnum::cases()),
            'address_id'=>fake()->randomElement([\App\Models\Address::first()]),
            'designation_id'=>fake()->randomElement([\App\Models\Designation::first()]),
            'department_id'=>fake()->randomElement([\App\Models\Department::first()]),
            'gender'=>fake()->randomElement(\App\Enums\GenderEnum::cases()),
            'doj'=>fake()->date(),
            'dob'=>fake()->date(),
            'aadhaar_no'=>fake()->word(15),
            'pan_no'=>fake()->word(15),
            'passport_no'=>fake()->word(15),
            'profile_document_id'=>fake()->randomElement([\App\Models\Document::first()]),
            'bank_name'=>fake()->word(15),
            'account_holder_name'=>fake()->word(15),
            'bank_ifsc'=>fake()->word(10),
            'bank_branch'=>fake()->word(15),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
