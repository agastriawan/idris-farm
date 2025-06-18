<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    public function artikel()
    {
        return view('admin/artikel/list');
    }

    public function tambah_artikel()
    {
        return view('admin/artikel/add');
    }

    public function edit_artikel($id)
    {
        $artikel = Artikel::findOrFail($id);

        $data = [
            "artikel" => $artikel,
        ];

        return view('admin/artikel/edit', $data);
    }

    public function _list_artikel()
    {
        $artikel = Artikel::with('user:id,nama')->get();

        $data = $artikel->map(function ($item) {
            return [
                'id' => $item->id,
                'penulis' => $item->user->nama ?? '-',
                'judul' => $item->judul,
                'created_at' => $item->created_at,
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function _tambah_artikel(Request $request)
    {   
        $messages = [
            'judul.required' => 'Judul wajib diisi.',
            'isi.required' => 'Isi artikel wajib diisi.',
            'image.required' => 'Image wajib diisi.',
            'image.max' => 'Image maksimal 10MB.',
        ];

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string',
            'isi' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $encryptedName = md5($request->nama . $request->tanggal_lahir);
            $fotoName = substr($encryptedName, 0, 40);
            $fotoExtension = $request->file('image')->getClientOriginalExtension();
            $fotoNameWithPrefix = time() . '_' . $fotoName;
            $foto = $request->file('image');
            $foto->move(public_path('image_artikel'), $fotoNameWithPrefix . '.' . $fotoExtension);

            Artikel::create([
                'judul' => $request->judul,
                'user_id' => Auth::user()->id,
                'isi' => $request->isi,
                'tags' => $request->tags,
                'image' => $fotoNameWithPrefix . '.' . $fotoExtension,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data Berhasil Disimpan',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
            ], 500);
        }
    }

    public function _edit_artikel(Request $request)
    {
        if ($request->image === '') {
            $request->merge(['image' => null]);
        }

        $messages = [
            'judul.required' => 'Judul wajib diisi.',
            'isi.required' => 'Isi artikel wajib diisi.',
            'image.max' => 'Image maksimal 10MB.',
            'image.mimes' => 'Format image harus jpg, jpeg, atau png.',
        ];
    
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string',
            'isi' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], $messages);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            $artikel = Artikel::findOrFail($request->id); 
    
            if ($request->hasFile('image')) {
                if (file_exists(public_path('image_artikel/' . $artikel->image))) {
                    unlink(public_path('image_artikel/' . $artikel->image));
                }
    
                $encryptedName = md5($request->nama . $request->tanggal_lahir);
                $fotoName = substr($encryptedName, 0, 40);
                $fotoExtension = $request->file('image')->getClientOriginalExtension();
                $fotoNameWithPrefix = time() . '_' . $fotoName;
                $foto = $request->file('image');
                $foto->move(public_path('image_artikel'), $fotoNameWithPrefix . '.' . $fotoExtension);
    
                $artikel->image = $fotoNameWithPrefix . '.' . $fotoExtension;
            }
    
            $artikel->judul = $request->judul;
            $artikel->isi = $request->isi;
            $artikel->tags = $request->tags; 
            $artikel->save();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Data Berhasil Diupdate',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate data. Silakan coba lagi.',
            ], 500);
        }
    }
    
    public function _delete_artikel($id)
    {
        try {
            $artikel = Artikel::findOrFail($id);
            $artikel->delete();

            return response()->json([
                'message' => 'Data berhasil dihapus.'
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
