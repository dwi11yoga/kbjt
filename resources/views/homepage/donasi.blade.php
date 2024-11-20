@extends('.../layouts/homepage-with-banner')

@section('body')
    <h3 class="mb-3 font-bold">Donasi</h3>
    <p class="mb-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rerum, accusantium veniam quisquam
        doloremque quo quasi aliquid asperiores recusandae illum.</p>

    <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
        {{-- Select metode pembayaran --}}
        <label for="metode-pembayaran" class="block mb-2 text-sm font-medium text-gray-800">Metode
            donasi</label>
        <form action="" class="relative justify-between">
            <select name="metode-pembayaran" id="metode-pembayaran"
                class="w-full py-3 px-5 rounded-md bg-white border border-gray-200 cursor-pointer appearance-none">
                <option value="qris" selected>QRIS</option>
                <option value="dana">Dana</option>
                <option value="gopay">Gopay</option>
                <option value="ovo">OVO</option>
                <option value="shopeepay">ShopeePay</option>
            </select>
            <span class="absolute flex right-4 top-3"><i data-feather='chevron-down'></i></span>
        </form>

        {{-- QRIS --}}
        <div class="grid grid-cols-4 md:space-x-5 mt-5 md:space-y-0 space-y-5">
            <div class="md:col-span-1 col-span-4">
                <div class="rounded-2xl bg-gray-200 w-full h-60"></div>
            </div>
            <div class="md:col-span-3 col-span-4">
                <div class="font-semibold">Cara donasi</div>
                <ul class="list-decimal ml-5">
                    <li>Lorem, ipsum dolor.</li>
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Lorem ipsum dolor sit.</li>
                    <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum, quisquam?</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
                    <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</li>
                    <li>Lorem, ipsum.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
