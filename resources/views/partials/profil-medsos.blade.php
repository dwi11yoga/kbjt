{{-- BUTTON SOSMED --}}
{{-- hitung button yang ditampilkan --}}
<?php $medsos = 0; ?>

@if (isset($user->tautan) && $medsos < 5)
    <a target="_blank" href="{{ $user->tautan }}" title="Buka tautan"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
        <i data-feather='globe' class="group-hover:stroke-white"></i>
    </a>
    <?php $medsos += 1; ?>
@endif
{{-- Facebook --}}
@if (isset($user->media_sosial['fb']) && $user->media_sosial['fb'] != '' && $medsos < 5)
    <a target="_blank" href="https://facebook.com/{{ $user->media_sosial['fb'] }}" title="Buka facebook"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-800">
        <i data-feather='facebook' class="fill-blue-800 group-hover:fill-white stroke-none"></i>
    </a>
    <?php $medsos += 1; ?>
@endif

{{-- Twitter --}}
@if (isset($user->media_sosial['x']) && $user->media_sosial['x'] != '' && $medsos < 5)
    <a target="_blank" href="https://x.com/{{ $user->media_sosial['x'] }}" title="Buka twitter(x)"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-500">
        <i data-feather='twitter' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
    </a>
    <?php $medsos += 1; ?>
@endif

{{-- Instagram --}}
@if (isset($user->media_sosial['ig']) && $user->media_sosial['ig'] != '' && $medsos < 5)
    <a target="_blank" href="https://www.instagram.com/{{ $user->media_sosial['ig'] }}" title="Buka instagram"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-instagram">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"
                class="fill-neutral-800 stroke-none group-hover:fill-white"></rect>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"
                class="stroke-white group-hover:stroke-neutral-800"></path>
            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"
                class="stroke-white group-hover:stroke-neutral-800">
            </line>
        </svg>
    </a>
    <?php $medsos += 1; ?>
@endif
{{-- Tiktok --}}
@if (isset($user->media_sosial['tiktok']) && $user->media_sosial['tiktok'] != '' && $medsos < 5)
    <a target="_blank" href="https://www.tiktok.com/&#64;{{ $user->media_sosial['tiktok'] }}" title="Buka tiktok"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
        <svg width="24px" height="24px" viewBox="0 0 24 24" class="group-hover:fill-white"
            xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
            <path
                d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z" />
        </svg>
    </a>
    <?php $medsos += 1; ?>
@endif

{{-- Whatsapp --}}
@if (isset($user->media_sosial['whatsapp']) && $user->media_sosial['whatsapp'] != '' && $medsos < 5)
    <a target="_blank" href="https://wa.me/{{ $user->media_sosial['whatsapp'] }}" title="Buka whatsapp"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-green-500">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30"
            width="24px" height="24px">
            <polygon class="fill-green-500 group-hover:fill-white" points="4.796,20.836 3.107,27 9.415,25.344 " />
            <path class="fill-green-500 group-hover:fill-white"
                d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M20.924,19.143c-0.247,0.693-1.461,1.363-2.005,1.41c-0.549,0.051-1.061,0.247-3.568-0.74c-3.024-1.191-4.931-4.289-5.08-4.489c-0.149-0.195-1.21-1.61-1.21-3.07c0-1.465,0.768-2.182,1.037-2.48c0.274-0.298,0.595-0.372,0.795-0.372c0.195,0,0.395,0,0.568,0.009c0.214,0.005,0.447,0.019,0.67,0.512c0.265,0.586,0.842,2.056,0.916,2.205c0.074,0.149,0.126,0.326,0.023,0.521c-0.098,0.2-0.149,0.321-0.293,0.498c-0.149,0.172-0.312,0.386-0.447,0.516c-0.149,0.149-0.302,0.312-0.13,0.609s0.768,1.27,1.651,2.056c1.135,1.014,2.093,1.326,2.391,1.475s0.47,0.126,0.642-0.074c0.177-0.195,0.744-0.865,0.944-1.163c0.195-0.298,0.395-0.247,0.665-0.149c0.274,0.098,1.735,0.819,2.033,0.968s0.493,0.223,0.568,0.344C21.171,17.854,21.171,18.449,20.924,19.143z" />
        </svg>
    </a>
    <?php $medsos += 1; ?>
@endif

{{-- Telegram --}}
@if (isset($user->media_sosial['telegram']) && $user->media_sosial['telegram'] != '' && $medsos < 5)
    <a target="_blank" href="https://t.me/{{ $user->media_sosial['telegram'] }}" title="Buka telegram"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-500">
        <svg width="24px" height="24px" viewBox="0 0 48 48" id="Layer_2" data-name="Layer 2"
            xmlns="http://www.w3.org/2000/svg">
            <path class="fill-blue-500 group-hover:fill-white"
                d="M40.83,8.48c1.14,0,2,1,1.54,2.86l-5.58,26.3c-.39,1.87-1.52,2.32-3.08,1.45L20.4,29.26a.4.4,0,0,1,0-.65L35.77,14.73c.7-.62-.15-.92-1.07-.36L15.41,26.54a.46.46,0,0,1-.4.05L6.82,24C5,23.47,5,22.22,7.23,21.33L40,8.69a2.16,2.16,0,0,1,.83-.21Z" />
        </svg>
    </a>
    <?php $medsos += 1; ?>
@endif

{{-- linkedin --}}
@if (isset($user->media_sosial['linkedin']) && $user->media_sosial['linkedin'] != '' && $medsos < 5)
    <a target="_blank" href="https://www.linkedin.com/in/{{ $user->media_sosial['linkedin'] }}" title="Buka linkedin"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-600">
        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="fill-blue-600 group-hover:fill-white"
                d="M18.72 3.99997H5.37C5.19793 3.99191 5.02595 4.01786 4.86392 4.07635C4.70189 4.13484 4.55299 4.22471 4.42573 4.34081C4.29848 4.45692 4.19537 4.59699 4.12232 4.75299C4.04927 4.909 4.0077 5.07788 4 5.24997V18.63C4.01008 18.9901 4.15766 19.3328 4.41243 19.5875C4.6672 19.8423 5.00984 19.9899 5.37 20H18.72C19.0701 19.9844 19.4002 19.8322 19.6395 19.5761C19.8788 19.32 20.0082 18.9804 20 18.63V5.24997C20.0029 5.08247 19.9715 4.91616 19.9078 4.76122C19.8441 4.60629 19.7494 4.466 19.6295 4.34895C19.5097 4.23191 19.3672 4.14059 19.2108 4.08058C19.0544 4.02057 18.8874 3.99314 18.72 3.99997ZM9 17.34H6.67V10.21H9V17.34ZM7.89 9.12997C7.72741 9.13564 7.5654 9.10762 7.41416 9.04768C7.26291 8.98774 7.12569 8.89717 7.01113 8.78166C6.89656 8.66615 6.80711 8.5282 6.74841 8.37647C6.6897 8.22474 6.66301 8.06251 6.67 7.89997C6.66281 7.73567 6.69004 7.57169 6.74995 7.41854C6.80986 7.26538 6.90112 7.12644 7.01787 7.01063C7.13463 6.89481 7.2743 6.80468 7.42793 6.74602C7.58157 6.68735 7.74577 6.66145 7.91 6.66997C8.07259 6.66431 8.2346 6.69232 8.38584 6.75226C8.53709 6.8122 8.67431 6.90277 8.78887 7.01828C8.90344 7.13379 8.99289 7.27174 9.05159 7.42347C9.1103 7.5752 9.13699 7.73743 9.13 7.89997C9.13719 8.06427 9.10996 8.22825 9.05005 8.3814C8.99014 8.53456 8.89888 8.6735 8.78213 8.78931C8.66537 8.90513 8.5257 8.99526 8.37207 9.05392C8.21843 9.11259 8.05423 9.13849 7.89 9.12997ZM17.34 17.34H15V13.44C15 12.51 14.67 11.87 13.84 11.87C13.5822 11.8722 13.3313 11.9541 13.1219 12.1045C12.9124 12.2549 12.7546 12.4664 12.67 12.71C12.605 12.8926 12.5778 13.0865 12.59 13.28V17.34H10.29V10.21H12.59V11.21C12.7945 10.8343 13.0988 10.5225 13.4694 10.3089C13.84 10.0954 14.2624 9.98848 14.69 9.99997C16.2 9.99997 17.34 11 17.34 13.13V17.34Z" />
        </svg>
    </a>
    <?php $medsos += 1; ?>
@endif

{{-- Github --}}
@if (isset($user->media_sosial['github']) && $user->media_sosial['github'] != '' && $medsos < 5)
    <a target="_blank" href="https://github.com/{{ $user->media_sosial['github'] }}" title="Buka github"
        class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
        <i data-feather='github' class="fill-neutral-800 group-hover:fill-white stroke-none"></i>
    </a>
    <?php $medsos += 1; ?>
@endif

@if ($user->jmlMedsos > 4)
    <div title="Masih ada lagi"
        class="group w-9 h-9 flex items-center justify-center rounded-full bg-neutral-100 hover:bg-neutral-300 cursor-pointer">
        •••
    </div>
@endif
