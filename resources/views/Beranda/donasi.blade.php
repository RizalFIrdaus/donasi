@extends('Layouts.app')

@section('app')
<div class="container mt-24 mx-auto">
    <div class="banner bg-gradient-to-r from-cyan-500 to-blue-500 w-full h-auto px-4 py-16">
        <p class="text-white font-bold text-[32px]">Donasi bantuan medis</p>
        <p class="text-white font-normal text-[18px] w-3/4 mt-2">Salurkan bantuan anda, bantu kesembuhan para pasien ini
            dengan menyumbang mulai dari Rp 1.000</p>
    </div>
    <div class="donation flex gap-6 w-full">
        @forelse($campaigns as $key =>$campaign)
            <div
                class="w-[300px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-8">
                <a href="{{ url("donation/$campaign->donation_slug") }}">
                    <img class="rounded-t-lg"
                        src="{{ $campaign->donation_photo?? asset("img/donation_default.jpg") }}"
                        alt="" />
                </a>
                <div class="p-5">
                    <a href="{{ url("donation/$campaign->donation_slug") }}">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ ucwords($campaign->donation_title) }}</h5>
                    </a>
                    <div class="flex justify-between mb-1 mt-6">
                        <span class="text-base font-medium text-blue-700 dark:text-white">Dana terkumpul</span>
                        <span class="text-sm font-medium text-blue-700 dark:text-white">{{ $duration_left[$key] }} Hari lagi</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 20%"></div>
                    </div>
                    <p class="mt-2 font-semibold text-gray-700 dark:text-gray-400">Rp
                        {{ number_format($campaign->donation_amount,0,',','.') }}
                    </p>
                    <hr class="h-px my-2 w-full bg-gray-200 border-0 dark:bg-gray-700">
                    <div class="flex items-center">
                        <img class="rounded-full w-8 h-8 mr-2" src="{{ $campaign->user->photo }}"
                            alt="image description">
                        <p class="font-semibold text-md">{{ $campaign->user->fullname }}</p>
                    </div>
                </div>
            </div>
        @empty

        @endforelse
    </div>
</div>
@endsection