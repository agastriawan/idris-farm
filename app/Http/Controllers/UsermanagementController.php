<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsermanagementController extends Controller
{
    public function usermanagement()
    {
        return view('admin/usermanagement/list');
    }

    public function tambah_user()
    {
        $role = Role::select('id', 'name')->get();
        $data = [
            'role' => $role
        ];

        return view('admin/usermanagement/add', $data);
    }
    
    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        $role = Role::select('id', 'name')->get();

        $data = [
            "user" => $user,
            "role" => $role
        ];

        return view('admin/usermanagement/edit', $data);
    }

    public function _list_user()
    {
        $monitoring = User::with('role:id,name')->get();

        $data = $monitoring->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'email' => $item->email,
                'notelp' => $item->notelp,
                'role' => $item->role->name,
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function _tambah_user(Request $request)
    {   
        if ($request->foto === '') {
            $request->merge(['foto' => null]);
        }

        $messages = [
            'role_id.required' => 'Role wajib diisi.',
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa format email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi Password wajib diisi.',
            'notelp.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto.max' => 'Foto maksimal 10MB.',
        ];
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password_confirmation' => 'required',
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
            'notelp' => 'required',
            'alamat' => 'required',
            'role_id' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], $messages);     

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $fotoNameWithPrefix = null;

            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $encryptedName = md5($request->nama . $request->email);
                $fotoName = substr($encryptedName, 0, 40); 
                $fotoExtension = $request->file('foto')->getClientOriginalExtension();
                $fotoNameWithPrefix = time() . '_' . $fotoName; 
                $foto = $request->file('foto');
                $foto->move(public_path('foto_user'), $fotoNameWithPrefix . '.' . $fotoExtension);
                $fotoNameWithPrefix .= '.' . $fotoExtension; 
            }
            
            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'notelp' => $request->notelp,
                'alamat' => $request->alamat,
                'role_id' => $request->role_id,
                'foto' => $fotoNameWithPrefix,
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Data user berhasil disimpan.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
            ], 500); 
        }
    }

    public function _edit_user(Request $request)
    {
        if ($request->foto === '') {
            $request->merge(['foto' => null]);
        }
        
        $messages = [
            'role_id.required' => 'Role wajib diisi.',
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
            'email' => "required|string|email|max:255|unique:users,email,{$request->id}",
            'notelp' => 'required',
            'alamat' => 'required',
            'role_id' => 'required',
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
            $user->role_id = $request->role_id;
    
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
    
            if ($request->filled('password')) {
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
    
                $user->password = Hash::make($request->password);
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

    public function _delete_user($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

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
