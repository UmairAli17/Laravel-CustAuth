<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Auth;
use App\Posts;
use App\User;
class AccessPost extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        //The following prevents one from access another's work
        $posts = Posts::find($this->posts);
        return Auth::user()->id == $posts->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //None Needed.
        ];
    }
}
