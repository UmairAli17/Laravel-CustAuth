<?php

namespace App\Http\Requests;
use Auth;
use App\Http\Requests\Request;

class BusinessRequest extends Request
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
            'logoFileName' => array(
                    'mimes:jpeg,bmp,png',
                ),

        ];
    }
}
