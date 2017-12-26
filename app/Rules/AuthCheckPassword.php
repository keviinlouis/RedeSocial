<?php
/**
 * Created by PhpStorm.
 * User: alebark
 * Date: 23/12/17
 * Time: 13:33
 */

namespace App\Rules;


use Auth;
use Illuminate\Contracts\Validation\Rule;

class AuthCheckPassword implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(Auth::check()){
            return Auth::user()->getAuthPassword() == bcrypt($value);
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O campo password precisa ser igual ao usuario logado';
    }
}