<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::findOrFail(Auth::user()->id);

        $data = [
            "user" => $user,
        ];

        return view('admin/profile', $data);
    }

    public function _edit_user(Request $request)
    {
        if ($request->foto === '') {
            $request->merge(['foto' => null]);
        }

        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa format email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'notelp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto.max' => 'Foto maksimal 10MB.',
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => "required|string|email|max:255",
            'notelp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::findOrFail($request->id);

            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->notelp = $request->notelp;
            $user->alamat = $request->alamat;

            if ($request->hasFile('foto')) {
                if ($user->foto && file_exists(public_path('foto_user/' . $user->foto))) {
                    unlink(public_path('foto_user/' . $user->foto));
                }

                $encryptedName = md5($request->nama . $request->email);
                $fotoName = substr($encryptedName, 0, 40);
                $fotoExtension = $request->file('foto')->getClientOriginalExtension();
                $fotoNameWithPrefix = time() . '_' . $fotoName;
                $foto = $request->file('foto');
                $foto->move(public_path('foto_user'), $fotoNameWithPrefix . '.' . $fotoExtension);

                $user->foto = $fotoNameWithPrefix . '.' . $fotoExtension;
            }

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil diupdate.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate data. Silakan coba lagi.',
            ], 500);
        }
    }

    public function _edit_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'nullable|min:8|confirmed',
        ], [
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::findOrFail($request->id);
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password berhasil diupdate.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate data. Silakan coba lagi.',
            ], 500);
        }
    }
}
