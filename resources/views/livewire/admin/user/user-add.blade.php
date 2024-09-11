<div>

    @include('layouts.alerts')
    <form wire:submit="storeUser">

        <div class="grid grid-cols-2 gap-4 mt-5">
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    First Name
                </label>
                <x-input-new id="first_name" class="block w-full border-red-500" type="text" name="first_name"
                    :value="old('first_name')" autofocus placeholder="First Name" wire:model="first_name" />

                @error('first_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Last Name
                </label>
                <x-input-new id="last_name" class="block w-full" type="text" name="last_name" :value="old('last_name')"
                    autofocus placeholder="Last Name" wire:model="last_name" />

                @error('last_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Email
                </label>
                <x-input-new id="email" class="block w-full" type="text" name="email" :value="old('email')"
                    autofocus placeholder="Email" wire:model="email" />
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Password
                </label>
                <x-input-new id="password" class="block w-full" type="password" name="password" :value="old('password')"
                    autofocus placeholder="password" wire:model="password" />
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    User Type
                </label>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="user_type"
                    wire:model='user_type'>
                    @foreach ($user_types as $key => $user_type)
                    <option value="{{ $key }}">{{ $user_type }}</option>

                    @endforeach

                </select>
                @error('user_type')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    NIC
                </label>
                <x-input-new id="nic" class="block w-full" type="text" name="nic" :value="old('nic')"
                    autofocus placeholder="NIC" wire:model="nic" />
                @error('nic')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Salary Per Day
                </label>
                <x-input-new id="salary_per_day" class="block w-full" type="text" name="salary_per_day" :value="old('salary_per_day')"
                    autofocus placeholder="Salary Per Day" wire:model="salary_per_day" />
                @error('salary_per_day')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>




        </div>
        <button class="btn-bs-primary">Save</button>
    </form>
</div>
