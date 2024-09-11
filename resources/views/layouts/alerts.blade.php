@if (session('success'))
<div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
  {{-- <strong class="font-bold">Success!</strong> --}}
  <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif
@if (session('danger'))
<div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5" role="alert">
  {{-- <strong class="font-bold">Success!</strong> --}}
  <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif
