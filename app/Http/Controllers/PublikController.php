<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Animal;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublikController extends Controller
{
    public function index()
    {
        $artikel = Artikel::with('user:id,nama')->limit(3)->get();
        $galleries = Gallery::latest()->take(5)->get();
        $animals = Animal::latest()->take(6)->get(); 

        $data = [
            "artikels" => $artikel,
            "galleries" => $galleries,
            "animals" => $animals,
        ];

        return view('home', $data);
    }

    public function artikel()
    {
        $artikel = Artikel::with('user:id,nama')->paginate(8);

        $data = [
            "artikels" => $artikel
        ];

        return view('artikel', $data);
    }

    public function artikel_detail($slug)
    {
        $artikel = Artikel::with('user:id,nama')->where('slug', $slug)->first();

        if (!$artikel) {
            return redirect()->route('notFound');
        }

        // Ambil 3 artikel terbaru selain artikel ini
        $recentPosts = Artikel::where('id', '!=', $artikel->id)
            ->latest()
            ->take(3)
            ->get();

        $data = [
            "artikels" => $artikel,
            "recentPosts" => $recentPosts
        ];

        return view('artikel-detail', $data);
    }

    public function tentang_kami()
    {
        return view('about');
    }

    public function kontak_kami()
    {
        return view('contact');
    }

    public function _kontak(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        Kontak::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'message' => $request->input('message'),
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim!, Kami akan Membalasnya Via Email');
    }
}
