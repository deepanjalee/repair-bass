<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserView extends Component
{
    use WithPagination;

    public $common_search;
    public $user_type;
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
    public function removeUser($id)
    {
        $user = User::where('id', $id)->first();
        $icon = 'success';
        $user->delete();

        $this->dispatch(
            'sweetalert',
            title : 'User Delete Successfully.',
            icon : $icon,
            timer : 2000,
            position : 'top-end',
        );
        // dd($user);
    }
    public function render()
    {
        $user_types = UserType::asSelectArray();
        $user = User::whereNot('user_type', UserType::CUSTOMER);
        $search = $this->common_search;
        $user_type = $this->user_type;
       // dd($this->common_search);
        if($search != null){
            $user = $user->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
            });
        }
        if($user_type != null){
            $user = $user->where('user_type', '=', $user_type);
        }
        $users =  $user->paginate(
            config('app.record_per_page')
        );

        return view('livewire.admin.user.user-view', [
            'objects' => $users,
            'user_types' => $user_types,
        ]);
    }
}
