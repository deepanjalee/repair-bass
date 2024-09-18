<div>

    @include('layouts.alerts')
    <form wire:submit="storeUser">

        <div class="grid grid-cols-2 gap-4 mt-5">
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    First Name
                </label>
                <x-input-new id="first_name" class="block w-full {{ $errors->has('first_name') ? 'border-red-500' : '' }}"
                    type="text" name="first_name" :value="old('first_name')" autofocus placeholder="First Name"
                    wire:model="first_name" />

                @error('first_name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">{{ $message }}</span> </p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Last Name
                </label>
                <x-input-new id="last_name"
                    class="block w-full  {{ $errors->has('last_name') ? 'border-red-500' : '' }}" type="text"
                    name="last_name" :value="old('last_name')" autofocus placeholder="Last Name" wire:model="last_name" />

                @error('last_name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">{{ $message }}</span> </p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Mobile
                </label>
                <x-input-new id="mobile" class="block w-full  {{ $errors->has('mobile') ? 'border-red-500' : '' }}"
                    type="text" name="mobile" :value="old('mobile')" autofocus placeholder="Mobile"
                    wire:model="mobile" />

                @error('mobile')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">{{ $message }}</span> </p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Email
                </label>
                <x-input-new id="email" class="block w-full  {{ $errors->has('email') ? 'border-red-500' : '' }}"
                    type="text" name="email" :value="old('email')" autofocus placeholder="Email" wire:model="email" />
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">{{ $message }}</span> </p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Password
                </label>
                <x-input-new id="password" class="block w-full  {{ $errors->has('password') ? 'border-red-500' : '' }}"
                    type="password" name="password" :value="old('password')" autofocus placeholder="password"
                    wire:model="password" />
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">{{ $message }}</span> </p>
                @enderror
            </div>

            <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    User Type
                </label>

                <select id="user_type" wire:model='user_type' wire:change="userTypeChange"
                    class="{{ $errors->has('user_type') ? 'border-red-500' : '' }} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select User Type</option>
                    @foreach ($user_types as $key => $user_type)
                        @if ($key != App\Enums\UserType::CUSTOMER)
                            <option value="{{ $key }}">{{ $user_type }}</option>
                        @endif
                    @endforeach
                </select>

                @error('user_type')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">{{ $message }}</span> </p>
                @enderror
            </div>

            @if ($hidden == false)
                <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        NIC
                    </label>
                    <x-input-new id="nic" class="block w-full  {{ $errors->has('nic') ? 'border-red-500' : '' }}"
                        type="text" name="nic" :value="old('nic')" autofocus placeholder="NIC" wire:model="nic" />
                    @error('nic')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">{{ $message }}</span> </p>
                    @enderror
                </div>

                <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Salary Per Day
                    </label>
                    <x-input-new id="salary_per_day"
                        class="block w-full  {{ $errors->has('salary_per_day') ? 'border-red-500' : '' }}"
                        type="text" name="salary_per_day" :value="old('salary_per_day')" autofocus placeholder="Salary Per Day"
                        wire:model="salary_per_day" />
                    @error('salary_per_day')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">{{ $message }}</span> </p>
                    @enderror
                </div>
            @endif

            {{-- {{ $user_type }} --}}
        </div>
        <div class="grid grid-cols-1 gap-4 mt-5">
            <div class="mt-3 ml-3">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
            </div>
        </div>
    </form>
</div>
