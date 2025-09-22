<?php

namespace App\Http\Controllers;

use App\Enums\DiscountType;
use App\Http\Resources\Admin\CustomerSelectResourse;
use App\Http\Resources\Admin\ItemSelectResource;
use App\Http\Resources\Admin\SiteSelectResource;
use App\Http\Resources\Customer\InvoiceItemSelectResource;
use App\Http\Resources\Customer\InvoiceSelectResource;
use App\Http\Resources\Customer\QuotationSelectResource;
use App\Models\Admin\Customer;
use App\Models\Admin\Item;
use App\Models\Customer\Invoice;
use App\Models\Customer\InvoiceExpense;
use App\Models\Customer\InvoiceItem;
use App\Models\Customer\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    private $name = '';
    private $viewName = '';
    private $routeName = '';
    private $mainTable = '';
    private $data = [];

    public function __construct(Invoice $invoice)
    {
        //$this->authorizeResource(User::class);
        $this->name = 'Invoice';
        $this->viewName = 'customer.invoice';
        $this->routeName = 'customer.invoices';
        $this->data['customers'] = CustomerSelectResourse::collection(Customer::all());
        $this->data['products'] = ItemSelectResource::collection(Item::all());
        $this->mainTable = $invoice;
        $discount_types = DiscountType::asSelectArray();
        $this->data['discount_types'] = array_map(function ($key, $value) {
            return [
                'id' => $key,
                'name' => $value,
            ];
        }, array_keys($discount_types), $discount_types);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::latest()->paginate(env('RECORD_PER_PAGE'));
        $this->data['objects'] = $invoices->appends(request()->query());
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
    public function create(Request $request)
    {
        $this->data['update'] = true;
        $this->data['object'] = $this->mainTable;
        $this->data['route'] = route($this->routeName . '.store');
        $this->data['page_name'] = $this->name . ' Add';
        $this->data['btn_name'] = $this->name . ' Manage';
        $invoiceData  = $this->createInvoiceFromQuotation($request->quotation);
        $this->data['invoice_number'] = $invoiceData->invoice_number;
        $this->data['invoice'] = InvoiceSelectResource::make($invoiceData);
        $this->data['sites'] = SiteSelectResource::collection($invoiceData->customer->sites);
        return view($this->viewName . '.form', $this->data);
    }

    public function createInvoiceFromQuotation($quotation_id)
    {

        $quotation = Quotation::with('items')->findOrFail($quotation_id);
        $availableInvoice = Invoice::where('quotation_id', $quotation_id)->first();

        if ($availableInvoice) {
            return $availableInvoice;
        }
        $invoice = new Invoice();
        $invoice->invoice_number = Invoice::generateNextInvoiceNumber();

        $invoice->customer_id = $quotation->customer_id;
        $invoice->site_id = $quotation->site_id;
        $invoice->date = now();
        $invoice->sub_total = $quotation->sub_total;
        $invoice->discount = $quotation->discount;
        $invoice->discount_percentage = $quotation->discount_percentage;
        $invoice->discount_type = $quotation->discount_type;
        $invoice->vat = $quotation->vat;
        $invoice->total = $quotation->total;
        $invoice->description = $quotation->description;
        $invoice->remarks = $quotation->remarks;
        $invoice->quotation_id = $quotation->id;
        $invoice->save();


        foreach ($quotation->items as $item) {
            $invoiceItem = new InvoiceItem();
            $invoiceItem->item_id = $item->item_id;
            $invoiceItem->price = $item->price;
            $invoiceItem->quantity = $item->quantity;
            $invoiceItem->total = $item->total;
            $invoiceItem->description = $item->description;
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->save();
        }
        foreach ($quotation->expenses as $expense) {
            $invoiceExpense = new InvoiceExpense();
            $invoiceExpense->name = $expense->name;
            $invoiceExpense->price = $expense->price;
            $invoiceExpense->description = $expense->description;
            $invoiceExpense->invoice_id = $invoice->id;
            $invoiceExpense->save();
        }
        return $invoice;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $items = $request->items;
        $expenses = $request->expenses;
        unset($request['items']);
        unset($request['expenses']);
        $request['date'] = Carbon::parse($request['date'])->format('Y-m-d');
        if ($request->discount_type == DiscountType::FIXED_AMOUNT) {
            $percentage = ($request->discount / $request->total) * 100;
            $request['discount_percentage'] = round($percentage, 2);
        }
        if ($request->discount_type == DiscountType::FIXED_AMOUNT) {
            $request['discount'] =  $request->sub_total - $request->total;
        }

        $invoice = Invoice::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );

        foreach ($items as $key => $item) {

            $itemId = array_key_exists('id', $item) ? $item['id'] : null;

            $invoiceItem = InvoiceItem::updateOrCreate(
                ['id' => $itemId],
                [
                    'item_id' => $item['item_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['total'],
                    'description' => $item['description'] ?? null,
                    'invoice_id' => $invoice->id,
                ]
            );
        }

        // dd($expenses);
        foreach ($expenses as $key => $expense) {
            $expenseId = array_key_exists('id', $expense) ? $expense['id'] : null;
            $invoiceExpense = InvoiceExpense::updateOrCreate(
                ['id' => $expenseId],
                [
                    'name' => $expense['name'],
                    'price' => $expense['price'],
                    'description' => $expense['description'] ?? null,
                    'invoice_id' => $invoice->id,
                ]
            );
        }



        return response()->json([
            'status' => true,
            'message' => 'Invoice saved successfully',
            'data' => $invoice->load('items'),
            'redirect_url' =>  route('customer.invoices.index')
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $this->data['invoice'] = InvoiceSelectResource::make($invoice);
        $this->data['update'] = true;
        $this->data['page_name'] = $this->name . ' View';
        $this->data['btn_name'] = $this->name . ' Manage';
        $this->data['btn_route'] = route($this->routeName . '.index');
        $this->data['btn_route_edit'] = route($this->routeName . '.edit', $invoice);
        $this->data['btn_route_delete'] = route($this->routeName . '.destroy', $invoice);
        $this->data['invoice_number'] = $invoice->invoice_number;
        $this->data['sites'] = SiteSelectResource::collection($invoice->customer->sites);

        return view($this->viewName . '.form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function pdf(Invoice $invoice)
    {
        $this->data['invoice'] = $invoice;
        return view($this->viewName . '.pdf', $this->data);
    }
    public function deleteExpense(Request $request)
    {
        $invoiceExpense = InvoiceExpense::find($request->id);

        $invoiceId = $invoiceExpense->invoice_id;


        //delete the expense
        if ($invoiceExpense) {
            $invoiceExpense->delete();
        }

        $invoiceExpenses = InvoiceExpense::where('invoice_id', $invoiceId)->get();

        //return invoice expenses
        return response()->json([
            'status' => true,
            'message' => 'Expense deleted successfully',
            'data' => $invoiceExpenses,
        ], 200);
    }

    public function deleteItem(Request $request)
    {
        $invoiceItem = InvoiceItem::find($request->id);

        $invoiceId = $invoiceItem->invoice_id;


        //delete the Item
        if ($invoiceItem) {
            $invoiceItem->delete();
        }

        $invoiceItems = InvoiceItem::where('invoice_id', $invoiceId)->get();

        //return invoice Items
        return response()->json([
            'status' => true,
            'message' => 'Item deleted successfully',
            'data' => InvoiceItemSelectResource::collection($invoiceItems),
        ], 200);
    }
}
