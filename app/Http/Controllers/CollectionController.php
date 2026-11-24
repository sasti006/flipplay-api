<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UserResource;

class CollectionController extends Controller
{
    // Menambahkan media ke koleksi pengguna
    public function add(User $user, Media $media)
    {
        if ($user->mediaCollection()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi pengguna.'
            ], 409);
        }

        $user->mediaCollection()->attach($media->id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi.',
            'data' => new MediaResource($media->load('users'))
        ], 201);
    }

    // Melihat koleksi media pengguna
    public function index(User $user)
    {
        $user->load('mediaCollection');

        return new UserResource($user);
    }

    // Menghapus media dari koleksi pengguna
    public function remove(User $user, Media $media)
    {
        $deleted = $user->mediaCollection()->detach($media->id);

        if ($deleted === 0) {
            return response()->json([
                'message' => 'Media tidak ditemukan di koleksi pengguna.'
            ], 404);
        }

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi.'
        ]);
    }
}
