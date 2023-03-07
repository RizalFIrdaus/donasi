@extends('Layouts.app')

@section('app')
<div class="flex flex-row">
@include('Layouts.akun.sidebar')
<div class="ml-6 w-full">
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <p class="font-semibold text-[24px]">Ganti Email</p>
    <p class="font-light text-[18px]">Pastikan email barumu belum digunakan</p>
    <form action="{{ route("update-email") }}" method="POST">
    @csrf
    <div class="flex items-center justify-between">
        <div class="mt-6 w-full">
            <p class="font-normal text-[20px]">Email</p>
            <input disabled value="{{ Auth::user()->email }}" type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <div class="mt-6 w-full">
            <p class="font-normal text-[20px]">Email Baru</p>
            <input type="email" name="new_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="masukkan email barumu"/>
        </div>
    </div>
    <div class="mt-6">
        <div class="flex justify-between">
            <a href="{{ route("change-personal-account") }}"  class="text-white bg-red-700 hover:bg-red-800 focus:red-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 mt-6 ">Kembali</a>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6 ">Simpan</button>
        </div>
    </div>
</form>

</div>
</div>
@endsection