@extends('layouts.errors')

@section('body')
    <div class="text-center">
        <a
            href="https://www.freepik.com/free-vector/403-error-forbidden-concept-illustration_13416125.htm#fromView=author&page=1&position=2&uuid=1770dd53-5728-488d-9499-452899351659">
            <img class="w-96"
                src="https://img.freepik.com/free-vector/403-error-forbidden-concept-illustration_114360-5571.jpg"
                alt="403 error forbidden concept illustration">
        </a>
        <h4 class="">Akses ditolak</h4>
    </div>


    {{-- <div
        class="px-10 py-8 rounded-2xl flex justify-center items-center text-center flex-col shadow-sm border border-neutral-200 md:w-1/2 w-11/12">
        <img src="{{ asset('img/403.png') }}" alt="403 error forbidden (with police) concept illustration (Freepik/storyset)"
            class="mb-5" style="width: 25rem">
        <div class="font-semibold mb-1">Ups! Akses kamu ke halaman ini ditolak.</div>
        <div>Halaman ini hanya dapat diakses oleh pengguna tertentu. Pastikan kamu memiliki hak akses yang sesuai.
        </div>
        <a href="/" class="border rounded-xl mt-3 p-3 flex items-center hover:bg-neutral-800 hover:text-white">
            <i data-feather='chevron-left' class="w-5 mr-1"></i>
            Beranda
        </a>
    </div> --}}
@endsection
