<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ResiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->hasRole("landlord"))
        {
            return true;
        }
        else{
            return false;
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            // regex for postcode
            'postcode' => array(
                'required', 
                'Regex:#^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$#i'
                ),
            'image' => array(
                    'mimes:jpeg,bmp,png',
                ),


        ];
    }
}
