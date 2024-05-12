<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthorLoginForm extends Component
{
    public $login_id, $password;
    public $exists = false;

    public function LoginHandler()
    {

        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5',
            ], [
                'login_id' => 'Email or Username is required',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'Email is not registered',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 5 characters long',
            ]);
        } else {
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Email or Username is required',
                'login_id.exists' => 'Username is not registered',
                'password.required' => 'Password is required',
                'password.min' => 'Password must be at least 5 characters long',
            ]);
        }


        $credentials = array(
            $fieldType => $this->login_id,
            'password' => $this->password
        );

        if (Auth::guard('web')->attempt($credentials)) {

            $checkUserIntegrity = User::where($fieldType, $this->login_id)->first();

            if ($checkUserIntegrity->blocked == 1) {

                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account has been suspended');
            } else {

                return redirect()->route('author.home');
            }
        } else {
            session()->flash('fail', 'Incorrect credentials');
        }



        // $this->validate([
        //     'email' => 'required|email|exists:users,email',
        //     'password' => 'required|min:5'
        // ], [
        //     'email.required' => 'Enter your email address',
        //     'email.email' => 'Invalid email address',
        //     'email.exists' => 'Email does not exists',
        //     'password.required' => 'Password is required',
        // ]);

        // $credentials = array('email' => $this->email, 'password' => $this->password);

        // if( Auth::guard('web')->attempt($credentials)){

        // $checkUserIntegrity = User::where('email', $this->email)->first();

        //     if($checkUserIntegrity->blocked == 1){
        //         Auth::guard('web')->logout();
        //         return redirect()->route('author.login')->with('Your account had been blocked.');
        //     }else{
        //         return redirect()->route('author.home');
        //     }

        // }else{
        //     session()->flash('fail', 'incorrect email or password');
        // }
    }

    public function render()
    {
        return view('livewire.author-login-form');
    }
}
