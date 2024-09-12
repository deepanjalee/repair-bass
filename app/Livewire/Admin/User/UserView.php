<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserView extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::paginate(config('app.record_per_page'));
        return view('livewire.admin.user.user-view', [
            'objects' => $users,
        ]);
    }
}
