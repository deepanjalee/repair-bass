<?php

namespace App\Livewire\Admin\User;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class UserAdd extends Component
{
    public $editMode = false;

    // #[Rule('required|min:3|max:50')]
    public $first_name;
    // #[Rule('required|min:3|max:50')]
    public $last_name;
    // #[Rule('required|email|unique:users')]
    public $email;
    // #[Rule('required|min:3|max:10')]
    public $password;
    // #[Rule('required|required_if:user_type,==,2')]
    public $nic;
    public $user_types;
    // #[Rule('required')]
    public $user_type;
    // #[Rule('required|required_if:user_type,==,2')]
    public $salary_per_day;

    public $mobile;

    public $userId;
    public $hidden = true;

    public function mount($user = null)
    {
        if ($user) {
            $this->editMode = true;
            $this->userId = $user->id;
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->user_type = $user->user_type;
            $this->salary_per_day = $user->salary_per_day;
            $this->mobile = $user->mobile;
            $this->password = 'xxxxxxxx';
            $this->nic = $user->nic;
        }
    }

    public function userTypeChange()
    {
        if ($this->user_type == UserType::EMPLOYEE) {
            $this->hidden = false;
            // dd($this->hidden, $this->user_type);
        }
        if ($this->user_type != UserType::EMPLOYEE) {
            $this->hidden = true;
        }
    }

    public function storeUser()
    {
        //  dd($this->user_type);

        if ($this->editMode) {
            $user = User::find($this->userId);

            $validated = $this->validate([
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'nullable|max:50',
                'mobile' => 'required|min:9|max:11',
                'email' => 'required|email|unique:users,email,' . $this->userId,
                'user_type' => 'required',
                'salary_per_day' => 'required_if:user_type,==,2',
                'nic' => 'required_if:user_type,==,2',
            ]);

            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'mobile' => $validated['mobile'],
                'email' => $validated['email'],
                'user_type' => $validated['user_type'],
                'salary_per_day' => $validated['salary_per_day'] ?? null,
                'nic' => $validated['nic'] ?? null,
            ]);

            if ($this->password != 'xxxxxxxx') {
                $password = Hash::make($this->password);
                $user->update([
                    'password' => $password,
                ]);
            }

            session()->flash('success', 'User Updated Successfully.');
        } else {
            $validated = $this->validate([
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'max:50',
                'mobile' => 'required|min:9|max:11',
                'password' => 'required|min:6|max:10',
                'email' => 'required|email|unique:users',
                'user_type' => 'required',
                'salary_per_day' => 'required_if:user_type,==,2',
                'nic' => 'required_if:user_type,==,2',
            ]);

            $user = User::create([
                'name' => $validated['first_name'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'user_type' => $validated['user_type'],
                'salary_per_day' => $validated['salary_per_day'],
                'nic' => $validated['nic'],
            ]);
            $this->reset(
                'first_name',
                'last_name',
                'email',
                'password',
                'user_type',
                'salary_per_day',
                'nic',
                'mobile'
            );
            session()->flash('success', 'User Added Successfully.');
        }

        // dd($this->first_name);
    }
    public function render()
    {
        $this->user_types = UserType::asSelectArray();
        return view('livewire.admin.user.user-add');
    }
}
