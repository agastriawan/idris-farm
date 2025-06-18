<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    public function animal()
    {
        return view('admin/animal/list');
    }

    public function tambah_animal()
    {
        return view('admin/animal/add');
    }

    public function edit_animal($id)
    {
        $animal = Animal::findOrFail($id);

        $data = [
            "animal" => $animal,
        ];

        return view('admin/animal/edit', $data);
    }

    public function _list_animal()
    {
        $animals = Animal::get();

        $data = $animals->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->name,
                'jenis' => $item->type,
                'harga' => $item->price,
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function _tambah_animal(Request $request)
    {
        $messages = [
            'name.required' => 'Nama hewan wajib diisi.',
            'type.required' => 'Jenis hewan wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'image.required' => 'Gambar wajib diunggah.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
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
            $foto->move(public_path('image_animal'), $filename);

            Animal::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $filename,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Hewan berhasil ditambahkan.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ], 500);
        }
    }

    public function _edit_animal(Request $request)
    {
        $messages = [
            'name.required' => 'Nama hewan wajib diisi.',
            'type.required' => 'Jenis hewan wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ];

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:animals,id',
            'name' => 'required|string',
            'type' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $animal = Animal::findOrFail($request->id);

            if ($request->hasFile('image')) {
                if ($animal->image && file_exists(public_path('image_animal/' . $animal->image))) {
                    unlink(public_path('image_animal/' . $animal->image));
                }

                $foto = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('image_animal'), $filename);

                $animal->image = $filename;
            }

            $animal->name = $request->name;
            $animal->type = $request->type;
            $animal->description = $request->description;
            $animal->price = $request->price;
            $animal->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data hewan berhasil diperbarui.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data.',
            ], 500);
        }
    }

    public function _delete_animal($id)
    {
        try {
            $animal = Animal::findOrFail($id);
            $animal->delete();

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
