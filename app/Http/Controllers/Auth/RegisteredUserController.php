<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    } 

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([

            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'personal_phone' => ['required', 'string', 'max:10'],
            'home_phone' => ['required', 'string', 'max:9'],
            'address' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        $user = User::make([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => "$request->first_name $request->last_name",
            'personal_phone' => $request->personal_phone,
            'home_phone' => $request->home_phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
     // Se hace una consulta a la BDD y
        // se asigna el rol al usuario
        // por medio del modelo ROL
       
        $guard_role = Role::where('name', 'guard')->first();

        $guard_role->users()->save($user);


        event(new Registered($user)); // VERIFICACIÓN DEL CHECK EN EL EMAIL
        $user->image()->create(
            [
                'path'=>"https://ui-avatars.com/api/?name=$user->first_name+$user->last_name&size=128"
            ]
        );
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
