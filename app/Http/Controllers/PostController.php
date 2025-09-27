<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function welcome()
    {
        // Mendapatkan semua data post, diurutkan dari yang terbaru, dan paginasi 5 item per halaman
        $posts = Post::latest()->paginate(5);
        return view('welcome', compact('posts'));
    }

    public function index()
    {
        // Mendapatkan semua data post, diurutkan dari yang terbaru, dan paginasi 5 item per halaman
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'title' => 'required|min:5'
        ]);

        $imageHashName = null;
        // Upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageHashName = $image->hashName();
            $image->storeAs('posts', $imageHashName, 'public_uploads');
        }

        // Buat post baru
        Post::create([
            'image' => $imageHashName,
            'title' => $request->title
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return back()->with(['success' => 'Data Berhasil Disimpan!']);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $request->validate([
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048', // Gambar tidak wajib diupdate
            'title' => 'required|min:5'
        ]);

        // Cek jika ada gambar baru yang diupload
        // Upload gambar baru
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();

            $image->storeAs('posts', $imageName, 'public_uploads');

            // Hapus gambar lama
            if ($post->image) {
                Storage::disk('public_uploads')->delete('posts/' . $post->image);
            }

            // Update post dengan gambar baru
            $post->update([
                'image' => $imageName,
                'title' => $request->title
            ]);
        } else {
            // Update post tanpa mengubah gambar
            $post->update([
                'title' => $request->title
            ]);
        }

        // Redirect ke halaman index dengan pesan sukses
        return back()->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Hapus file gambar dari storage
        if ($post->image) {
            // Hapus file gambar dari disk 'public_uploads'
            Storage::disk('public_uploads')->delete('posts/' . $post->image);
        }

        // Hapus data post dari database
        $post->delete();

        // Redirect ke halaman index dengan pesan sukses
        return back()->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
