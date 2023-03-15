@extends('Layouts.app')

@section('app')
    <div class="container mt-24 mx-auto">
        <div class="banner bg-gradient-to-r from-cyan-500 to-blue-500 w-full h-auto px-4 py-5">
          <p class="text-white font-bold text-[32px]">Donasi bantuan medis</p>
          <p class="text-white font-normal text-[18px] w-3/4">Salurkan bantuan anda, bantu kesembuhan para pasien ini dengan menyumbang mulai dari Rp 1.000</p>
        </div>
        <div class="donation flex flex-col w-full">
           @forelse($campaigns as $campaign)
           <a
           href="{{ url("/donation/$campaign->donation_slug") }}" class="mt-4 items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-lg hover:bg-gray-100  dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
           <div class="flex flex-col ">
               <div class="flex flex-row">
                   <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                       src="{{ $campaign->donation_photo?? asset("img/donation_default.jpg") }}" alt="">
                   <div class="flex w-full flex-col justify-between p-4 leading-normal">
                       <h5
                           class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                           {{ $campaign->donation_title }}</h5>
                           
                            <div class="flex justify-between mb-1 mt-6">
                               <span class="text-base font-medium text-blue-700 dark:text-white">Dana terkumpul</span>
                               <span class="text-sm font-medium text-blue-700 dark:text-white">32 Hari lagi</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 20%"></div>
                            </div>
                            <p class="mt-4 font-semibold text-gray-700 dark:text-gray-400">Rp {{ number_format($campaign->donation_amount,0,',','.') }}</p>
                            
                   </div>
               </div>
           </div>
       </a>
        @empty

           @endforelse
        </div>
    </div>
@endsection