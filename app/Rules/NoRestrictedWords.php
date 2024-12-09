<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoRestrictedWords implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $restrictedWords = ['f***', 's***', 'a****', 'b***', 'test'];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach($this->restrictedWords as $word){
            if(stripos($value, $word) !== false){
                $fail("Câmpul {$attribute} conține cuvinte interzise.");
                return;
            }
        }
    } 

    public function message()
    {
        return 'Câmpul conține cuvinte interzise!';
    }
}
