@extends('Layouts.app')

@section('app')
<div class="flex flex-row">
    @include('Layouts.akun.sidebar')
    <div class="ml-6 w-full">
        <p class="font-semibold text-[24px] mt-6">Dompet</p>
        <p class="font-light text-[18px] mb-2">Topup dompetmu untuk melakukan donasi</p>
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
     <p>Rp {{ number_format($snapToken["payment"]["amount"],0,',',',') }}</p>
     <button id="pay-button" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Pilih metode pembayaran</button>
    </div>
@push('scripts')
<script>
 // For example trigger on button clicked, or any time you need
 var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay("{{ $snapToken['snapToken'] }}", {
            onSuccess: function(result){
              /* You may add your own implementation here */
              window.location.href ="/user/wallet";
            },
            onPending: function(result){
              /* You may add your own implementation here */
              alert("Menunggu Pembayaran!"); console.log(result);
            },
            onError: function(result){
              /* You may add your own implementation here */
              alert("Pembayaran Gagal!"); console.log(result);
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('Kamu menutup topup dan tidak ada transaksi yang diproses');
            }
          })
        });
</script>
@endpush

@endsection

