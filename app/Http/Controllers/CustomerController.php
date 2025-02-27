<?php

namespace App\Http\Controllers;

use App\Models\Admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $name = '';
    private $viewName = '';
    private $routeName = '';
    private $mainTable = '';
    private $data = [];

    public function __construct(Customer $customer)
    {
        // $this->authorizeResource(Company::class);
        $this->name = 'Customer';
        $this->viewName = 'admin.customer';
        $this->routeName = 'admin.customers';
        $this->mainTable = $customer;
    }
    public function index()
    {
        $customers = Customer::latest()->paginate(env('RECORD_PER_PAGE'));
        $this->data['objects'] = $customers->appends(request()->query());
        $this->data['page_name'] = $this->name . ' Manage';
        $this->data['btn_name'] = $this->name . ' Add';
        $this->data['btn_route_edit'] = $this->routeName . '.show';
        $this->data['btn_route_delete'] = $this->routeName . '.destroy';
        $this->data['btn_route'] = route($this->routeName . '.create');

        return view($this->viewName . '.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['update'] = false;
        $this->data['btn_name'] = $this->name . ' Manage';
        $this->data['btn_route'] = route($this->routeName . '.index');
        // dd($this->data['btn_route']);
        $this->data['object'] = $this->mainTable;

        $this->data['route'] = route($this->routeName . '.store');
        $this->data['page_name'] = $this->name . ' Add';
        return view($this->viewName . '.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //dd($request->all());
       $customer = Customer::create($request->all());
       return redirect(route($this->routeName . '.index'))->with(
           'success',
           $this->name . ' Added Successfully.'
       );
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $this->data['object'] = $customer;
        $this->data['page_name'] = $this->name . ' Update';
        $this->data['route'] = route($this->routeName . '.update', $customer);
        //dd($this->data['route']);
        $this->data['update'] = true;
        $this->data['btn_route'] = route($this->routeName . '.index');
        $this->data['btn_name'] = $this->name . ' Manage';
        return view($this->viewName . '.form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect(route($this->routeName . '.index'))->with(
            'success',
            $this->name . ' Updated Successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect(route($this->routeName . '.index'))->with(
            'danger',
            $this->name . ' Delete Successfully.'
        );
    }
}
