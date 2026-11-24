<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        $users = User::with('mediaCollection')->get();

        return UserResource::collection($users);
    }

    // Membuat pengguna baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    // Menampilkan detail pengguna
    public function show(User $user)
    {
        $user->load('mediaCollection');

        return new UserResource($user);
    }
}
