@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Bantuan Medis dan Kesehatan.</p>
        <div class="flex justify-between mb-1 mt-6">
            <span class="text-base font-medium text-blue-700 dark:text-white">Status Pasien</span>
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
    <p class="font-semibold text-[18px] mt-6">Siapa yang sakit ?</p>
    <p class="font-light text-sm text-slate-600">Orang yang akan mendapatkan bantuan.</p>
    <form method="POST" action="{{ route("store.step1.medical.pasien") }}">
        @csrf
        <div class="my-4">
            <div class="flex hover:text-white hover:bg-blue-600 items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input
                    {{ Session::has("step1")&&Session::get("step1")["pasien"]== "1" ? "checked":"" }}
                    id="bordered-radio-1" type="radio" value="1" name="pasien"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-1"
                    class="w-full  py-4 ml-2 text-sm font-medium  dark:text-gray-300">Saya</label>
            </div>
            <div class="flex hover:bg-blue-600 hover:text-white items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                <input
                    {{ Session::has("step1")&& Session::get("step1")["pasien"]== "2" ? "checked":"" }}
                    id="bordered-radio-2" type="radio" value="2" name="pasien"
                    class="w-4 h-4 text-blue-600  bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-2"
                    class="w-full  py-4 ml-2 text-sm font-medium  dark:text-gray-300">Keluarga yang satu kk
                    dengan saya</label>
            </div>
            <div class="flex hover:text-white hover:bg-blue-600 items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                <input
                    {{Session::has("step1")&& Session::get("step1")["pasien"]== "3" ? "checked":"" }}
                    id="bordered-radio-3" type="radio" value="3" name="pasien"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-3"
                    class="w-full  py-4 ml-2 text-sm font-medium  dark:text-gray-300">Keluarga inti yang
                    sudah pisah kk</label>
            </div>
            <div class="flex hover:text-white hover:bg-blue-600 items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                <input
                    {{ Session::has("step1")&&Session::get("step1")["pasien"]== "4" ? "checked":"" }}
                    id="bordered-radio-4" type="radio" value="4" name="pasien"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="bordered-radio-4"
                    class="w-full  py-4 ml-2 text-sm font-medium  dark:text-gray-300">Orang lain</label>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Selanjutnya</button>
        </div>
    </form>

</div>

@endsection