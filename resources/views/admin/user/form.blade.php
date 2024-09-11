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

                    {{-- <hr> --}}
                    {{-- <div class="grid grid-cols-2 mt-5">
                        <div>
                            <label for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                            <input type="text" id="first_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required />
                        </div>
                        <!-- ... -->
                        <div>

                        </div>

                    </div> --}}


                    @livewire('admin.user.user-add')




                </div>
            </div>

        </div>



    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
