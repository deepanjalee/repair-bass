<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ItemRequest;
use App\Models\Admin\Brand;
use App\Models\Admin\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $name = '';
    private $viewName = '';
    private $routeName = '';
    private $mainTable = '';
    private $data = [];

    public function __construct(Item $item)
    {
        // $this->authorizeResource(Company::class);
        $this->name = 'Item';
        $this->viewName = 'admin.item';
        $this->routeName = 'admin.items';
        $this->data['brands'] = Brand::select('id', 'name')->get();
        // $this->data['customers'] = Customer::all();
        $this->mainTable = $item;
    }

    public function index()
    {
        $items = Item::latest()->paginate(env('RECORD_PER_PAGE'));
        $this->data['objects'] = $items->appends(request()->query());
        $this->data['page_name'] = $this->name . ' Manage';
        $this->data['btn_name'] = $this->name . ' Add';
        $this->data['btn_route_edit'] = $this->routeName . '.show';
        $this->data['btn_route_delete'] = $this->routeName . '.destroy';
        $this->data['btn_route'] = route($this->routeName . '.create');

        return view($this->viewName . '.index', $this->data);
    }

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

    public function store(ItemRequest $request)
    {
        // dd($request->all());
        $item = Item::create($request->all());
        return redirect(route($this->routeName . '.index'))->with(
            'success',
            $this->name . ' Added Successfully.'
        );
        // dd($request->all());
    }

    public function show(Item $item)
    {
        $this->data['object'] = $item;
        $this->data['page_name'] = $this->name . ' Update';
        $this->data['route'] = route($this->routeName . '.update', $item);
        //dd($this->data['route']);
        $this->data['update'] = true;
        $this->data['btn_route'] = route($this->routeName . '.index');
        $this->data['btn_name'] = $this->name . ' Manage';
        return view($this->viewName . '.form', $this->data);
    }

    public function edit(Item $item)
    {
        //
    }

    public function update(Request $request, Item $item)
    {
        $item->update($request->all());
        return redirect(route($this->routeName . '.index'))->with(
            'success',
            $this->name . ' Updated Successfully.'
        );
        // dd($request->all());
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect(route($this->routeName . '.index'))->with(
            'danger',
            $this->name . ' Delete Successfully.'
        );
    }
}
