<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class VerifyPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected string $password;
    public function __construct(string $value)
    {
        $this->password = $value;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        return Hash::check($value, $this->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()  : string
    {
        return 'رمز عبور فعلی اشتباه است';
    }
}
