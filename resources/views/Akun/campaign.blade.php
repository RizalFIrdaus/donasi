@extends('Layouts.app')

@section('app')
<div class="flex flex-row">
    @include('Layouts.akun.sidebar')
    <div class="ml-6 w-full">
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
        @if ($errors->any())
        <div class="flex mt-4 p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">Info alert!</span> 
              @foreach ($errors->all() as $error)
              {{ $error }}
           @endforeach
            </div>
          </div>
     @endif
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
                    <div class="scrolling-pagination">
                    @forelse($campaigns_na as $campaign)
                        <div
                            class="mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="flex flex-col">
                                <div class="flex flex-row">
                                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                        src="{{ $campaign->donation_photo?? asset("img/donation_default.jpg") }}" alt="">
                                    <div class="flex flex-col justify-between p-4 leading-normal">
                                        <h5
                                            class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                            {{ $campaign->donation_title }}</h5>
                                        <p class="mt-4 font-semibold text-gray-700 dark:text-gray-400">Butuh Bantuan :  Rp {{ number_format($campaign->donation_amount,0,',','.') }}</p>
                                        <p class="mb-3 font-semibold text-gray-700 dark:text-gray-400">Selama : {{ $campaign->donation_duration }} Hari</p>
                                        <div class="mt-2 flex items-center">
                                            <form action="{{ url("user/campaign/review/$campaign->id") }}" method="POST" class="mr-2">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Review
                                                    Campaign</button>
                                            </form>
                                            <form action="{{ url("user/campaign/delete/$campaign->id") }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Hapus</button>
                                            </form>
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
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="aktif" role="tabpanel"
                    aria-labelledby="aktif-tab">
                    @forelse ($campaigns_a as $campaign)
                    <div
                        class="mt-4 flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="flex flex-col">
                            <div class="flex flex-row">
                                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                    src="{{ $campaign->donation_photo??asset("img/donation_default.jpg") }}" alt="">
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $campaign->donation_title }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $campaign->donation_story }}</p>
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
                                    src="{{ $campaign->donation_photo??asset("img/donation_default.jpg") }}" alt="">

                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $campaign->donation_title }}</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $campaign->donation_story }}</p>
                                    <div class="mt-2">
                                        <form class="mr-2" action="{{ url("user/campaign/active/$campaign->id") }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="text-white w-full bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Batalkan</button>
                                        </form>
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
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('ul.pagination').hide();
        $('.scrolling-pagination').jscroll({
                autoTrigger: true,
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.scrolling-pagination',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
});
    
</script>
@endpush

@endsection

