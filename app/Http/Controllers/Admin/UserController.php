<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $name = '';
    private $viewName = '';
    private $routeName = '';
    private $mainTable = '';
    private $data = [];

    public function __construct(User $user)
    {
        //$this->authorizeResource(User::class);
        $this->name = 'User';
        $this->viewName = 'admin.user';
        $this->routeName = 'admin.users';
        //$this->data['groups'] = Group::all();
        $this->mainTable = $user;
    }

    public function index()
    {
        // $this->data['objects'] = $users
        //     ->paginate(env('PAGINATION'))
        //     ->appends(request()->query());
        $this->data['page_name'] = $this->name . ' Manage';
        $this->data['btn_route_edit'] = $this->routeName . '.show';
        $this->data['btn_route_delete'] = $this->routeName . '.destroy';
        $this->data['btn_name'] = $this->name . ' Add';
        $this->data['btn_route'] = route($this->routeName . '.create');
        return view($this->viewName . '.index', $this->data);
    }

    public function create()
    {
        $this->data['update'] = false;
        $this->data['object'] = $this->mainTable;

        //$this->data['user_types'] = UserType::asSelectArray();
        $this->data['route'] = route($this->routeName . '.store');
        $this->data['page_name'] = $this->name . ' Add';
        $this->data['btn_name'] = $this->name . ' Manage';
        return view($this->viewName . '.form', $this->data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        $this->data['object'] = $user;
        $this->data['page_name'] = $this->name . ' Update';
        $this->data['route'] = route($this->routeName . '.update', $user);
        $this->data['user_types'] = UserType::asSelectArray();
        $this->data['update'] = true;
        $this->data['btn_name'] = $this->name . ' Manage';
        return view($this->viewName . '.form', $this->data);
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
    public function layout(User $user)
    {
        return view('layouts.main_layout');
    }
}
