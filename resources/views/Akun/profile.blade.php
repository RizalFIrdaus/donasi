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
    <form action="{{ route("update-profile") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <p class="font-semibold text-[24px]">Ubah Profil</p>
    <p class="font-light text-[18px]">Isi biodata dengan benar</p>
    <div class="mt-6">
        <p class="font-normal text-[20px]">Foto</p>
        <div class="flex flex-row items-center">
            <img src="{{ $profile->photo??"https://i.ibb.co/T8gx9P9/Java-Script-logo.png" }}" alt="" class="w-40 h-40 rounded-full mr-6">
            <input type="file" name="photo" >
        </div>
    </div>
    <div class="mt-6">
        <p class="font-normal text-[20px]">Nama Lengkap</p>
        <input type="text" name="fullname"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ $profile->fullname??"" }}"/>
    </div>
    <div class="mt-6">
        <p class="font-normal text-[20px]">Jenis Kelamin</p>
         <div class="flex">
            <div class="flex items-center px-4 border border-gray-200 rounded dark:border-gray-700">
                <input id="bordered-radio-1" type="radio" value="1" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ (isset($profile->gender) && $profile->gender =="1")? "checked" : "" }} >
                <label for="bordered-radio-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laki-laki</label>
            </div>
            <div class="flex items-center px-4 border border-gray-200 rounded dark:border-gray-700 ml-10">
                <input id="bordered-radio-2" type="radio" value="2" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ (isset($profile->gender) && $profile->gender =="2")? "checked" : "" }} >
                <label for="bordered-radio-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Perempuan</label>
            </div>
         </div>
    <div class="mt-6">
        <p class="font-normal text-[20px]">Tanggal Lahir</p>
<div class="relative max-w-sm">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
      <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
    </div>
    <input datepicker datepicker-format="yyyy-mm-dd" type="text" name="birthday" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" value="{{ $profile->birthday??"" }}">
  </div>
  
    </div>
    <div class="mt-6">
        <p class="font-normal text-[20px]">Nomor Handphone (WA)</p>
        <input type="text" name="number_phone" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ $profile->number_phone??"" }}"/>
    </div>
    <div class="mt-6">
        <p class="font-normal text-[20px]">Alamat</p>
        <textarea id="message" rows="4" class="block mt-2 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Orang lain tidak akan bisa lihat biodata anda" name="address" >{{ $profile->address??"" }}</textarea>
    </div>
    <div class="mt-6">
        <p class="font-normal text-[20px]">Biodata Diri</p>
        <textarea id="message" rows="4" class="block mt-2 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Orang lain tidak akan bisa lihat biodata anda" name="description">{{ $profile->description??"" }}</textarea>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-6 flex ">Simpan</button>
</form>

    <p class="font-semibold text-[24px] mt-6">Social Media</p>
    <div class="mt-2">
        <p class="font-normal text-[18px]">Instagram</p>
        <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="@usernamekamu"/>
        <p class="font-normal text-[18px] mt-4">Facebook</p>
        <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="https://www.facebook.com/usernamekamu/"/>
        <p class="font-normal text-[18px] mt-4">Twitter</p>
        <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="@username"/>
        <p class="font-normal text-[18px] mt-4">Tiktok</p>
        <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="@username"/>
    </div>
    <div class="flex justify-end">
   
    </div>
</div>

</div>
@endsection