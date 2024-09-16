<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserView extends Component
{
    use WithPagination;

    public function changeStatus($id)
    {
        $user = User::where('id', $id)->first();
        $status = $user->active;
        if ($status == 1) {
            $user->active = false;
        }
        if ($status == 1) {
            $user->active = true;
        }
        $user->save();
        dd($user);
    }
    public function render()
    {
        $users = User::whereNot('user_type', UserType::CUSTOMER)->paginate(
            config('app.record_per_page')
        );
        return view('livewire.admin.user.user-view', [
            'objects' => $users,
        ]);
    }
}
