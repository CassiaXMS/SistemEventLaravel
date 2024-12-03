<x-guest-layout>

    <link rel="stylesheet" href="{{ asset('front/css/login-style.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <div class="text-center ">
        <img src="{{ asset('/front/logo/logo3.png') }}" alt="Logo" class="mx-auto mb-4" style="max-width: 200px;">
    </div>
    <div class="mb-6">
        <h1 class="text-4xl font-semibold text-gray-800">Vamos criar uma conta!</h1>
    </div>
    <div class="login-form-container">
        <form method="POST" action="{{ route('register') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Informe seu nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" autocomplete="off"  />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Sobrenome -->
            <div class="mt-4">
                <x-input-label for="sobrenome" :value="__('Informe seu sobrenome')" />
                <x-text-input id="sobrenome" autocomplete="off" class="block mt-1 w-full" type="text" name="sobrenome" :value="old('sobrenome')" required />
                <x-input-error :messages="$errors->get('sobrenome')" class="mt-2" />
            </div>

            <!-- Identificação -->
            <div class="mt-4">
                <x-input-label for="identificacao" :value="__('Quem é você?')" />
                <select id="identificacao" name="identificacao" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">Selecione uma opção</option>
                    <option value="Aluno da FATEC Campinas">Aluno(a) da FATEC Campinas</option>
                    <option value="Professor da FATEC Campinas">Professor(a) da FATEC Campinas</option>
                    <option value="Visitante">Visitante</option>
                </select>
                <x-input-error :messages="$errors->get('identificacao')" class="mt-2" />
            </div>

            <div class="mt-4">
                @csrf
                <x-input-label for="profile_photo" :value="__('Foto de Perfil')" />
                <input type="file" id="profile_photo" name="profile_photo" class="block mt-1 w-full" accept="image/*">
                <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />

            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Informe seu E-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div id="student-info" style="display: none;">
                <!-- Curso -->
                <div class="mt-4">
                    <x-input-label for="curso" :value="__('Qual o curso você realiza? ')" />
                    <select id="curso" name="curso" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Selecione um curso</option>
                        <option value="ADS">ADS</option>
                        <option value="GTI">GTI</option>
                        <option value="PQ">PQ</option>
                        <option value="LOG">LOG</option>
                        <option value="GEEE">GEEE</option>
                        <option value="GE">GE</option>
                    </select>
                    <x-input-error :messages="$errors->get('curso')" class="mt-2" />
                </div>
                <!-- Semestre -->
                <div class="mt-4">
                    <x-input-label for="semestre" :value="__('Informe qual semestre')" />
                    <select id="semestre" name="semestre" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Selecione o semestre</option>
                        <option value="1°">1°</option>
                        <option value="2°">2°</option>
                        <option value="3°">3°</option>
                        <option value="4°">4°</option>
                        <option value="5°">5°</option>
                        <option value="6°">6°</option>
                    </select>
                    <x-input-error :messages="$errors->get('semestre')" class="mt-2" />
                </div>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Crie uma senha')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                autocomplete="off"  />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Digite a senha novamente')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Já tenho cadastro') }}
                </a>
            </div>


            <div class="flex items-center justify-center mt-4 ">
                <x-primary-button class=" ms-3 form-button text-center ">
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>

            <div class="mt-4 text-center ">
                <a href="{{ url('/') }}" class="text-blue-500 hover:underline">
                    {{ __('Voltar para home') }}
                </a>
            </div>

        </form>
    </div>

</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const identificacaoSelect = document.getElementById('identificacao');
        const studentInfoDiv = document.getElementById('student-info');

        function toggleStudentInfo() {
            if (identificacaoSelect.value === 'Aluno da FATEC Campinas') {
                studentInfoDiv.style.display = 'block'; // Mostrar curso e semestre
            } else {
                studentInfoDiv.style.display = 'none'; // Ocultar curso e semestre
            }
        }

        // Atualizar visibilidade ao carregar a página
        toggleStudentInfo();

        // Adicionar evento ao campo de seleção
        identificacaoSelect.addEventListener('change', toggleStudentInfo);
    });

</script>
