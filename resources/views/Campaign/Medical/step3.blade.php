@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Bantuan Medis dan Kesehatan.</p>
        <p class="text-[20px] font-light mt-6">Riwayat Medis</p>
        <div class="flex justify-between mb-1 mt-6">
            <span class="text-base font-medium text-blue-700 dark:text-white">Status Pasien</span>
            <span class="text-sm font-medium text-blue-700 dark:text-white">{{ Session::has("progress")? Session::get("progress")["data"]: "0"}}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ Session::has("progress")? Session::get("progress")["data"]: "0"}}%"></div>
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
    <form class="mt-6 w-1/2 mx-auto" method="POST" action="{{ route("store.step3.medical.riwayatmedis") }}">
        @csrf
        <div class="mb-6">
            <label for="inpatient" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apakah pasien
                sedang menjalani rawat inap di rumah sakit ?</label>
            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input id="bordered-radio-1" type="radio" value="1" name="inpatient"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{Session::has("step3")&& Session::get("step3")["inpatient"]== "1" ? "checked":"" }}>
                <label for="bordered-radio-1"
                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ya, sedang rawat
                    inap</label>
            </div>
            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input id="bordered-radio-2" type="radio" value="0" name="inpatient"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{Session::has("step3")&& Session::get("step3")["inpatient"]== "0" ? "checked":"" }}>
                <label for="bordered-radio-2"
                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak</label>
            </div>
        </div>
        <div class="mb-6">
            <label for="hospital" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama rumah
                sakit</label>
            <input value="{{ Session::has("step3")? Session::get("step3")["hospital"]:""}}" type="text" name="hospital" id="hospital"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan nama rumah sakit anda dirawat/inap">
        </div>
        <div class="mb-6">
            <label for="effort" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upaya pengobatan
                yang sudah atau sedang dilakukan</label>
            <textarea name="effort" id="effort" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Contoh : Operasi jantung di rumah sakit Pusat Jantung, Terapi di rumah sakit Y, dsb." name="upaya">{{ Session::has("step3")? Session::get("step3")["effort"]:""}}</textarea>
        </div>

        <div class="mb-6">
            <label  for="resource" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dari mana sumber biaya pengobatan/perawatan yang telah dilakukan sebelumnya?</label>
            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input id="bordered-radio-3" type="radio" value="1" name="resource"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"  {{Session::has("step3")&& Session::get("step3")["resource"]== "1" ? "checked":"" }}>
                <label for="bordered-radio-3"
                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Biaya Mandiri</label>
            </div>
            <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input id="bordered-radio-4" {{ Session::has("step3") &&Session::get("step3")["resource"]=="0"? "chacked":""}} type="radio" value="0" name="resource"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{Session::has("step3")&& Session::get("step3")["resource"]== "0" ? "checked":"" }}>
                <label for="bordered-radio-4"
                    class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Asuransi (BPJS/Swasta)</label>
            </div>
        </div>

        <div class="flex justify-between">
            <a href="{{ route("step2.medical.tujuan") }}"
                class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Sebelumnya</a>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selanjutnya</button>
        </div>
    </form>



</div>

@endsection