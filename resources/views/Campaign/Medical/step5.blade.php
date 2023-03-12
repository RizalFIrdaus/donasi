@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Bantuan Medis dan Kesehatan.</p>
        <div class="flex justify-between mb-1 mt-6">
            <span class="text-base font-medium text-blue-700 dark:text-white">Data Campaign</span>
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

    <form class="mt-6 w-full mx-auto" method="POST" action="{{ route("store.step5.medical.judul") }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="donation_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beri judul
                untuk galang dana ini</label>
                <p class="font-light text-sm text-slate-600 mb-2">Ini merupakan judul galang donasi mu yang akan ditampilkan.</p>
            <input value="{{ Session::has("step5")? Session::get("step5")["donation_title"]:""}}{{ old("donation_title") }}" type="text" name="donation_title" id="donation_title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Contoh: Bantu adit melawan TBC">
        </div>
        <div class="mb-6">
            <label for="donation_story" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ceritakan lengkap tentang galang dana ini</label>
            <p class="font-light text-sm text-slate-600 mb-2">Ceritakan tentang dirimu, tentang penyakitnya, upaya pengobatan, keadaan keluarga, kondisi setelah mengidap penyakit, jelaskan alasan membutuhkan dana dan harapan untuk kesembuhan pasien.</p>
            <textarea name="donation_story" id="donation_story" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" >{{ Session::has("step5")? Session::get("step5")["donation_story"]:""}} </textarea>
        </div>
        <div class="mb-6">
            <label for="donation_support" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tulis ajakan singkat untuk donasi di galang dana ini (Ajakan)</label>
            <p class="font-light text-sm text-slate-600 mb-2">Ajakan ini akan tampil ketika kamu membagi link.</p>
            <textarea name="donation_support" id="donation_support" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Contoh: Penghasilan saya hanya Rp. 1 juta perhari, padahal anak saya butuh 100 juta untuk membiayai pengobatannya. Bantu saya mengobati penyakit anak saya." >{{ Session::has("step5")? Session::get("step5")["donation_support"]:""}}</textarea>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                Foto Galang Dana</label>
                <p class="font-light text-sm text-slate-600 mb-2">Pastikan menggunakan foto pasien.</p>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                aria-describedby="file_input_help" id="file_input" type="file" name="donation_photo" value="{{ old('donation_photo') }}">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
                800x400px).</p>
            </div>
            @if (isset($temp->donation_photo))
                <img class="h-auto max-w-full mb-5" src="{{ isset($temp->donation_photo)?$temp->donation_photo : asset("img/donation_default.jpg") }}" alt="image description">
            @endif

        <div class="flex justify-between">
            <a href="{{ route("step4.medical.targetdonasi") }}" class="text-slate-600 hover:text-white border border-slate-400 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-slate-600 dark:text-slate-400 dark:hover:text-white dark:hover:bg-slate-600 dark:focus:ring-slate-800">Sebelumnya</a>

            <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Selanjutnya</button>
        </div>
    </form>



</div>

@endsection