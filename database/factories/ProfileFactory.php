<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;
    public function definition(): array
    {
        $dni = $this->faker->unique()->optional($weight = 0.9)->numerify('##########');
        $passport = is_null($dni) ? $this->faker->unique()->numerify('##########') : null;


        return [
            'dni' => $dni,
            'passport' =>$passport,
            'phone_user' => $this->faker->phoneNumber,
            'tel_user' => $this->faker->numerify('#######'),
            'address' => $this->faker->address,
            'birthday' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'job_title' => $this->faker->jobTitle,
            'tel_job' => $this->faker->numerify('########'),
            'user_id' =>  function() {
                $domains = [
                    'gmail.com','yahoo.com','outlook.com','hotmail.com',
                    'aol.com','msn.com','live.com','icloud.com','mail.com'
                ];
                $domain = $this->faker->randomElement($domains);
                return User::create([
                    'username' => $this->faker->unique()->userName,
                    'full_name' => $this->faker->firstName." ". $this->faker->lastName,
                    'role_id' => $this->faker->numberBetween(1, 4),
                    'email' => $this->faker->unique()->userName .'@' . $domain,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'remember_token' => Str::random(10),
                ])->id;
            },
        ];
    }

}
