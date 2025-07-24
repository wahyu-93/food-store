<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected function rules()
    {
        return [
            'email'  => ['required','email'],
            'password' => ['required'],
        ];
    }

    // dijalankan pertama kali ketika form diakses
    public function mount()
    {
        // jika sudah login arah kan ke menu account
        if(auth()->guard('customer')->check()){
            return $this->redirect('/account/my-order', navigate:true);
        };
    }

    public function login()
    {
        // validate the input
        $this->validate();

        // attempt to login
        if (auth()->guard('customer')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            // session flash
            session()->flash('success', 'Login Berhasil');

            // redirect to the desired page
            return $this->redirect('/account/my-orders', navigate: true);
        }

        // flash error message if login fails
        session()->flash('error', 'Periksa email dan password Anda.');

        // redirect to the desired page
        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
