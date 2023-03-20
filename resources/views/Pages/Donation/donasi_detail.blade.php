@extends('Layouts.app')

@section('app')
<div class="flex flex-row px-32 justify-center">
    <div class="mr-10">
        @if($errors->any())
            <div class="my-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has("message"))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">Success alert!</span> {{ Session::get("message") }}
            </div>
        @endif
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
                    {{ number_format($campaign->transaction->current_amount,0,',','.') }}</span>
            </span>
            <span class="text-2xl font-medium text-blue-700 dark:text-white">{{ $duration_left }} <span
                    class="font-light text-sm">Hari
                    Lagi</span></span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
        </div>
        <div class="user_campaign flex items-center mt-4">
            <a href="" class="flex items-center">
                <img class="rounded-full w-10 h-10 mr-2" src="{{ $campaign->user->photo }}" alt="image description">
                <p>{{ $campaign->user->fullname }}</p>
            </a>
        </div>
        <div class="cta my-4 flex flex-row">
            <button data-modal-target="add_donation" data-modal-toggle="add_donation" type="button"
                class="w-full text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-32 py-2.5 text-center mr-2 mb-2">Donasi
                Sekarang</button>
            <button type="button" data-modal-target="share" data-modal-toggle="share"
                class="share text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-orange-300 dark:focus:ring-orange-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-10 py-2.5 text-center mr-2 mb-2">Bagikan</button>
                

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
                @forelse ($donation_user as $key =>$donation)
                    <a href="#"
                        class="mt-4 block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <div class="donation flex items-center">
                            <img class="rounded-full w-10 h-10 mr-6" src="{{ $donation->user->photo }}"
                                alt="image description">
                            <div class="detail">
                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                    {{ $donation->user->fullname }}
                                </p>
                                 <p class="font-light text-gray-700 dark:text-gray-400">{{ $donation->message }}
                                </p>
                                <p class="font-light text-gray-700 dark:text-gray-400">Berdonasi sebesar <span
                                        class="font-semibold">Rp
                                        {{ number_format($donation->donation_amount,0,',','.') }}</span>
                                </p>
                                <p class="font-light text-sm text-gray-700 dark:text-gray-400">{{ $timeline[$key] == 0 ?$timeline[$key] : "Beberapa waktu " }} yang lalu</p>
                            </div>
                        </div>
                    </a>
                @empty
                <a href="#"
                class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="donation flex items-center">
                    <div class="detail">
                        <p class="font-light text-gray-700 dark:text-gray-400">Belum ada donatur, ayo jadi orang pertama yang donasi
                        </p>
                    </div>
                </div>
            </a>
                @endforelse
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
                    <p class="font-light text-white dark:text-gray-400">Hay #orangbaik, kamu juga bisa membuat
                        penggalangan dana seperti ini juga loh.</p>
                    <button type="button"
                        class=" mt-4 text-white border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                        Galang Dana
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Icon description</span>
                    </button>
                </a>

            </div>
        </div>
    </div>
</div>

<!-- Main modal -->
<div id="add_donation" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="add_donation">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                @if(Auth::user())
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Masukkan jumlah donasimu</h3>
                    @if(isset($profile->wallet->wallet))
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Dompetmu : Rp
                            {{ number_format( $profile->wallet->wallet,0,',',',') }}
                        </h3>
                        <form class="space-y-6"
                            action="{{ url("donation/$campaign->donation_slug/send/donation") }}"
                            method="POST">
                            @csrf
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="donation_amount" id="donation_amount"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="donation_amount"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah
                                    Donasi</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="message" id="message"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="message"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Masukkan
                                    pesan</label>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Donasikan</button>
                            </div>
                        </form>
                    @else
                        <a href="{{ route("change-profile") }}"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Isi
                            profile kamu terlebih dahulu untuk lanjut donasi</a>
                    @endif
                @else
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Login akun dan isi dompetmu untuk
                        donasi</h3>
                    <form class="space-y-4 md:space-y-6" action="{{ route("doLogin") }}"
                        method="POST">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="emailkamu@gmail.com" value="{{ old("email") }}">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input name="remember" id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a href="#"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Lupa
                                password?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-teal-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Masuk</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Kamu belum punya akun? <a href="/user/register"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">ayo
                                daftar</a>
                        </p>


                    </form>
                @endif

            </div>
        </div>
    </div>
</div>


   <!-- Main modal -->
   <div id="share" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="share">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                <span class="sr-only">Close modal</span>
            </button>
            <!-- Modal header -->
            <div class="px-6 py-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-base font-semibold text-gray-900 lg:text-xl dark:text-white">
                    Bagikan donasi ini
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6">
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Bantu orang yang membutuhkan dengan membagi link ini.</p>
                <ul class="my-4 space-y-3">
                    <li>
                        <button data-clipboard-text="{{ url('/donation/').$campaign->donation_slug }}" class="flex w-full clipboard items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <span class="flex-1 ml-3 whitespace-nowrap">Salin link</span>
                        </bu>
                    </li>
                </ul>
                <div>
                    <a href="#" class="inline-flex items-center text-xs font-normal text-gray-500 hover:underline dark:text-gray-400">
                        <svg aria-hidden="true" class="w-3 h-3 mr-2" aria-hidden="true" focusable="false" data-prefix="far" data-icon="question-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 448c-110.532 0-200-89.431-200-200 0-110.495 89.472-200 200-200 110.491 0 200 89.471 200 200 0 110.53-89.431 200-200 200zm107.244-255.2c0 67.052-72.421 68.084-72.421 92.863V300c0 6.627-5.373 12-12 12h-45.647c-6.627 0-12-5.373-12-12v-8.659c0-35.745 27.1-50.034 47.579-61.516 17.561-9.845 28.324-16.541 28.324-29.579 0-17.246-21.999-28.693-39.784-28.693-23.189 0-33.894 10.977-48.942 29.969-4.057 5.12-11.46 6.071-16.666 2.124l-27.824-21.098c-5.107-3.872-6.251-11.066-2.644-16.363C184.846 131.491 214.94 112 261.794 112c49.071 0 101.45 38.304 101.45 88.8zM298 368c0 23.159-18.841 42-42 42s-42-18.841-42-42 18.841-42 42-42 42 18.841 42 42z"></path></svg>
                        Why do I need to connect with my wallet?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    new ClipboardJS('.clipboard');
</script>
@endpush
@endsection
