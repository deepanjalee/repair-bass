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
        $icon = 'success';
        if ($status == 1) {
            $user->active = false;
            $status_name = 'Deactivated';

        }
        if ($status == 0) {
            $user->active = true;
            $status_name = 'Activated';
        }
        $user->save();

        $this->dispatch(
            'sweetalert',
            title : 'User ' . $status_name . ' Successfully.',
            icon : $icon,
            timer : 2000,
            position : 'top-end',
        );
        // dd($user);
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
