<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;

class ExistingUser implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $loginType = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (!User::where($loginType, $value)->exists()) {
            $fail('El usuario o email no se encuentra registrado.');
        }

    }


}
