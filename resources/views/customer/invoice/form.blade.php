@extends('layouts.main')

@section('title', $page_name)

@section('content')
    <div class="container">

        <invoice-add-update :page-name="'{{ $page_name }}'" :invoice-number="'{{ $invoice_number }}'"
            :btn-name="'{{ $btn_name }}'" :customers='@json($customers)'
            :products='@json($products)'
            :discount-types='@json($discount_types)'
            @if ($update)
            :invoice='@json($invoice)'
            @endif
            :sites='@json($sites)'
            {{-- :quotation='@json($quotation)' --}}
            :update="'{{ $update }}'"
            ></invoice-add-update>


    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
