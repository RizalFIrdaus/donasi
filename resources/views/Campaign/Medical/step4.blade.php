@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Bantuan Medis dan Kesehatan.</p>
        <div class="flex justify-between mb-1 mt-6">
            <span class="text-base font-medium text-blue-700 dark:text-white">Target Donasi</span>
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

    <form id="target_donasi" class="mt-6 w-full mx-auto" method="POST" action="{{ route("store.step4.medical.targetdonasi") }}">
        @csrf
        <div class="mb-6">
            <label for="donation_duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tentukan lama galang dana berlangsung</label>
            <p class="font-light text-sm text-slate-600 mb-2">Dana bantuan akan bisa cair ketika galang dana selesai, maka dari itu pilih durasi galang dana dengan bijak.</p>
            <div class="flex hover:text-white hover:bg-blue-600 items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input {{ old("donation_duration")=="30"?"checked":"" }} id="bordered-radio-1" type="radio" value="30" name="donation_duration"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{Session::has("step4")&& Session::get("step4")["donation_duration"]== "30" ? "checked":"" }}>
                <label for="bordered-radio-1"
                    class="w-full py-4 ml-2 text-sm font-medium dark:text-gray-300">30 Hari</label>
            </div>
            <div class="flex hover:text-white hover:bg-blue-600 items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input {{ old("donation_duration")=="60"?"checked":"" }} id="bordered-radio-2" type="radio" value="60" name="donation_duration"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{Session::has("step4")&& Session::get("step4")["donation_duration"]== "60" ? "checked":"" }}>
                <label for="bordered-radio-2"
                    class="w-full py-4 ml-2 text-sm font-medium dark:text-gray-300">60 Hari</label>
                    
            </div>
            <div class="flex hover:text-white hover:bg-blue-600 items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mt-4">
                <input {{ old("donation_duration")=="120"?"checked":"" }} id="bordered-radio-3" type="radio" value="120" name="donation_duration"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{Session::has("step4")&& Session::get("step4")["donation_duration"]== "120" ? "checked":"" }}>
                <label for="bordered-radio-3"
                    class="w-full py-4 ml-2 text-sm font-medium dark:text-gray-300">120 Hari</label>
            </div>
        </div>
        <div class="mb-6">
            <label for="donation_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tentukan perkiraan biaya yang dibutuhkan</label>
            <p class="font-light text-sm text-slate-600 mb-2">Masukkan jumlah kebutuhan biaya.</p>
            <input value="{{ Session::has("step4")? Session::get("step4")["donation_amount"]:""}}"  type="text" name="donation_amount" id="donation_amount"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Contoh : 50000" >
        </div>
        <div class="mb-6">
            <label for="donation_detail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Isi rincihan dana</label>
            <p class="font-light text-sm text-slate-600 mb-2">Pastikan rincih semua total donasi disini.</p>
            <textarea name="donation_detail" id="donation_detail" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Contoh : Membeli vitamin Rp 2.000.000, membeli obat Rp 3.000.000, dst" >{{ Session::has("step4")? Session::get("step4")["donation_detail"]:""}}</textarea>
        </div>
        <div class="flex justify-between">
            <a href="{{ route("step3.medical.riwayatmedis") }}" class="text-slate-600 hover:text-white border border-slate-400 hover:bg-slate-600 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-slate-600 dark:text-slate-400 dark:hover:text-white dark:hover:bg-slate-600 dark:focus:ring-slate-800">Sebelumnya</a>

            <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Selanjutnya</button>
        </div>
    </form>
</div>


@endsection
