<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sobrenome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'identificacao' => ['required', 'in:Aluno da FATEC Campinas,Professor da FATEC Campinas,Visitante'],
            'curso' => ['nullable','required_if:identificacao,Aluno da FATEC Campinas', 'in:ADS,GTI,PQ,LOG,GEEE,GE', 'nullable'],
            'semestre' => ['nullable','required_if:identificacao,Aluno da FATEC Campinas', 'in:1°,2°,3°,4°,5°,6°', 'nullable'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // if ($request->identificacao === 'Aluno da FATEC Campinas') {
        //     $user = User::create([
        //         'name' => $request->name,
        //         'sobrenome' => $request->sobrenome,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'identificacao' => $request->identificacao,
        //         'curso' => $request->curso,
        //         'semestre' => $request->semestre,
        //     ]);
        // } else {
        //     // Para "Professor" e "Visitante", não inserimos os campos "curso" e "semestre"
        //     $user = User::create([
        //         'name' => $request->name,
        //         'sobrenome' => $request->sobrenome,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'identificacao' => $request->identificacao,
        //         'curso' => null,  // Não necessário para "Professor" e "Visitante"
        //         'semestre' => null,  // Não necessário para "Professor" e "Visitante"
        //     ]);
        // }

        // $user = User::create([
        //     'name' => $request->name,
        //     'sobrenome' => $request->sobrenome,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'identificacao' => $request->identificacao,
        //     'curso' => $request->identificacao === 'Aluno da FATEC Campinas' ? $request->curso : null,
        //     'semestre' => $request->identificacao === 'Aluno da FATEC Campinas' ? $request->semestre : null,
        // ]);

        $userData = [
            'name' => $request->name,
            'sobrenome' => $request->sobrenome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'identificacao' => $request->identificacao,
            'curso' => $request->identificacao === 'Aluno da FATEC Campinas' ? $request->curso : null,
            'semestre' => $request->identificacao === 'Aluno da FATEC Campinas' ? $request->semestre : null,
            'profile_photo' => $profilePhotoPath,
        ];

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('evento', absolute: false));
    }
}
