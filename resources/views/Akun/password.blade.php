@extends('Layouts.app')

@section('app')
<div class="flex flex-row">
@include('Layouts.akun.sidebar')
<div class="ml-6 w-full">
    <p class="font-semibold text-[24px]">Ganti Password</p>
    <p class="font-light text-[18px]">Pastikan menggunakan password yang rumit agar data anda aman</p>
    <div class="flex items-center justify-between">
        <div class="mt-6 w-full">
            <p class="font-normal text-[20px]">Password Lama</p>
            <input type="password" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <div class="mt-6 w-full">
            <p class="font-normal text-[20px]">Password Baru</p>
            <input type="password" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <div class="mt-6 w-full">
            <p class="font-normal text-[20px]">Ulangi Password Baru</p>
            <input type="password" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
        </div>
    </div>
    <div class="flex justify-between mt-6">
        <div>
            <a href="{{ route("change-personal-account") }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Batal</a>
        </div>
        <div>
            <a href="/" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6 ">Simpan</a>
        </div>
    </div>
</div>
</div>
@endsection