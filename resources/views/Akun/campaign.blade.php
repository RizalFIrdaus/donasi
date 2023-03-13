@extends('Layouts.app')

@section('app')
<div class="flex flex-row">
    @include('Layouts.akun.sidebar')
    <div class="ml-6 w-full">
        @if(Session::has("message"))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside">
                    <li>{{ Session::get("message") }}</li>
                </ul>
            </div>
        @endif
        <p class="font-semibold text-[24px] mt-6">Campaign</p>
        <p class="font-light text-[18px] mb-2">Data campaignmu</p>
        <a href="{{ route("galang-dana") }}"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Buat baru galang dana
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" class="pl-2">
                <rect x="9" y="0" width="6" height="24" fill="#ffffff" />
                <rect x="0" y="9" width="24" height="6" fill="#ffffff" />
            </svg>
        </a>
        <div class="mt-4">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                    data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="noaktif-tab"
                            data-tabs-target="#noaktif" type="button" role="tab" aria-controls="noaktif"
                            aria-selected="false">Tidak Aktif</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="aktif-tab"
                            data-tabs-target="#aktif" type="button" role="tab" aria-controls="aktif"
                            aria-selected="false">Aktif</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="review-tab"
                            data-tabs-target="#review" type="button" role="tab" aria-controls="review"
                            aria-selected="false">Sedang direview</button>
                    </li>
                </ul>
            </div>
            <div id="myTabContent">
                <div class="hidden p-4 bg-gray-50 dark:bg-gray-800 rounded-lg" id="noaktif" role="tabpanel" aria-labelledby="noaktif-tab">
                    @forelse($campaigns_na as $campaign)
                        <div
                            class="mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="flex flex-col">
                                <div class="flex flex-row">
                                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                        src="{{ $campaign->donation_photo?? asset("img/donation_default.jpg") }}" alt="">
                                    <div class="flex flex-col justify-between p-4 leading-normal">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $campaign->donation_title }}</h5>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"> {{ $campaign->donation_story }}</p>
                                        <div class="mt-2 flex items-center">
                                            <button type="button"
                                                class="w-1/2 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Review
                                                Campaign</button>
                                            <button type="button"
                                                class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <img class="h-auto w-full" src="{{ asset("img/nodata.jpg") }}" alt="image description">
                    @endforelse
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="aktif" role="tabpanel"
                    aria-labelledby="aktif-tab">
                    @forelse ($campaigns_a as $campaign)
                    <div
                        class="mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                    src="{{ asset("img/donation_default.jpg") }}" alt="">

                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Bantu adit melawan sakit hati ditinggal kekasih</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest
                                        enterprise
                                        technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                    <div class="mt-2">
                                        <button type="button"
                                            class="w-full text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Lihat
                                            Campaign</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <img class="h-auto w-full" src="{{ asset("img/nodata.jpg") }}" alt="image description">
                    @endforelse
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="review" role="tabpanel"
                    aria-labelledby="review-tab">
                    @forelse ($campaigns_r as $campaign)
                    <div
                        class="mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                    src="{{ asset("img/donation_default.jpg") }}" alt="">

                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Bantu adit melawan sakit hati ditinggal kekasih</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest
                                        enterprise
                                        technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                    <div class="mt-2">
                                        <button type="button"
                                            class="text-white w-full bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <img class="h-auto w-full" src="{{ asset("img/nodata.jpg") }}" alt="image description">
                    @endforelse
                </div>
            </div>


        </div>

    </div>

</div>
@endsection