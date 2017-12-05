<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\Welcome;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Mail;




class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//anyone cn make that request
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ];
    }

    public function persist()
    {
        //$password =\Hash::make('password');
        // Create and save the user
        $user = User::create(
            $this->only(['name','email','password']) //Same as  request(['name', 'email', 'password'])

        );


        // Sign them in.
        /*
         * We can use multiple thing like
         * -\Auth::login();
         * -we can use auth() helper function
         * -we can use "request->input" helper function Note: use the helper function sometime
         * nice because we don't have to import the class For example:
         * -"\Request::input" or
         * "use Request" call to the top then write Request::input
         */
        auth()->login($user);

        //Send an Email
        Mail::to($user)->send(new Welcome($user));

    }

}
