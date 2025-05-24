@extends('layouts.main')

@section('title', $page_name)

@section('content')
    <div class="container">

        {{-- {{ dd('@json($discount_types)') }} --}}
        <quotation-add-update :page-name="'{{ $page_name }}'" :quotation-number="'{{ $quotation_number }}'"
            :btn-name="'{{ $btn_name }}'" :customers='@json($customers)'
            :products='@json($products)'
            :discount-types='@json($discount_types)'
            @if ($update) :quotation='@json($quotation)' @endif
            {{-- :quotation='@json($quotation)' --}}
            :update="'{{ $update }}'"
            ></quotation-add-update>


    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
