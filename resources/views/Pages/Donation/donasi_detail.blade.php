@extends('Layouts.app')

@section('app')
<div class="flex flex-row px-32 justify-center">
    <div class="mr-10">
        <img class="h-[400px] w-[600px] rounded-lg" src="{{ $campaign->donation_photo }}" alt="image description">
        <p class="font-semibold text-2xl mt-6">{{ ucwords($campaign->donation_title) }}</p>
        <span
            class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Kesehatan</span>
        <span
            class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Jakarta</span>

        <p class="font-light text-md max-w-[600px] mt-2">{{ $campaign->donation_support }}</p>
        <p class="font-semibold text-blue-700 text-2xl max-w-[600px] mt-2">Rp
            {{ number_format( $campaign->donation_amount,0,',',',') }}
        </p>
        <div class="flex justify-between items-center mb-1 mt-1">
            <span class="font-light dark:text-white">Dana terkumpul dari <span class="font-semibold text-blue-700"> Rp
                    {{ number_format($campaign->donation_amount+100000000,0,',','.') }}</span>
            </span>
            <span class="text-2xl font-medium text-blue-700 dark:text-white">{{ $duration_left }} <span class="font-light text-sm">Hari
                    Lagi</span></span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 10%"></div>
        </div>
        <div class="user_campaign flex items-center mt-4">
            <a href="" class="flex items-center">
                <img class="rounded-full w-10 h-10 mr-2" src="{{ $campaign->user->photo }}" alt="image description">
                <p>{{ $campaign->user->fullname }}</p>
            </a>
        </div>
        <div class="cta my-4 flex flex-row">
            <button type="button"
                class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-32 py-2.5 text-center mr-2 mb-2">Donasi
                Sekarang</button>
            <button type="button"
                class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-orange-300 dark:focus:ring-orange-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2 mb-2">Bagikan</button>

        </div>
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="kisah-tab" data-tabs-target="#kisah"
                        type="button" role="tab" aria-controls="kisah" aria-selected="false">Kisah</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="berita-tab" data-tabs-target="#berita"
                        type="button" role="tab" aria-controls="berita" aria-selected="false">Berita</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="donatur-tab"
                        data-tabs-target="#donatur" type="button" role="tab" aria-controls="donatur"
                        aria-selected="false">Donatur</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 w-[600px]" id="kisah" role="tabpanel"
                aria-labelledby="kisah-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $campaign->donation_story }}</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 w-[600px]" id="berita" role="tabpanel"
                aria-labelledby="berita-tab">
                <a href="#"
                    class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <p class="font-normal text-gray-700 dark:text-gray-400">1 Minggu lalu</p>
                    <h5 class="my-1 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">Pencairan dana
                        sebesar <span class="font-bold">Rp. 7,000,000</span></h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">Akan diserahkan ke Masjid.</p>
                </a>

                {{-- <img class="h-auto max-w-full" src="{{ asset("img/nonews.jpg") }}"
                alt="image description"> --}}
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 w-[600px]" id="donatur" role="tabpanel"
                aria-labelledby="donatur-tab">
                <a href="#"
                    class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <div class="donation flex items-center">
                        <img class="rounded-full w-10 h-10 mr-2" src="{{ $campaign->user->photo }}"
                            alt="image description">
                        <div class="detail">
                            <p class="font-semibold text-gray-700 dark:text-gray-400">
                                {{ $campaign->user->fullname }}</p>
                            <p class="font-light text-gray-700 dark:text-gray-400">Berdonasi sebesar <span
                                    class="font-semibold">Rp
                                    {{ number_format($campaign->donation_amount,0,',','.') }}</span>
                            </p>
                            <p class="font-light text-sm text-gray-700 dark:text-gray-400">9 menit yang lalu</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <div class="">
        <p class="text-xl font-semibold">Campaign Serupa</p>
        <div class="flex my-4">
            <hr class="w-10 h-1 mr-2 bg-blue-700 border-0 rounded  dark:bg-gray-700">
            <hr class="w-full h-1 bg-slate-200 border-0 rounded  dark:bg-gray-700">
        </div>
        <div>
            <a href="#"
                class="flex my-4 items-center hover:bg-white border hover:border-gray-200 hover:rounded-lg hover:shadow flex-row md:max-w-xl">
                <img class="object-cover w-20 rounded-t-lg h-96 md:h-auto md:rounded-none md:rounded-l-lg"
                    src="{{ asset("img/nonews.jpg") }}" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="text-md font-bold tracking-tight text-gray-900 dark:text-white">Bangun Masjid</h5>
                    <p class="mb-3 text-sm font-light text-gray-700 dark:text-gray-400">Terkumpul Rp 25,000,000</p>
                </div>
            </a>
            <a href="#"
                class="flex my-4 items-center hover:bg-white border hover:border-gray-200 hover:rounded-lg hover:shadow flex-row md:max-w-xl">
                <img class="object-cover w-20 rounded-t-lg h-96 md:h-auto md:rounded-none md:rounded-l-lg"
                    src="{{ asset("img/nonews.jpg") }}" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="text-md font-bold tracking-tight text-gray-900 dark:text-white">Bangun Masjid</h5>
                    <p class="mb-3 text-sm font-light text-gray-700 dark:text-gray-400">Terkumpul Rp 25,000,000</p>
                </div>
            </a>
            <a href="#"
                class="flex my-4 items-center hover:bg-white border hover:border-gray-200 hover:rounded-lg hover:shadow flex-row md:max-w-xl">
                <img class="object-cover w-20 rounded-t-lg h-96 md:h-auto md:rounded-none md:rounded-l-lg"
                    src="{{ asset("img/nonews.jpg") }}" alt="">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="text-md font-bold tracking-tight text-gray-900 dark:text-white">Bangun Masjid</h5>
                    <p class="mb-3 text-sm font-light text-gray-700 dark:text-gray-400">Terkumpul Rp 25,000,000</p>
                </div>
            </a>
            <p class="text-xl font-semibold">Kategori Lainnya</p>
            <div class="flex my-4">
                <hr class="w-10 h-1 mr-2 bg-blue-700 border-0 rounded  dark:bg-gray-700">
                <hr class="w-full h-1 bg-slate-200 border-0 rounded  dark:bg-gray-700">
            </div>
            <div class="w-[300px] flex flex-wrap">
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Balita</a>
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Tempat
                    Ibadah</a>
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Pendidikan</a>
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Panti
                    Sosial</a>
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Hewan</a>
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Bencana
                    Alam</a>
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Modal
                    Usaha</a>
                <a href="#"
                    class="bg-blue-100 my-2 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Orang
                    Tidak Mampu</a>
            </div>

            <div class="mt-10 w-[300px]">
                <a href="#"
                    class="block max-w-sm p-6 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg shadow hover:bg-gray-100 ">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-white">Kamu Ingin
                        Menggalang Dana ?</h5>
                    <p class="font-light text-white dark:text-gray-400">Hay #orangbaik, kamu juga bisa membuat penggalangan dana seperti ini juga loh.</p>
                    <button type="button" class=" mt-4 text-white border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                        Galang Dana
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Icon description</span>
                      </button>
                </a>

            </div>
        </div>
    </div>
</div>
@endsection