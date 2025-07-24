<?php

namespace App\Livewire\Auth;

use App\Models\Customer;
use Livewire\Component;

class Register extends Component
{
    // definisi variable
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    // definisi rule
    protected function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'password' => ['required', 'confirmed'],
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

    public function register()
    {
        // validari rule 
        $this->validate();

        // save customer
        Customer::create([
            'name'      => $this->name,
            'email'     => $this->email,
            'password'  => bcrypt($this->password),
        ]);

        //session flash
        session()->flash('success', 'Register Berhasil, silahkan login');

        //redirect
        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
