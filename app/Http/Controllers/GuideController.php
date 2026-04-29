<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return view('guides.index', compact('guides'));
    }

    public function create()
    {
        return view('guides.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'required|string',
        'content' => 'required|string',
    ]);

    $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

    Guide::create([
        'title' => $request->title,
        'thumbnail' => $thumbnailPath,
        'description' => $request->description,
        'content' => $request->content,
    ]);

    return redirect()->route('guides.index')->with('success', 'Panduan berhasil ditambahkan');
}


    public function show(Guide $guide)
    {
        return view('guides.show', compact('guide'));
    }


public function destroy($id)
{
    $guide = Guide::findOrFail($id);

    // Hapus thumbnail gambar dari storage
    Storage::delete('public/' . $guide->thumbnail);

    $guide->delete(); // Hapus data panduan dari database

    return redirect()->route('guides.index')->with('success', 'Panduan berhasil dihapus');
}


// Menampilkan form edit panduan
public function edit($id)
{
    $guide = Guide::findOrFail($id);
    return view('guides.edit', compact('guide'));
}

// Mengupdate panduan
public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thumbnail optional saat update
        'description' => 'required|string',
        'content' => 'required|string',
    ]);

    $guide = Guide::findOrFail($id);

    // Jika ada thumbnail yang diupload, hapus yang lama dan simpan yang baru
    if ($request->hasFile('thumbnail')) {
        // Hapus file lama
        Storage::delete('public/' . $guide->thumbnail);

        // Simpan thumbnail yang baru
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $guide->thumbnail = $thumbnailPath;
    }

    // Update data panduan
    $guide->title = $request->title;
    $guide->description = $request->description;
    $guide->content = $request->content;

    // Simpan perubahan ke database
    $guide->save();

    return redirect()->route('guides.index')->with('success', 'Panduan berhasil diperbarui');
}



public function userIndex()
{
    $guides = Guide::all();
    return view('guides.user_index', compact('guides'));
}




    // Menampilkan semua panduan dalam format API
    public function apiIndex()
    {
        $guides = Guide::all();

        return response()->json([
            'data' => $guides->map(function ($guide) {
                return [
                    'id' => $guide->id,
                    'title' => $guide->title,
                    'thumbnail' => url('storage/' . $guide->thumbnail),
                    'description' => $guide->description,
                    'content' => $guide->content,
                    'links' => [
                        'self' => route('api.guides.show', ['guide' => $guide->id]),
                        'delete' => route('api.guides.destroy', ['guide' => $guide->id]),
                    ]
                ];
            }),
            'links' => [
                'self' => route('api.guides.index'),
            ]
        ]);
    }

    // Menampilkan panduan berdasarkan ID
    public function apiShow($id)
    {
        $guide = Guide::findOrFail($id);

        return response()->json([
            'data' => [
                'id' => $guide->id,
                'title' => $guide->title,
                'thumbnail' => url('storage/' . $guide->thumbnail),
                'description' => $guide->description,
                'content' => $guide->content,
            ],
            'links' => [
                'self' => route('api.guides.show', ['guide' => $id]),
                'delete' => route('api.guides.destroy', ['guide' => $id]),
            ]
        ]);
    }

    // Menyimpan panduan baru via API
    public function apiStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'content' => 'required|string',
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');

        $guide = Guide::create([
            'title' => $request->title,
            'thumbnail' => $thumbnailPath,
            'description' => $request->description,
            'content' => $request->content,
        ]);

        return response()->json([
            'data' => $guide,
            'links' => [
                'self' => route('api.guides.show', ['guide' => $guide->id]),
                'delete' => route('api.guides.destroy', ['guide' => $guide->id]),
            ]
        ], 201);
    }

    // Menghapus panduan berdasarkan ID
    public function apiDestroy($id)
    {
        $guide = Guide::findOrFail($id);

        // Hapus thumbnail gambar dari storage
        Storage::delete('public/' . $guide->thumbnail);
        $guide->delete();

        return response()->json([
            'message' => 'Panduan berhasil dihapus',
            'links' => [
                'all_guides' => route('api.guides.index'),
            ]
        ], 200);
    }

     // Mengupdate panduan berdasarkan ID (PUT /api/guides/{guide})
     public function apiUpdate(Request $request, $id)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thumbnail optional saat update
             'description' => 'required|string',
             'content' => 'required|string',
         ]);
 
         $guide = Guide::findOrFail($id);
 
         // Jika ada thumbnail yang diupload, hapus yang lama dan simpan yang baru
         if ($request->hasFile('thumbnail')) {
             // Hapus file lama
             Storage::delete('public/' . $guide->thumbnail);
 
             // Simpan thumbnail yang baru
             $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
             $guide->thumbnail = $thumbnailPath;
         }
 
         // Update data panduan
         $guide->title = $request->title;
         $guide->description = $request->description;
         $guide->content = $request->content;
 
         // Simpan perubahan ke database
         $guide->save();
 
         return response()->json([
             'data' => $guide,
             'links' => [
                 'self' => route('api.guides.show', ['guide' => $guide->id]),
                 'delete' => route('api.guides.destroy', ['guide' => $guide->id]),
             ]
         ]);
     }
}


