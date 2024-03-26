<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        try {
            $randomPassword = Str::random(12);
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($randomPassword),
            ]);
            Mail::to($user->email)->send(new WelcomeMail($user, $randomPassword));
            return response()->json($user, 201);
        } catch (\Exception $e) {

            Log::error('Error occurred while creating user: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while processing your request. Please try again later.'], 500);
        }

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ]);
        try {
            $user = User::where('email', $request->input('email'))->firstOrFail();

            $token = Str::random(60);
            $user->reset_password_token = $token;
            $user->save();


            return response()->json(['message' => 'Se ha enviado un enlace para restablecer la contraseña a su dirección de correo electrónico.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ha ocurrido un error al enviar el correo electrónico para restablecer la contraseña.'], 500);
        }
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();

        return response()->json($user, 200);
    }

}