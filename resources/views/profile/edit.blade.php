<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minha Conta') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Meus Eventos Inscritos') }}
                </h2>
                @if($eventosInscritos->isEmpty())
                <div class="p-6 text-gray-900">
                    {{ __("Você ainda não está inscrito em nenhum evento.") }}
                </div>
                @else
                    <div class="p-6 text-gray-900">
                        <ul>
                            @foreach($eventosInscritos as $evento)
                                <li class="mb-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <strong>{{ $evento->titulo }}</strong><br>
                                            <span>{{ \Carbon\Carbon::parse($evento->data_comecar_evento)->format('d/m/Y H:i') }}</span><br>
                                            <span>{{ $evento->sala }}</span>
                                        </div>
                                        <a href="{{ route('eventoDetalhes', $evento->id) }}"    >
                                            <x-primary-button>{{ __('Detalhes') }}</x-primary-button></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>



            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Informações da Conta de Usuário') }}
            </h2>



            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
