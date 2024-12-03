<main>

    <!--SOBRE NOS-->
    <section class="section">
        <div class="container">
            <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                <li class="list-inline-item"><a wire:navigate href="{{ route('evento') }}">Home</a>
                </li>
                <li class="list-inline-item">/ &nbsp; <a>Sobre Nós</a>
                </li>
            </ul>

            @if ($sobreNos)
                @if ($sobreNos->imagemEvento != '')
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7">
                            <div class="section-title">
                                <h2 class="h1 mb-4">{{ $sobreNos->tituloEvento }}</h2>
                                {!! $sobreNos->descricaoEvento !!}
                            </div>
                        </div>
                        <div class="col-lg-4 mt-5 mt-lg-0">
                            <img loading="lazy" decoding="async" src="{{ asset('storage/' . $sobreNos->imagemEvento) }}"
                                alt="" class="rounded w-100">
                        </div>
                    </div>
                @else
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-12">
                            <div class="section-title">
                                {!! $sobreNos->descricaoEvento !!}
                            </div>
                        </div>
                    </div>
                @endif
            @else
                {{-- Página em branco --}}
            @endif
        </div>
    </section>


    <!--PERGUNTAS FREQUENTES-->

    <section class="section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6">
                    <div class="section-title text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-question-circle fa-3x me-1"></i>
                        <h1>Perguntas Frequentes</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion accordion-border-bottom" id="accordionFAQ">

                        @if ($perguntasFrequentes->isNotEmpty())
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($perguntasFrequentes as $perguntasFrequentes)
                                <div class="accordion-item">
                                    <h2 class="accordion-header accordion-button h5 border-0"
                                        id="heading-{{ $x }}" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $x }}" aria-expanded="true"
                                        aria-controls="collapse-{{ $x }}">
                                        {{ $perguntasFrequentes->question }}
                                    </h2>
                                    <div id="collapse-{{ $x }}" class="accordion-collapse collapse border-0"
                                        aria-labelledby="heading-{{ $x }}" data-bs-parent="#accordionFAQ">
                                        <div class="accordion-body py-0 content">{!! $perguntasFrequentes->answer !!}</div>
                                    </div>
                                </div>
                                @php
                                    $x++;
                                @endphp
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
