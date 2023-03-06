@extends('Layouts.app')

@section('app')
<div class="flex flex-row">
@include('Layouts.akun.sidebar')
<div class="ml-6 w-full">
    <p class="font-semibold text-[24px]">Setelan Akun</p>
    <p class="font-light text-[18px]">Data privasi akunmu</p>
    <div class="flex items-center justify-between">
        <div class="mt-6 w-3/4">
            <p class="font-normal text-[20px]">Email</p>
            <input disabled value="{{ Auth::user()->email }}" type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
        </div>
        <div class="flex">
            <a href="{{ route("change-email") }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6 flex ">Ganti Email</a>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <div class="mt-6 w-3/4">
            <p class="font-normal text-[20px]">Password</p>
        </div>
        <div class="flex">
            <a href="{{ route("change-password") }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6 flex ">Ganti Password</a>
        </div>
    </div>
</div>
</div>
@endsection