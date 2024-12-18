<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PemeriksaanController extends Controller
{

    public function detail($id)
    {
        try {
            $data = Pemeriksaan::find($id);
            return response()->json(['id' => '1', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function list()
    {
        try {
            $data = Pemeriksaan::get();
            return response()->json(['id' => '1', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'jenis_pemeriksaan' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $data = Pemeriksaan::create([
                    'jenis_pemeriksaan' => $validatedData['jenis_pemeriksaan'],
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
                'jenis_pemeriksaan' => 'required',
            ]);

            DB::beginTransaction();
            try {

                $data = Pemeriksaan::find($id);
                $data->jenis_pemeriksaan = $validatedData['jenis_pemeriksaan'];
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
            $data = Pemeriksaan::find($id);
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
