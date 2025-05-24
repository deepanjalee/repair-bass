<?php

namespace App\Http\Controllers\Customer;

use App\Enums\DiscountType;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuotatioStorenRequest;
use App\Http\Resources\Admin\CustomerSelectResourse;
use App\Http\Resources\Admin\ItemSelectResource;
use App\Http\Resources\Admin\SiteSelectResource;
use App\Http\Resources\Customer\QuotationSelectResource;
use App\Models\Admin\Customer;
use App\Models\Admin\Item;
use App\Models\Customer\Quotation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer\QuotationItem;

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
        $this->data['products'] = ItemSelectResource::collection(Item::all());
        $this->mainTable = $quotation;
        $discount_types = DiscountType::asSelectArray();
        $this->data['discount_types'] = array_map(function ($key, $value) {
            return [
                'id' => $key,
                'name' => $value,
            ];
        }, array_keys($discount_types), $discount_types);
    }
    public function index()
    {
        $quotations = Quotation::latest()->paginate(env('RECORD_PER_PAGE'));
        $this->data['objects'] = $quotations->appends(request()->query());
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
        $this->data['object'] = $this->mainTable;
        $this->data['route'] = route($this->routeName . '.store');
        $this->data['page_name'] = $this->name . ' Add';
        $this->data['btn_name'] = $this->name . ' Manage';
        $this->data['quotation_number'] = Quotation::generateNextQuotationNumber();
        //need to convert to object array discount_types like [{ "id": 1, "name": "Fixed Amount" },{ "id": 2, "name": "Percentage" }]



        // dd($this->data['discount_types']);

        // dd($this->data['quotation_number'] );
        return view($this->viewName . '.form', $this->data);
    }

    public function store(QuotatioStorenRequest $request)
    {
        
        $items = $request->items;
        unset($request['items']);
        $request['date'] = Carbon::parse($request['date'])->format('Y-m-d');

        if($request->discount_type == DiscountType::FIXED_AMOUNT){
            $percentage = ($request->discount / $request->total) * 100;
            $request['discount_percentage'] = round($percentage,2);
        }
        if($request->discount_type == DiscountType::FIXED_AMOUNT){
            $request['discount'] =  $request->sub_total - $request->total;
        }
        // dd( $request['discount'] );

        $quotation = Quotation::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );

        foreach ($items as $key => $item) {
            $itemId = array_key_exists('id', $item) ? $item['id'] : null;
            $quotationItem = QuotationItem::updateOrCreate(
                ['id' => $itemId],
                [
                    'item_id' => $item['item_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['total'],
                    'description' => $item['description'] ?? null,
                    'quotation_id' => $quotation->id,
                ]
            );
        }

        return response()->json([
            'status' => true,
            'message' => 'Quotation saved successfully',
            'data' => $quotation->load('items'),
            'redirect_url' =>  route('customer.quotations.index')
        ], 200);
    }

    public function show(Quotation $quotation)
    {
        $this->data['quotation'] = QuotationSelectResource::make($quotation);
        $this->data['update'] = true;
        $this->data['page_name'] = $this->name . ' View';
        $this->data['btn_name'] = $this->name . ' Manage';
        $this->data['btn_route'] = route($this->routeName . '.index');
        $this->data['btn_route_edit'] = route($this->routeName . '.edit', $quotation);
        $this->data['btn_route_delete'] = route($this->routeName . '.destroy', $quotation);
        $this->data['quotation_number'] = $quotation->quotation_number;
        $this->data['sites'] = SiteSelectResource::collection($quotation->customer->sites);

        return view($this->viewName . '.form', $this->data);
    }

    public function edit(Quotation $quotation) {}

    public function update(Request $request, Quotation $quotation)
    {

    }

    public function destroy(Quotation $quotation)
    {
        //
    }
    public function pdf(Quotation $quotation)
    {
        // dd($quotation);
        $this->data['quotation'] = $quotation;
        return view($this->viewName . '.pdf', $this->data);
        // dd($quotation);
    }
}
