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

class AuthCheckEmail implements Rule
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
            return Auth::user()->email == $value;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O campo email precisa ser igual ao usuario logado';
    }
}