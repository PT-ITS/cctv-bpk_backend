<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\Progres;

class PemeriksaanController extends Controller
{
    public function listPengajuan()
    {
        $dataPemeriksaan = Pemeriksaan::all();
        return response()->json([
            'id' => '1',
            'data' => $dataPemeriksaan
        ]);
    }

    public function createPemeriksaan(Request $request)
    {
        try {
            $validateData = $request->validate([
                'jenis_pemeriksaan' => 'required',
                'user_id' => 'required' 
            ]);

            $pemeriksaan = Pemeriksaan::create([
                'jenis_pemeriksaan' => $validateData['jenis_pemeriksaan'],
                'user_id' => $validateData['user_id'],
                // 'user_id' => auth()->user()->id
            ]);
            return response()->json([
                'id' => '1',
                'data' => $pemeriksaan
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'id' => '0',
                'data' => $th
            ]);
        }
    }

    public function updatePemeriksaan(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'jenis_pemeriksaan' => 'required' 
            ]);

            $pemeriksaan = Pemeriksaan::find($id);
            $pemeriksaan->jenis_pemeriksaan = $validateData['jenis_pemeriksaan'];
            $pemeriksaan->save();
            return response()->json([
                'id' => '1',
                'data' => $pemeriksaan
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'id' => '0',
                'data' => $th
            ]);
        }
    }

    public function deletePemeriksaan($id)
    {
        try {
            $pemeriksaan = Pemeriksaan::find($id);
            $pemeriksaan->delete();
            return response()->json([
                'id' => '1',
                'data' => $pemeriksaan
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'id' => '0',
                'data' => $th
            ]);
        }
    }

    public function createProgres(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id_pemeriksaan' => 'required',
                'progres_pemeriksaan' => 'required',
                'tanggal' => 'required',
                'lampiran' => 'required',
                'keterangan' => 'required',
                'status' => 'required'
            ]);

            $progres = Progres::create([
                'id_pemeriksaan' => $validateData['id_pemeriksaan'],
                'progres_pemeriksaan' => $validateData['progres_pemeriksaan'],
                'tanggal' => $validateData['tanggal'],
                'lampiran' => $validateData['lampiran'],
                'keterangan' => $validateData['keterangan'],
                'status' => $validateData['status']
            ]);
            return response()->json([
                'id' => '1',
                'data' => $progres
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'id' => '0',
                'data' => $th
            ]);
        }
    }

    public function updateProgres(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'id_pemeriksaan' => 'required',
                'progres_pemeriksaan' => 'required',
                'tanggal' => 'required',
                'lampiran' => 'required',
                'keterangan' => 'required',
                'status' => 'required'
            ]); 

            $progres = Progres::find($id);
            $progres->id_pemeriksaan = $validateData['id_pemeriksaan'];
            $progres->progres_pemeriksaan = $validateData['progres_pemeriksaan'];
            $progres->tanggal = $validateData['tanggal'];
            $progres->lampiran = $validateData['lampiran'];
            $progres->keterangan = $validateData['keterangan'];
            $progres->status = $validateData['status'];
            $progres->save();
            return response()->json([
                'id' => '1',
                'data' => $progres
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'id' => '0',
                'data' => $th
            ]);
        }
    }

    public function deleteProgres($id)
    {
        try {
            $progres = Progres::find($id);
            $progres->delete();
            return response()->json([
                'id' => '1',
                'data' => $progres
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'id' => '0',
                'data' => $th
            ]);
        }
    }
}
