<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<title>{{ config('app.name', 'EventEase') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="This is meta description">
	<meta name="author" content="Themefisher">
	<link rel="shortcut icon" href="/front/logo/favicon2.png" type="image/x-icon">
	<link rel="icon" href="/front/logo/favicon2.png" type="image/x-icon">

	<!-- # Google Fonts-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="{{ asset('/front/plugins/slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('/front/plugins/font-awesome/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/front/plugins/font-awesome/brands.css') }}">
	<link rel="stylesheet" href="{{ asset('/front/plugins/font-awesome/solid.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="{{ asset('/front/css/style.css') }}?v={{ time() }}">
  @livewireStyles
</head>

<body>

<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="index.html">
				<img loading="prelaod" decoding="async" class="img-fluid" width="200" src="{{ asset('/front/logo/logo4.png') }}" alt="Wallet">

			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a wire:navigate class="nav-link" href="{{ route('evento') }}">Eventos disponíveis</a></li>

                    <!-- Verifica se o usuário está autenticado -->
                    @auth
                        <!-- Usuário logado, redireciona para a página de perfil -->
                        <li class="nav-item "><a wire:navigate class="nav-link" href="{{ route('profile.edit') }}">Meus Eventos</a></li>
                    @else
                        <!-- Usuário não logado, redireciona para a página de login -->
                        <li class="nav-item "><a wire:navigate class="nav-link" href="{{ route('login') }}">Meus Eventos</a></li>
                    @endauth



					<li class="nav-item "> <a wire:navigate class="nav-link" href="{{ route('sobreNos')}}">Sobre nós</a></li>
				</ul>
                @if (auth()->check())
                    <!-- Menu para usuários autenticados -->
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Minha Conta
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                            <li>
                                <!-- Botão de logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Botão de login para visitantes -->
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                @endif
			</div>
		</div>
	</nav>
</header>
<!-- /navigation -->

{{ $slot }}

<footer class="section-sm bg-tertiary" id="footerbk">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
                    <img loading="prelaod" decoding="async" class="img-fluid" width="200" src="{{ asset('/front/logo/logoDark.png') }}" alt="Wallet">
                    <h5 class="mb-4 text-light font-secondary">Sistema de Gerenciamento de Eventos proposto para FATEC Campinas.</h5>
					<p ></p>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h3 class="mb-4 text-light font-secondary">Acesse</h3>
					<ul class="list-unstyled">
						<li class="mb-2"><a wire:navigate class="nav-link" href="{{ route('evento') }}">Eventos Disponíveis</a>
						</li>
						<li class="mb-2"><a wire:navigate class="nav-link" href="{{ route('sobreNos') }}">Meus Eventos</a>
						</li>
						<li class="mb-2"><a wire:navigate class="nav-link" href="{{ route('sobreNos') }}">Sobre nós</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h3 class="mb-4 text-light font-secondary">FATEC Campinas</h3>
                    <a wire:navigate class="nav-link" href="{{ route('sobreNos') }}">Av Cônego Antonio Rocatto nº 593 Jd Santa Mônica
                        fateccampinas@gmail.com</a>
				</div>
			</div>
		</div>

	</div>
</footer>

<!-- # JS Plugins -->
<script src="{{ asset('/front/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/front/plugins/bootstrap/bootstrap.min.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('/front/js/script.js') }}"></script>

@livewireScripts

</body>
</html>
