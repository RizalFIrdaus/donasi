@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto px-20">
    <div class="text-center">
        <p class="text-[32px] font-semibold">Review Data Campaign</p>
        <p class="text-[20px] font-light mt-2 mb-6">Harap di cek kembali data yang anda masukkan</p>
    </div>
    <div class="flex flex-col gap-4 flex-wrap justify-center items-center">
        <div class="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 w-full">
            <div class="flex justify-between">
                <div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-teal-500 dark:text-white">Status pasien </h5>
                </div>
                <div>
                    <a href="{{ route("step1.medical.pasien") }}" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</a>
                </div>
            </div>
            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Siapa yang sakit ? </h5>

            <p class="font-normal text-gray-700 dark:text-gray-400">
            @if ($step1["pasien"]== "1")
                Saya
            @elseif ($step1["pasien"]== "2")
                Keluarga yang satu kk dengan saya
            @elseif ($step1["pasien"]== "3")
            Keluarga inti yang sudah pisah kk
            @else
                Orang lain
            @endif    
            </p>
        </div>

        <div class="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 w-full">
            <div class="flex justify-between">
                <div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-teal-500 dark:text-white">Data pasien </h5>
                </div>
                <div>
                    <a href="{{ route("step2.medical.tujuan") }}" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</a>
                </div>
            </div>
            <div>
                <div>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Nomor ponsel kamu </h5>
                    <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step2["user_phone"] }}" disabled>
                </div>
            </div>
            @if ($step1["pasien"]=="4")
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Nomor ponsel pasien </h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step2["patient_phone"] }}" disabled>
            </div>
            @endif
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Nama pasien </h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step2["patient_name"] }}" disabled>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Penyakit atau kondisi yang tertera </h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step2["patient_diagnose"] }}" disabled>
            </div>
        </div>

        <div class="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 w-full">
            <div class="flex justify-between">
                <div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-teal-500 dark:text-white">Riwayat Medis </h5>
                </div>
                <div>
                    <a href="{{ route("step3.medical.riwayatmedis") }}" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</a>
                </div>
            </div>
            <div>
                <div>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Apakah pasien
                        sedang menjalani rawat inap di rumah sakit ? </h5>
                    <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step3["inpatient"]=="1" ? "Ya, sedang rawat inap":"Tidak" }}" disabled>
                </div>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Nama rumah
                    sakit </h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step3["hospital"] }}" disabled>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Upaya pengobatan
                    yang sudah atau sedang dilakukan </h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step3["effort"] }}" disabled>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Dari mana sumber biaya pengobatan/perawatan yang telah dilakukan sebelumnya?</h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step3["resource"]=="1"? "Biaya Mandiri" : "Asuransi (BPJS/Swasta)" }}" disabled>
            </div>
        </div>

        <div class="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 w-full">
            <div class="flex justify-between">
                <div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-teal-500 dark:text-white">Target Donasi</h5>
                </div>
                <div>
                    <a href="{{ route("step4.medical.targetdonasi") }}" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</a>
                </div>
            </div>
            <div>
                <div>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Tentukan lama galang dana berlangsung </h5>
                    <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step4["donation_duration"] }} Hari" disabled>
                </div>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Tentukan perkiraan biaya yang dibutuhkan</h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="Rp. {{number_format($step4["donation_amount"],0,',','.');  }}" disabled>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Isi rincihan dana </h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step4["donation_detail"] }}" disabled>
            </div>
        </div>

        <div class="block max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 w-full">
            <div class="flex justify-between">
                <div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-teal-500 dark:text-white">Judul Campaign</h5>
                </div>
                <div>
                    <a href="{{ route("step5.medical.judul") }}" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</a>
                </div>
            </div>
            <div>
                <div>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Beri judul
                        untuk galang dana ini</h5>
                    <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step5["donation_title"] }} Hari" disabled>
                </div>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Ceritakan lengkap tentang galang dana ini</h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step5["donation_story"] }}" disabled>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Tulis ajakan singkat untuk donasi di galang dana ini (Ajakan)</h5>
                <input type="text" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $step5["donation_support"] }}" disabled>
            </div>
            <div>
                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Foto Campaign</h5>
               <img class="h-auto max-w-full" src="{{ isset($temp->donation_photo)?$temp->donation_photo : asset("img/donation_default.jpg") }}" alt="image description">
            </div>
            
        </div>
        <div class="flex justify-end">
            <form action="{{ route("post.review.medical") }}" method="POST">
                @csrf
                <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Ya, sudah sesuai</button>
            </form>
        </div>

    </div>
    


</div>

@endsection