<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;

class MediaController extends Controller
{
    // Menampilkan semua media dan fitur pencarian
    public function index(Request $request)
    {
        $query = Media::with('users');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $media = $query->latest()->get();

        return MediaResource::collection($media);
    }

    // Menampilkan detail satu media
    public function show(Media $medium)
    {
        $medium->load('users');

        return new MediaResource($medium);
    }

    // Menambahkan media baru
    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    // Mengubah data media
    public function update(UpdateMediaRequest $request, Media $medium)
    {
        $medium->update($request->validated());

        return new MediaResource($medium);
    }

    // Menghapus media
    public function destroy(Media $medium)
    {
        $medium->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus.'
        ]);
    }
}
