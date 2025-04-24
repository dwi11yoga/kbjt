@if (session('failed'))
    <div id="failed"
        class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-50 bg-white shadow-md p-4 w-full max-w-sm text-gray-800 flex justify-between items-start rounded-lg">
        <div class="flex items-center">
            <div class="inline-block rounded-md bg-red-200 py-1 px-1.5 mr-4"><i data-feather='alert-triangle'
                    class="text-red-700 w-5"></i>
            </div>
            <div class="flex items-start text-sm">
                {{ session('failed') }}
            </div>
        </div>
        <button id="close_failed"
            class="ml-4 py-1 px-1.5 rounded-md hover:bg-gray-300 focus:outline focus:outline-2 focus:outline-gray-400"><i
                data-feather='x' class="text-gray-700 w-5"></i></button>
    </div>

    <script>
        const toast = document.getElementById('failed');
        const close_failed = document.getElementById('close_failed');

        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 320);
        }, 4000); //4 detik

        close_failed.addEventListener('click', function() {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 320);
        })
    </script>

@elseif (session('success'))
    <div id="success"
        class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-50 bg-white shadow-md p-4 w-full max-w-sm text-gray-800 flex justify-between items-start rounded-lg">
        <div class="flex items-center">
            <div class="inline-block rounded-md bg-green-200 py-1 px-1.5 mr-4"><i data-feather='check-circle'
                    class="text-green-700 w-5"></i>
            </div>
            <div class="flex items-start text-sm">
                {{ session('success') }}
            </div>
        </div>
        <button id="close_success"
            class="ml-4 py-1 px-1.5 rounded-md hover:bg-gray-300 focus:outline focus:outline-2 focus:outline-gray-400"><i
                data-feather='x' class="text-gray-700 w-5"></i></button>
    </div>

    <script>
        const toast = document.getElementById('success');
        const close_success = document.getElementById('close_success');

        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 320);
        }, 4000); //4 detik

        close_success.addEventListener('click', function() {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 320);
        })
    </script>

@elseif (session('notifikasi'))
<div id="notifikasi"
    class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-50 bg-white shadow-md p-4 w-full max-w-sm text-gray-800 flex justify-between items-start rounded-lg">
    <div class="flex items-center">
        <div class="inline-block rounded-md bg-amber-200 py-1 px-1.5 mr-4"><i data-feather='bell'
                class="text-amber-700 w-5"></i>
        </div>
        <div class="flex items-start text-sm">
            {{ session('notifikasi') }}
        </div>
    </div>
    <button id="close_notifikasi"
        class="ml-4 py-1 px-1.5 rounded-md hover:bg-gray-300 focus:outline focus:outline-2 focus:outline-gray-400"><i
            data-feather='x' class="text-gray-700 w-5"></i></button>
</div>

<script>
    const toast = document.getElementById('notifikasi');
    const close_notifikasi = document.getElementById('close_notifikasi');

    setTimeout(() => {
        toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 320);
    }, 4000); //4 detik

    close_notifikasi.addEventListener('click', function() {
        toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 320);
    })
</script>

@endif
