<main>
    <section class="banner bg-tertiary position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="block text-center text-lg-start pe-0 pe-xl-5">
                        <h1 class="text-capitalize mb-4">Inscreva para participar !</h1>
                        <p class="mb-4">Sistema de Gerenciamento de Eventos da FATEC Campinas</p> <a wire:navigate type="button"
                        class="btn btn-primary" href="{{ route('sobreNos')}}" data-bs-toggle="modal" data-bs-target="#applyLoan">Saber Mais<span style="font-size: 14px;" class="ms-2 fa-solid fa-arrow-right"></span></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5 text-center">
                        <img loading="lazy" decoding="async"
                        src="{{ $sobreNos ? asset('storage/'.$sobreNos->imagemEvento) : asset('public/front/images/tecnologia.png')}}"
                        alt="banner image" class="rounded w-100">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h1 >Eventos disponíveis</h1>
            <div class="row">
                <div class="col-lg-9">
                    <div class="me-lg-4">
                        <div class="row gy-5">
                            @if ($eventos->isNotEmpty())
                                @foreach ($eventos as $evento)
                                    <div class="col-md-6" data-aos="fade">
                                        <div class="rounded shadow py-5 px-4">
                                            <article class="blog-post ">
                                                <div class="post-slider slider-sm rounded">
                                                    <h2 class="h4">
                                                        <a class="text-black" wire:navigate href="{{ route('eventoDetalhes', $evento->id) }}">
                                                            {{ $evento->titulo }}
                                                        </a>
                                                    </h2>

                                                    <p class="mb-3">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        {{ \Carbon\Carbon::parse($evento->data_comecar_evento)->translatedFormat('l, d/m') }}
                                                        <span class="me-3"></span>
                                                        <i class="fas fa-clock ml-2"></i>
                                                        {{ \Carbon\Carbon::parse($evento->data_comecar_evento)->format('H:i') }} às
                                                        {{ \Carbon\Carbon::parse($evento->data_terminar_evento)->format('H:i') }}
                                                    </p>
                                                    <div class="d-flex align-items-center">
                                                        @if ($evento->perfil_image != "")
                                                            <img loading="lazy" decoding="async" src="{{ asset('storage/'.$evento->perfil_image) }}" alt="Convidado" style="width: 100px; height: 100px; object-fit: cover; margin-right: 15px;">
                                                        @endif

                                                        <p class="mb-0">
                                                            {{ $evento->nome_convidado }} - {{ $evento->especialidade }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="pt-4 text-center">
                                                    <a wire:navigate href="{{ route('eventoDetalhes', $evento->id) }}" class="btn btn-sm btn-outline-primary" aria-label="Saber mais">Saber mais</a>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-12">
                                {{ $eventos->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                     <!-- Categorias -->
                    <div class="widget widget-categories">
                        <h5 class="widget-title"><span>Categorias</span></h5>
                        <ul class="list-unstyled widget-list">
                            <li id="categoriascor">
                                <a wire:click="filterEvents('todos')" class="{{ $categoriaSlug == 'todos' ? 'active' : '' }}">
                                    Todos ({{ $totalEventos }})
                                </a>
                            </li>
                            @foreach ($categorias as $categoria)
                                <li>
                                    <a wire:click="filterEvents('{{ $categoria->slug }}')" class="{{ $categoriaSlug == $categoria->slug ? 'active' : '' }}">
                                        {{ $categoria->nome }}  ({{ $categoria->eventos_count }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Mais eventos -->
                    <div class="widget">
                        <h5 class="widget-title"><span>Mais Eventos</span></h5>
                        @if ($latestEventos->isNotEmpty())
                            @foreach ($latestEventos as $latestEvento)
                                <ul class="list-unstyled widget-list">
                                    <li class="d-flex widget-post align-items-center">
                                        <a class="text-black" wire:navigate href="{{ route('eventoDetalhes', $latestEvento->id) }}">
                                            <div class="widget-post-image flex-shrink-0 me-3">
                                                @if ($latestEvento->perfil_image != "")
                                                    <img loading="lazy" decoding="async" src="{{ asset('storage/'.$latestEvento->perfil_image) }}" alt="Post Thumbnail">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="flex-grow-1">
                                            <h5 class="h6 mb-0">
                                                <a class="text-black" wire:navigate href="{{ route('eventoDetalhes', $latestEvento->id) }}">
                                                    {{ $latestEvento->titulo }}
                                                </a>
                                            </h5>
                                            <small>{{ \Carbon\Carbon::parse($latestEvento->created_at)->format('d M, Y') }}</small>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
