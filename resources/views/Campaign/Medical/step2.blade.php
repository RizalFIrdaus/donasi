@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Bantuan Medis dan Kesehatan.</p>
        <p class="text-[20px] font-light mt-6">Data Pasien</p>
        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 mt-2">
            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                style="width: 20%"> 20%</div>
        </div>
    </div>

    @if($errors->any())
    <div class="mt-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="mt-6 w-1/2 mx-auto" method="POST" action="{{ route("store.step2.medical.tujuan") }}">
    @csrf
    <div class="mb-6">
        <label for="user_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Ponsel Kamu</label>
        <input type="text" name="user_phone" id="user_phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pastikan aktif untuk sms" value="{{ Session::has("step2")? Session::get("step2")["user_phone"]:""}}" >
    </div>
    @if (Session::has("step1")&&Session::get("step1")["pasien"]=="4")
    <div class="mb-6">
        <label for="patient_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Ponsel Pasien</label>
        <input type="text" name="patient_phone" id="patient_phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pastikan aktif untuk sms" value="{{ Session::has("step2")? Session::get("step2")["patient_phone"]:""}}" >
    </div>
    @endif
  
    <div class="mb-6">
        <label for="patient_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pasien</label>
        <input type="text" name="patient_name" id="patient_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama yang dimasukan sesuai dengan KTP/Dokumen Medis" value="{{ Session::has("step2")? Session::get("step2")["patient_name"]:""}}" >
    </div>
    <div class="mb-6">
        <label for="patient_diagnose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penyakit atau kondisi yang tertera</label>
        <input type="text" name="patient_diagnose" id="patient_diagnose" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pastikan sesuai dengan hasil dokumen medis" value="{{ Session::has("step2")? Session::get("step2")["patient_diagnose"]:""}}" >
    </div>
    <div class="flex justify-between">
        <a href="{{ route("step1.medical.pasien") }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Sebelumnya</a>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selanjutnya</button>
    </div>
</form>



</div>

@endsection