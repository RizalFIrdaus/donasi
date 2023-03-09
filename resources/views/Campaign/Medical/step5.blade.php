@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Bantuan Medis dan Kesehatan.</p>
        <p class="text-[20px] font-light mt-6">Judul Campaign</p>
        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700 mt-2">
            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                style="width: 70%"> 70%</div>
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

    <form class="mt-6 w-1/2 mx-auto" method="POST" action="{{ route("store.step5.medical.judul") }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <label for="donation_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beri judul
                untuk galang dana ini</label>
            <input value="{{ Session::has("step5")? Session::get("step5")["donation_title"]:""}}" type="text" name="donation_title" id="donation_title"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Contoh: Bantu adit melawan TBC">
        </div>
        <div class="mb-6">
            <label for="donation_story" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ceritakan lengkap tentang galang dana ini</label>
            <textarea name="donation_story" id="donation_story" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ceritakan tentang dirimu, tentang penyakitnya, upaya pengobatan, keadaan keluarga, kondisi setelah mengidap penyakit, jelaskan alasan membutuhkan dana dan harapan untuk kesembuhan pasien" >{{ Session::has("step5")? Session::get("step5")["donation_story"]:""}} </textarea>
        </div>
        <div class="mb-6">
            <label for="donation_support" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tulis ajakan singkat untuk donasi di galang dana ini (Ajakan)</label>
            <textarea name="donation_support" id="donation_support" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Contoh: Penghasilan saya hanya Rp. 1 juta perhari, padahal anak saya butuh 100 juta untuk membiayai pengobatannya. Bantu saya mengobati penyakit anak saya." >{{ Session::has("step5")? Session::get("step5")["donation_support"]:""}}</textarea>
        </div>
        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                Foto Galang Dana</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                aria-describedby="file_input_help" id="file_input" type="file" name="donation_photo" value="{{ old('donation_photo') }}">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
                800x400px).</p>
            </div>

        <div class="flex justify-between">
            <a href="{{ route("step4.medical.targetdonasi") }}"
                class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800">Sebelumnya</a>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selanjutnya</button>
        </div>
    </form>



</div>

@endsection