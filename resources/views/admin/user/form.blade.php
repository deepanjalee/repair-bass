@extends('layouts.main')

@section('title', $page_name)

@section('content')
    <div class="container">


        {{-- <div class="grid grid-cols-1 lg:grid-cols-1 gap-5 mt-2">
            <div class="card">

                <div class="card-body">
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="font-extrabold text-lg text-gray-500">{{ $page_name }}</h1>
                        <a type="button" href="{{ route('admin.users.index') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ $btn_name }}</a>
                    </div>

                    <hr class="mt-2">



                    @if ($update == false)
                        @livewire('admin.user.user-add')
                    @else
                        @livewire('admin.user.user-add', ['user' => $object])
                    @endif




                </div>
            </div>

        </div> --}}

        <user-add-update :page_name="{{ $page_name }}"></user-add-update>


    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
