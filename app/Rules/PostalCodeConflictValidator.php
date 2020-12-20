<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\SalesManInfo;

class PostalCodeConflictValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if(str_contains($value, '*'))
        {
            // checking for *postal code block is free
            $f_var = explode("*", $value);
            $salesManInfo = SalesManInfo::where('postalCode', 'like', $f_var[0].'%')->get();

            if(count($salesManInfo) > 0)
            {   
                return false;
            }
        } 
        else {

            // checking for existing postal code
            $salesManInfo = SalesManInfo::where('postalCode', $value)->get();
        
            if(count($salesManInfo) > 0)
            {
                return false;
            }

            // checking for *expression postal code
            $salesManInfoWithRange = SalesManInfo::where('postalCode', 'like', '%*%')->get();

            foreach($salesManInfoWithRange as $info)
            {
                $i_var = explode("*", $info->postalCode);
                $i_var2 = $i_var[0];
                $sNumber = str_pad($i_var2,  5, "0"); 
                $eNumber = str_pad($i_var2,  5, "9"); 
                
                if(($sNumber <= $value) && ($value <= $eNumber))
                {
                    return false;
                }
            }

        }

        return true;
       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute is conflicted by another salesman!';
    }
}
