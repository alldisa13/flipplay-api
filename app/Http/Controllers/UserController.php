<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCollectionRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);
        $user = User::create($data);
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function show(User $user)
    {
        return new UserResource($user->load('media'));
    }

    // GET /users/{user}/collection  -> pengganti getCollection()
    public function collection(User $user)
    {
        return MediaResource::collection($user->media()->get());
    }

    // POST /users/{user}/collection -> pengganti addToCollection()
    public function addToCollection(AddToCollectionRequest $request, User $user)
    {
        $media = Media::findOrFail($request->validated('media_id'));

        if (! $media->is_available) {
            return response()->json(['message' => 'Media tidak tersedia'], 409);
        }
        if ($user->media()->wherePivot('media_id', $media->id)->exists()) {
            return response()->json(['message' => 'Media sudah ada di koleksi'], 409);
        }

        $user->media()->attach($media->id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi',
            'data'    => new UserResource($user->load('media')),
        ], 201);
    }

    // DELETE /users/{user}/collection/{media}
    public function removeFromCollection(User $user, Media $media)
    {
        if (! $user->media()->wherePivot('media_id', $media->id)->exists()) {
            return response()->json(['message' => 'Media tidak ada di koleksi'], 404);
        }

        $user->media()->detach($media->id);
        return response()->json(['message' => 'Media berhasil dihapus dari koleksi']);
    }
}
