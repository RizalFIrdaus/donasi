@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Bantuan Medis dan Kesehatan.</p>
        <div class="flex justify-between mb-1 mt-6">
            <span class="text-base font-medium text-blue-700 dark:text-white">Data Pasien</span>
            <span class="text-sm font-medium text-blue-700 dark:text-white">{{ Session::has("progress")? Session::get("progress")["data"]: "0"}}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
            <div class="bg-blue-600 h-4 rounded-full" style="width: {{ Session::has("progress")? Session::get("progress")["data"]: "0"}}%"></div>
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
<form class="mt-6 w-fullmx-auto" method="POST" action="{{ route("store.step2.medical.tujuan") }}">
    @csrf
    <div class="mb-6">
        <label for="user_phone" class="block  text-sm font-medium text-gray-900 dark:text-white">Nomor Ponsel Kamu</label>
         <p class="font-light text-sm text-slate-600 mb-2">Pastikan aktif untuk sms.</p>
        <input type="text" name="user_phone" id="user_phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh : 082113872314" value="{{ Session::has("step2")? Session::get("step2")["user_phone"]:""}}{{ old("user_phone") }}" >
    </div>
    @if (Session::has("step1")&&Session::get("step1")["pasien"]=="4")
    <div class="mb-6">
        <label for="patient_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Ponsel Pasien</label>
        <p class="font-light text-sm text-slate-600 mb-2">Pastikan aktif untuk sms.</p>
        <input type="text" name="patient_phone" id="patient_phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh : 082113872314" value="{{ Session::has("step2")? Session::get("step2")["patient_phone"]:""}}{{ old("patient_phone") }}" >
    </div>
    @endif
  
    <div class="mb-6">
        <label for="patient_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pasien</label>
        <p class="font-light text-sm text-slate-600 mb-2">Nama yang dimasukan sesuai dengan KTP/Dokumen Medis.</p>
        <input type="text" name="patient_name" id="patient_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh: Adit Suteja" value="{{ Session::has("step2")? Session::get("step2")["patient_name"]:""}}{{ old("patient_name") }}" >
    </div>
    <div class="mb-6">
        <label for="patient_diagnose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penyakit atau kondisi yang tertera</label>
        <p class="font-light text-sm text-slate-600 mb-2">Pastikan sesuai dengan hasil dokumen medis.</p>
        <input type="text" name="patient_diagnose" id="patient_diagnose" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh: Penyakit TBC" value="{{ Session::has("step2")? Session::get("step2")["patient_diagnose"]:""}}{{ old("patient_diagnose") }}" >
    </div>
    <div class="flex justify-between">
    
          <a href="{{ route("step1.medical.pasien") }}" class="text-slate-600 hover:text-white border border-slate-400 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-slate-600 dark:text-slate-400 dark:hover:text-white dark:hover:bg-slate-600 dark:focus:ring-slate-800">Sebelumnya</a>

        <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Selanjutnya</button>
    </div>
</form>



</div>

@endsection