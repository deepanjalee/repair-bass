@extends('layouts.main')

@section('title', $page_name)

@section('content')
    <div class="container">

        <quotation-add-update :page-name="'{{ $page_name }}'" :btn-name="'{{ $btn_name }}'"
            :customers='@json($customers)'></quotation-add-update>


    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
