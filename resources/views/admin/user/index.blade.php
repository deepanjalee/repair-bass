@extends('layouts.main')

@section('title', $page_name)

@section('content')
    <div class="container">


        <div class="grid grid-cols-1 lg:grid-cols-1 gap-5 mt-5">
            <div class="card">

                <div class="card-body">
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="font-extrabold text-lg text-gray-500">{{ $page_name }}</h1>
                        {{-- <a href="#" class="btn-gray text-sm">view all</a> --}}
                        <a href="#" class="btn-bs-primary">{{ $btn_name }}</a>
                    </div>

                    {{-- @if($update ==false)
                    @livewire('admin.user.user-add')
                    @else
                    @livewire('admin.user.user-add', ['user' => $object])
                    @endif --}}
                    @livewire('admin.user.user-view')



                </div>
            </div>

        </div>



    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
