<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UserAdd extends Component
{
    public $first_name;
    public $last_name;

    public function storeUser()
    {
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);
        dd($this->first_name);
    }
    public function render()
    {
        return view('livewire.admin.user.user-add');
    }
}
