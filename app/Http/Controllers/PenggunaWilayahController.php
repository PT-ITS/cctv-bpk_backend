<?php

namespace App\Http\Controllers;

use App\Models\PenggunaWilayah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaWilayahController extends Controller
{

    public function detail($id)
    {
        try {
            $data = PenggunaWilayah::join('users', 'pengguna_wilayahs.user_id', '=', 'users.id')
                ->select('users.*', 'pengguna_wilayahs.nama_pengguna', 'pengguna_wilayahs.jabatan_pengguna', 'pengguna_wilayahs.jabatan_pengguna', 'pengguna_wilayahs.hp_pengguna', 'pengguna_wilayahs.alamat_pengguna', 'pengguna_wilayahs.nama_wilayah', 'pengguna_wilayahs.alamat_wilayah')
                ->where('users.id', $id)
                ->first();
            return response()->json(['id' => '1', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function list()
    {
        try {
            $data = PenggunaWilayah::join('users', 'pengguna_wilayahs.user_id', '=', 'users.id')
                ->select('users.*', 'pengguna_wilayahs.nama_pengguna', 'pengguna_wilayahs.jabatan_pengguna', 'pengguna_wilayahs.jabatan_pengguna', 'pengguna_wilayahs.hp_pengguna', 'pengguna_wilayahs.alamat_pengguna', 'pengguna_wilayahs.nama_wilayah', 'pengguna_wilayahs.alamat_wilayah')
                ->get();
            return response()->json(['id' => '1', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'nama_pengguna' => 'required',
                'jabatan_pengguna' => 'required',
                'hp_pengguna' => 'required',
                'alamat_pengguna' => 'required',
                'nama_wilayah' => 'required',
                'alamat_wilayah' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                ]);

                $data = PenggunaWilayah::create([
                    'nama_pengguna' => $validatedData['nama_pengguna'],
                    'jabatan_pengguna' => $validatedData['jabatan_pengguna'],
                    'hp_pengguna' => $validatedData['hp_pengguna'],
                    'alamat_pengguna' => $validatedData['alamat_pengguna'],
                    'nama_wilayah' => $validatedData['nama_wilayah'],
                    'alamat_wilayah' => $validatedData['alamat_wilayah'],
                    'user_id' => $user->id,
                ]);
                DB::commit();
                return response()->json(['id' => '1', 'data' => $data]);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['id' => '0', 'data' => $th->getMessage()]);
            }
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable',
                'nama_pengguna' => 'required',
                'jabatan_pengguna' => 'required',
                'hp_pengguna' => 'required',
                'alamat_pengguna' => 'required',
                'nama_wilayah' => 'required',
                'alamat_wilayah' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $user = User::find($id);
                $user->name = $validatedData['name'];
                $user->email = $validatedData['email'];
                if (isset($validatedData['password'])) {
                    $user->password = Hash::make($validatedData['password']);
                }
                $user->save();

                $data = PenggunaWilayah::where('user_id', $user->id)->first();
                $data->nama_pengguna = $validatedData['nama_pengguna'];
                $data->jabatan_pengguna = $validatedData['jabatan_pengguna'];
                $data->hp_pengguna = $validatedData['hp_pengguna'];
                $data->alamat_pengguna = $validatedData['alamat_pengguna'];
                $data->nama_wilayah = $validatedData['nama_wilayah'];
                $data->alamat_wilayah = $validatedData['alamat_wilayah'];
                $data->save();
                DB::commit();
                return response()->json(['id' => '1', 'data' => $data]);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['id' => '0', 'data' => $th->getMessage()]);
            }
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $data = User::find($id);
            if ($data) {
                $data->delete();
                return response()->json(['id' => '1', 'data' => 'Data deleted successfully']);
            } else {
                return response()->json(['id' => '0', 'data' => 'Data Tidak Ditemukan']);
            }
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }
}
