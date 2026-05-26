@extends('layouts.app')

@section('slot')
    <div class="flex flex-col items-center">
        <a
            href="https://www.freepik.com/free-vector/404-error-lost-space-concept-illustration_20602746.htm#fromView=author&page=1&position=46&uuid=3b554396-4e97-40e6-b051-26512b33172a">
            <img class="w-96"
                src="https://img.freepik.com/free-vector/404-error-lost-space-concept-illustration_114360-7891.jpg"
                alt="404 error lost in space concept illustration (Freepik/storyset)">
        </a>
        <h4 class="">{{ $exception->getMessage() ?? 'Halaman tidak ditemukan' }}</h4>
    </div>
@endsection
