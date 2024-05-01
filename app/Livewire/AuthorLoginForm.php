<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthorLoginForm extends Component
{
    public $email, $password;

    public function LoginHandler(){
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ], [
            'email.required' => 'Enter your email address',
            'email.email' => 'Invalid email address',
            'email.exists' => 'Email does not exists',
            'password.required' => 'Password is required',
        ]);

        $credentials = array('email' => $this->email, 'password' => $this->password);

        if( Auth::guard('web')->attempt($credentials)){

        $checkUserIntegrity = User::where('email', $this->email)->first();

            if($checkUserIntegrity->blocked == 1){
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('Your account had been blocked.');
            }else{
                return redirect()->route('author.home');
            }

        }else{
            session()->flash('fail', 'incorrect email or password');
        }
    }

    public function render()
    {
        return view('livewire.author-login-form');
    }
}
