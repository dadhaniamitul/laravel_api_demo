<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BathroomValidator implements Rule
{
    private $realEstateType = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($realEstateType)
    {
        $this->realEstateType = $realEstateType;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!is_numeric($value))
            return true;

        if(!in_array($this->realEstateType, array('land','commercial_ground')) && $value < 1)
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be greater than 0';
    }
}
