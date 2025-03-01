<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteRequest;
use App\Models\Admin\Customer;
use App\Models\Admin\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    private $name = '';
    private $viewName = '';
    private $routeName = '';
    private $mainTable = '';
    private $data = [];

    public function __construct(Site $site)
    {
        // $this->authorizeResource(Company::class);
        $this->name = 'Site';
        $this->viewName = 'admin.site';
        $this->routeName = 'admin.sites';
        $this->data['customers'] = Customer::all();
        $this->mainTable = $site;
    }

    public function index()
    {
        $sites = Site::latest()->paginate(env('RECORD_PER_PAGE'));
        $this->data['objects'] = $sites->appends(request()->query());
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

    public function store(SiteRequest $request)
    {

        //dd($request->all());
        $site = Site::create($request->all());
        return redirect(route($this->routeName . '.index'))->with(
            'success',
            $this->name . ' Added Successfully.'
        );
    }

    public function show(Site $site)
    {
        $this->data['object'] = $site;
        $this->data['page_name'] = $this->name . ' Update';
        $this->data['route'] = route($this->routeName . '.update', $site);
        //dd($this->data['route']);
        $this->data['update'] = true;
        $this->data['btn_route'] = route($this->routeName . '.index');
        $this->data['btn_name'] = $this->name . ' Manage';
        return view($this->viewName . '.form', $this->data);
    }

    public function edit(Site $site)
    {
        //
    }

    public function update(SiteRequest $request, Site $site)
    {
        $site->update($request->all());
        return redirect(route($this->routeName . '.index'))->with(
            'success',
            $this->name . ' Updated Successfully.'
        );
    }

    public function destroy(Site $site)
    {
        $site->delete();
        return redirect(route($this->routeName . '.index'))->with(
            'danger',
            $this->name . ' Delete Successfully.'
        );
    }
}
