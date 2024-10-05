<template>
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-5 mt-2">
        <div class="card">
            <div class="card-body">
                <div class="flex flex-row justify-between items-center">
                    <h1 class="font-extrabold text-lg text-gray-500">
                        <!-- {{ $page_name }} -->
                        User Add Update
                    </h1>
                    <a
                        type="button"
                        href="{{ route('admin.users.index') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        <!-- {{ $btn_name }} -->
                        User Manage
                    </a>
                </div>

                <form>
                    <div class="grid grid-cols-2 gap-4 mt-5">
                        <div>
                            <label
                                for="first_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >First name</label
                            >
                            <input
                                type="text"
                                id="first_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="First Name"
                                required
                            />
                        </div>
                    </div>

                    <!-- @error('first_name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">{{ $message }}</span> </p>
                @enderror -->
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            title: "Tets",
        };
    },
};
</script>
