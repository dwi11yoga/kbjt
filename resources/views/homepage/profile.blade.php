@extends('layouts.homepage')

@section('body')
    {{-- Header profil --}}
    <section class="px-28 py-14 mx-auto bg-neutral-100">
        <div class="container mx-auto">
            <div class="flex space-x-20">

                <div class="relative">
                    {{-- Foto profil --}}
                    <div
                        class="overflow-hidden h-64 w-64 ml-2 rounded-full flex justify-center hover:outline hover:outline-amber-400 hover:outline-offset-4 hover:outline-4">
                        <?php $d = $user; ?>
                        @include('partials.profile-pic-general')
                    </div>
                    <div
                        class="absolute top-3 -right-4 bg-amber-400 border-4 border-neutral-100 rounded-full py-2 px-4 font-semibold text-lg">
                        Lv.{{ $user->level }}
                    </div>
                </div>

                <div class="col-span-2 space-y-2">

                    {{-- Nama & username --}}
                    <div>
                        <h3 class="font-bold">{{ $user->nama }}</h3>
                        <div>&#64;{{ $user->username }}
                            @isset($user->kota)
                                • {{ $user->kota }}
                            @endisset
                        </div>
                    </div>

                    {{-- Bio --}}
                    <div>
                        <h5>Bio</h5>
                        <p class="line-clamp-3">
                            @isset($user->bio)
                                {{ $user->bio }}
                            @else
                                Bio belum ditambahkan.
                            @endisset
                        </p>
                    </div>

                    {{-- Bergabung --}}
                    <div class="">
                        Bergabung sejak {{ $user->created_at->format('d F Y') }}.
                    </div>

                    {{-- Donasi & Media sosial --}}
                    <div>
                        <div class="inline-flex items-center -ml-2 mt-1">
                            {{-- Website --}}
                            @isset($user->tautan)
                                <a target="_blank" href="{{ $user->tautan }}" title="Buka tautan"
                                    class="group py-1.5 px-2 rounded-full hover:bg-neutral-800">
                                    <i data-feather='globe' class="group-hover:stroke-white"></i>
                                </a>
                            @endisset
                            {{-- Facebook --}}
                            @if (isset($user->media_sosial['fb']) && $user->media_sosial['fb'] != '')
                                <a target="_blank" href="https://facebook.com/{{ $user->media_sosial['fb'] }}"
                                    title="Buka facebook" class="group py-1.5 px-2 rounded-full hover:bg-blue-800">
                                    <i data-feather='facebook' class="fill-blue-800 group-hover:fill-white stroke-none"></i>
                                </a>
                            @endif
                            {{-- Twitter --}}
                            @if (isset($user->media_sosial['x']) && $user->media_sosial['x'] != '')
                                <a target="_blank" href="https://x.com/{{ $user->media_sosial['x'] }}"
                                    title="Buka twitter(x)" class="group py-1.5 px-2 rounded-full hover:bg-blue-500">
                                    <i data-feather='twitter' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
                                </a>
                            @endif
                            {{-- Instagram --}}
                            @if (isset($user->media_sosial['ig']) && $user->media_sosial['ig'] != '')
                                <a target="_blank" href="https://www.instagram.com/{{ $user->media_sosial['ig'] }}"
                                    title="Buka instagram" class="group py-1.5 px-2 rounded-full hover:bg-neutral-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"
                                            class="fill-neutral-800 stroke-none group-hover:fill-white"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"
                                            class="stroke-white group-hover:stroke-neutral-800"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"
                                            class="stroke-white group-hover:stroke-neutral-800">
                                        </line>
                                    </svg>
                                </a>
                            @endif
                            {{-- Tiktok --}}
                            @if (isset($user->media_sosial['tiktok']) && $user->media_sosial['tiktok'] != '')
                                <a target="_blank" href="https://www.tiktok.com/&#64;{{ $user->media_sosial['tiktok'] }}"
                                    title="Buka tiktok" class="group py-1.5 px-2 rounded-full hover:bg-neutral-800">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" class="group-hover:fill-white"
                                        xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                        <path
                                            d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z" />
                                    </svg>
                                </a>
                            @endif

                            @if ($user->jmlMedsos > 4)
                                <div title="Masih ada lagi"
                                    class="group py-1.5 px-3.5 rounded-full bg-neutral-200 hover:bg-neutral-300 cursor-pointer">
                                    •••
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Kontribusi dan detail user --}}
    <section class="px-28 my-5">
        <div class="container mx-auto">

            {{-- Tab --}}
            <div class="inline-flex space-x-4">
                <div
                    class="py-2 px-4 rounded-full outline outline-2 outline-neutral-200 hover:outline-4 hover:outline-amber-400 active:bg-amber-400 focus:bg-amber-400">
                    Definisi</div>
                <div
                    class="py-2 px-4 rounded-full outline outline-2 outline-neutral-200 hover:outline-4 hover:outline-amber-400 active:bg-amber-400 focus:bg-amber-400">
                    Kosakata</div>
                <div
                    class="py-2 px-4 rounded-full outline outline-2 outline-neutral-200 hover:outline-4 hover:outline-amber-400 active:bg-amber-400 focus:bg-amber-400">
                    Achivement</div>
                <div
                    class="py-2 px-4 rounded-full outline outline-2 outline-neutral-200 hover:outline-4 hover:outline-amber-400 active:bg-amber-400 focus:bg-amber-400">
                    Tentang
                </div>
            </div>

            {{-- Isi --}}
            <div class="grid grid-cols-4 space-x-7 mt-5">
                {{-- konten --}}
                <div class="col-span-3 text-justify">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis asperiores veniam quidem
                    reprehenderit in voluptate veritatis fugit et. Eligendi sit ex impedit error nisi nostrum libero
                    voluptatum quia eaque nobis, atque illum debitis molestiae, magni perferendis. Nobis nam harum excepturi
                    dolore! Nostrum tempore neque veniam architecto fuga, voluptatem sint dolore cumque, hic possimus beatae
                    cum obcaecati, accusantium asperiores perspiciatis commodi nobis vero quam iste ipsam ratione maiores.
                    Cupiditate ipsa dolorem illo cum rerum eum voluptas, nam placeat reiciendis laudantium, consequatur
                    molestiae velit veritatis alias sed provident vel nisi pariatur porro voluptatum aut dolores esse
                    accusantium? Consequuntur dolorum quaerat voluptas nemo odio cum sit quod tempora exercitationem dolores
                    explicabo, corporis, totam architecto adipisci! Porro laborum ut ex dolores, deleniti ab necessitatibus
                    tenetur at iusto minus quod sapiente aut facilis reprehenderit nisi culpa perspiciatis. Minus minima
                    architecto, assumenda voluptatibus obcaecati fuga rerum, dolore facere iure laudantium voluptas at,
                    fugit ut dolorum eius? Iste debitis repudiandae corporis accusamus magni explicabo, animi, odit possimus
                    esse aspernatur fugit voluptatum odio praesentium quibusdam aperiam? Quas officia enim voluptatem qui
                    alias pariatur tempore saepe, eaque quasi. Illum id enim quisquam ipsum quaerat veniam cum dolores
                    repellendus, mollitia facilis ratione totam minus necessitatibus nihil commodi aperiam! Est veniam culpa
                    quis sequi eligendi nulla laborum quisquam, odit adipisci? Commodi nulla omnis tenetur quasi
                    perspiciatis architecto velit, laborum nesciunt possimus incidunt totam facilis. Eum commodi voluptatem
                    saepe, ut veritatis fuga praesentium nesciunt tempore repellat doloremque amet voluptates provident
                    fugit dolorum perferendis! Tempora quia repellat atque fugiat odit assumenda unde, neque suscipit
                    nostrum? Quas saepe earum quibusdam ab ipsam tempora, cum ex impedit nesciunt sequi velit dicta
                    voluptates sunt quis. Quas harum consectetur, voluptates, id fugiat minima eveniet atque quidem quos
                    libero blanditiis autem assumenda aut hic, natus vel totam quod dolorum magni sit perspiciatis. Sequi
                    voluptates hic molestias suscipit amet recusandae tenetur velit voluptatem, quidem dolore accusantium
                    vitae quaerat distinctio vel mollitia, debitis doloribus provident officia fugit tempore praesentium.
                    Quidem repudiandae, incidunt sapiente ducimus aspernatur totam vel corrupti optio maxime numquam non id
                    ad quas sequi quasi sunt. Consequuntur quibusdam incidunt quae, ex dolorum voluptatum sit cupiditate
                    saepe voluptates tempore illum alias molestias tempora minima fugit blanditiis maxime nesciunt suscipit
                    reprehenderit? Illum quos porro aperiam eum distinctio labore veritatis obcaecati? Quasi dignissimos
                    quis amet quo, distinctio vel a, quidem libero assumenda ipsam atque consectetur ad veritatis corporis
                    nemo minima minus, magni esse nisi dolores ullam vero! Illum libero eaque deserunt doloremque,
                    cupiditate repellat ipsum excepturi voluptate nam itaque fuga nobis tenetur quidem, aut, dolores unde
                    vero asperiores impedit odio? Animi, deserunt illo! Error earum ratione et est quia nulla placeat
                    quidem. Dolore ut, illum est ipsum totam tempore placeat, aut aliquid tenetur beatae minima excepturi
                    quae quidem maxime, quas perspiciatis accusantium velit expedita esse! Nesciunt iusto, amet eum
                    provident debitis eveniet eos cupiditate cum quod ratione, exercitationem sapiente, a vero saepe. Veniam
                    suscipit non placeat officia id quibusdam nam cum aliquid esse ipsum atque voluptas pariatur molestiae
                    sequi facilis nihil, quae, totam ratione vitae commodi reprehenderit fuga deleniti! Quisquam ipsam
                    repellendus voluptatibus neque facere sed voluptatem. Aliquid odit iusto molestias quidem expedita autem
                    asperiores magnam dolore magni harum, nesciunt, at quas tempore officiis aperiam nobis inventore ab!
                    Natus necessitatibus harum sunt itaque! Eaque impedit officia itaque nesciunt et corrupti! Itaque ipsam
                    nisi saepe enim adipisci ipsum fugit iusto, praesentium, nobis magni natus? Repellendus, quidem animi
                    deserunt temporibus expedita sit est voluptates neque molestiae necessitatibus ducimus explicabo illum
                    nostrum natus esse. Labore dolorum esse necessitatibus dolorem, facere culpa, quia quis magnam cum illo
                    distinctio aspernatur totam. Neque modi provident accusantium esse suscipit sit eligendi repudiandae
                    possimus exercitationem ex illo error earum, ipsum fugit vero blanditiis mollitia autem pariatur.
                    Reprehenderit beatae illo autem vel voluptates, voluptatem sequi nisi blanditiis fugiat. Placeat
                    veritatis molestiae, amet aliquid eveniet recusandae officiis consequuntur et, impedit enim temporibus?
                    Repellat, necessitatibus hic! Aliquid saepe voluptates odio laborum voluptatibus quo praesentium cumque
                    natus quisquam quod illum facilis a, officiis iste at vel doloribus perspiciatis repellat asperiores
                    sunt voluptatem molestias. A, minima recusandae? Excepturi, dolorem fugiat aspernatur accusantium fuga
                    sunt, voluptatibus possimus deserunt doloribus qui aut similique nesciunt reprehenderit veritatis
                    repudiandae nam porro, expedita debitis a nostrum amet aperiam laudantium. Voluptate velit sint tenetur
                    possimus laudantium delectus, voluptatibus optio. Placeat aliquam tempore incidunt aliquid sequi sunt
                    amet illum nobis quam modi non quae nesciunt earum libero, nostrum tempora corporis dicta sint ratione
                    optio? Voluptatibus itaque, nemo et, tenetur quo maxime perspiciatis totam a autem deserunt impedit
                    rerum placeat enim, magni facilis adipisci sit reprehenderit eaque! Ipsum, tenetur accusantium aliquid
                    inventore nisi provident quis corrupti voluptatum dignissimos animi a odio maiores odit! Ratione quasi
                    enim modi nulla possimus nihil impedit autem accusantium, non voluptatibus aliquid quisquam, amet ad
                    similique aspernatur maiores ex recusandae fugit molestiae iure odit consequuntur sit? Quas vero culpa
                    quod fugit. Pariatur laudantium omnis labore deserunt qui itaque nemo neque libero nihil consectetur est
                    minima necessitatibus, veniam consequuntur unde alias, similique eveniet cum. Vitae sunt, reiciendis
                    exercitationem saepe tempora repellat eos, quam enim nostrum laboriosam, necessitatibus error itaque
                    ipsam iure earum? Cumque aperiam magnam minus hic laudantium nulla odio magni, provident sunt soluta,
                    dolore asperiores quis! Quae aliquam vel dolores nesciunt quo atque architecto, maiores voluptates
                    aperiam harum vero, molestiae ducimus eum nam expedita voluptatum. Consequuntur delectus quisquam quos
                    id eveniet eos vel, aliquam, praesentium, veritatis dolor obcaecati. Voluptatibus eaque explicabo,
                    ratione excepturi cumque rerum sequi cupiditate doloremque facere ad nostrum aspernatur ut pariatur
                    architecto quo repellendus accusantium non. Ullam obcaecati harum expedita veritatis rem? Quam
                    voluptatibus obcaecati illum, illo error perferendis cumque repudiandae iste necessitatibus odio dolore
                    modi. Expedita aspernatur nobis neque cum ad voluptatibus assumenda possimus eveniet ut quae sint ipsum
                    nihil autem sed doloremque maxime corrupti soluta ipsa earum, atque officia? Perferendis est, vitae
                    cupiditate, expedita asperiores fuga fugit quos nisi id quo eius iure magni laudantium! Laudantium
                    fugiat aperiam magni vel dolore velit quam hic impedit numquam ut, tempore maxime. Eum vero officiis
                    tenetur suscipit totam repudiandae, quidem aperiam deleniti magnam esse voluptate consequuntur, alias
                    nemo delectus reprehenderit a aut nam veniam dignissimos perferendis!
                </div>
                {{-- banner --}}
                <div class="col-span-1">
                    <div class="sticky top-24 space-y-3">
                        @include('partials.sidebar-banner')
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
