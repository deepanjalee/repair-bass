<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CustomerSelectResourse;
use App\Models\Admin\Customer;
use App\Models\Customer\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{

    private $name = '';
    private $viewName = '';
    private $routeName = '';
    private $mainTable = '';
    private $data = [];

    public function __construct(Quotation $quotation)
    {
        //$this->authorizeResource(User::class);
        $this->name = 'Quotation';
        $this->viewName = 'customer.quotation';
        $this->routeName = 'customer.quotations';
        $this->data['customers'] = CustomerSelectResourse::collection(Customer::all());
        $this->mainTable = $quotation;
    }
    public function index()
    {
        //
    }

    public function create()
    {
        $this->data['update'] = false;
        $this->data['object'] = $this->mainTable;
        $this->data['route'] = route($this->routeName . '.store');
        $this->data['page_name'] = $this->name . ' Add';
        $this->data['btn_name'] = $this->name . ' Manage';
        return view($this->viewName . '.form', $this->data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Quotation $quotation)
    {
        //
    }

    public function edit(Quotation $quotation)
    {
        //
    }

    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    public function destroy(Quotation $quotation)
    {
        //
    }
}
