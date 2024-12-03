<main>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center align-items-start">
                <div class="col-lg-7">
                    <div class="section-title">

                        {{-- Informações do evento --}}
                        <div class="mb-5">
                            <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                                <li class="list-inline-item"><a wire:navigate href="{{ route('evento') }}">Home</a>
                                </li>
                                <li class="list-inline-item">/ &nbsp; <a>Detalhes do Evento</a>
                                </li>
                            </ul>

                            <h2 class="mb-4" style="line-height:1.5">{{ $evento->titulo }}</h2>
                            <div class="rounded shadow py-5 px-4">
                                <p class="mb-3">
                                    <i class="fas fa-calendar-alt  me-2" ></i>
                                    {{ \Carbon\Carbon::parse($evento->data_comecar_evento)->translatedFormat('l, d/m') }}
                                    <span class="me-3"></span>
                                    <i class="fas fa-clock ml-2  me-2"></i>
                                    {{ \Carbon\Carbon::parse($evento->data_comecar_evento)->format('H:i') }} às
                                    {{ \Carbon\Carbon::parse($evento->data_terminar_evento)->format('H:i') }}
                                </p>

                                <p class="list-inline-item" style="font-weight:500">Tipo do evento: <a  class="ml-1">{{ $evento->tipo }} </a> </p>
                                <p class="list-inline-item" style="font-weight:500">Categoria: <a  class="ml-1">{{ $evento->categoria->nome}} </a></p>
                                <p style="font-weight:500">Local: <a  class="ml-1">{{ $evento->endereco}} </p>
                                <p style="font-weight:500"> <a  class="ml-1">{{ $evento->sala}} - ({{ $evento->capacidade }} pessoas)</a></p>
                            </div>

                            {{-- Informações do convidado --}}
                            <div class="content pe-0 pe-lg-5">
                                <h3>
                                    <i class="fas fa-user-tie me-2"></i>
                                    Palestrante
                                </h3>
                                <p>{{ $evento->biografia }}</p>
                            </div>

                            {{-- Informações sobre o evento --}}
                            <div class="content pe-0 pe-lg-5">
                                <h3>
                                    <i class="fas fa-info-circle me-2"></i>
                                    Sobre o evento
                                </h3>
                                <p style="text-align: justify;">{{ $evento->description }}</p>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Imagem do Convidado --}}
                <div class="col-xl-3 col-lg-4 col-md-6 mt-4">
                    <div class="card bg-transparent border-0 text-center">
                        <div class="card-img">
                            <img loading="lazy" decoding="async" src="{{ asset('storage').'/'.$evento->perfil_image }}" alt="Convidado" class="rounded w-100" width="300" height="332" >
                        </div>
                        <div class="card-body">
                            <h3>{{ $evento->nome_convidado }}</h3>
                            <p>{{ $evento->especialidade }}</p>
                        </div>
                    </div>


                    <div class="text-center mt-4">
                        @if(Auth::check())
                            @if ($evento->inscricoes()->where('user_id', Auth::id())->exists())
                                <!-- Exibe botão "Inscrito" se o usuário já estiver inscrito -->
                                <form method="POST" action="{{ route('cancelar.inscricao', $evento->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        CANCELAR INSCRIÇÃO
                                    </button>
                                </form>
                            @else
                                <!-- Exibe o botão de inscrição -->
                                <form method="POST" action="{{ route('inscrever', $evento->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                        INSCREVER
                                    </button>
                                </form>
                            @endif
                        @else
                            <!-- Se o usuário não estiver autenticado, exibe botão de login -->
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">
                                INSCREVER
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

