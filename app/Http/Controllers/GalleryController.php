<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function gallery()
    {
        return view('admin/gallery/list');
    }

    public function tambah_gallery()
    {
        return view('admin/gallery/add');
    }

    public function edit_gallery($id)
    {
        $gallery = Gallery::findOrFail($id);

        $data = [
            "gallery" => $gallery,
        ];

        return view('admin/gallery/edit', $data);
    }

    public function _list_gallery()
    {
        $galleries = Gallery::get();

        $data = $galleries->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->title,
                'deskripsi' => $item->description,
                'gambar' => url('image_gallery/' . $item->image_path),
                'created_at' => $item->created_at->format('d-m-Y H:i'),
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function _tambah_gallery(Request $request)
    {
        $messages = [
            'title.required' => 'Judul gambar wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'image.required' => 'Gambar wajib diunggah.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $foto = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('image_gallery'), $filename);
    
            Gallery::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $filename,
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Gambar berhasil ditambahkan ke galeri.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ], 500);
        }
    }


    public function _edit_gallery(Request $request)
    {
        $messages = [
            'title.required' => 'Judul wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ];

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:galleries,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $gallery = Gallery::findOrFail($request->id);

            if ($request->hasFile('image')) {
                if ($gallery->image && file_exists(public_path('image_gallery/' . $gallery->image))) {
                    unlink(public_path('image_gallery/' . $gallery->image));
                }

                $foto = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('image_gallery'), $filename);

                $gallery->image = $filename;
            }

            $gallery->title = $request->title;
            $gallery->description = $request->description;
            $gallery->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data galeri berhasil diperbarui.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data.',
            ], 500);
        }
    }


    public function _delete_gallery($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->delete();

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
