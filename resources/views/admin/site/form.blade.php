@extends('layouts.main')

@section('title', $page_name)

@section('content')
    <div class="container">


        <div class="grid grid-cols-1 lg:grid-cols-1 gap-5 mt-2">
            <div class="card">

                <div class="card-body">
                    <div class="flex flex-row justify-between items-center">
                        <h1 class="font-extrabold text-lg text-gray-500">{{ $page_name }}</h1>
                        <a type="button" href="{{ $btn_route }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ $btn_name }}</a>
                    </div>

                    <hr class="mt-2">

                    @include('layouts.alerts')

                    <form action="{{ $route }}" method="POST">
                        @csrf
                        @if ($update)
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-2 gap-4 mt-5">
                            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-first-name">
                                     Name
                                </label>
                                <x-input-new id="name"
                                    class="block w-full unicode {{ $errors->has('name') ? 'border-red-500' : '' }}"
                                    type="text" name="name" :value="old('name') ? old('name') : $object->name" autofocus placeholder=" Name" />

                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">{{ $message }}</span> </p>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-first-name">
                                   Customer
                                </label>

                                <select class="select2" id="customer_id" name="customer_id">
                                    <option value="" disabled selected hidden>Select a state</option>
                                    @foreach ($customers as $key => $customer)
                                    <option value="{{ $customer->id }}" @if ($customer->id == $object->customer_id || $customer->id == old('customer_id') )
                                        selected
                                    @endif>{{ $customer->full_name}}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">{{ $message }}</span> </p>
                                @enderror
                            </div>


                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-5">
                            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-first-name">
                                    Address
                                </label>
                                <textarea id="address" rows="4" name="address" id="address"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Address">{{ old('address') ? old('address') : $object->address }}</textarea>

                                @error('address')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">{{ $message }}</span> </p>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-first-name">
                                    Description
                                </label>
                                <textarea id="description" rows="4" name="description" id="description"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Description">{{ old('description') ? old('description') : $object->description }}</textarea>

                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                            class="font-medium">{{ $message }}</span> </p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 mt-5">
                            <div class="mt-3 ml-3">
                                <button
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>



    </div>
@endsection
@push('scripts')
    <script>
    </script>
@endpush
