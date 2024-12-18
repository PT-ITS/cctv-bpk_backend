<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\Progres;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    public function detail($id)
    {
        try {
            $data = Progres::join('pemeriksaans', 'progres.pemeriksaan_id', '=', 'pemeriksaans.id')
                ->join('pengguna_wilayahs', 'progres.user_id', '=', 'pengguna_wilayahs.user_id')
                ->select('pemeriksaans.jenis_pemeriksaan', 'pengguna_wilayahs.nama_pengguna', 'pengguna_wilayahs.nama_wilayah', 'pengguna_wilayahs.alamat_wilayah', 'progres.*')
                ->where('progres.id', $id)
                ->first();
            return response()->json(['id' => '1', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function listByPemeriksaan($id)
    {
        try {
            $data = Progres::join('pemeriksaans', 'progres.pemeriksaan_id', '=', 'pemeriksaans.id')
                ->join('pengguna_wilayahs', 'progres.user_id', '=', 'pengguna_wilayahs.user_id')
                ->select('pemeriksaans.jenis_pemeriksaan', 'pengguna_wilayahs.nama_pengguna', 'pengguna_wilayahs.nama_wilayah', 'pengguna_wilayahs.alamat_wilayah', 'progres.*')
                ->where('progres.pemeriksaan_id', $id)
                ->get();
            return response()->json(['id' => '1', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['id' => '0', 'data' => $th->getMessage()]);
        }
    }

    public function listByUser($id)
    {
        try {
            $data = Progres::join('pemeriksaans', 'progres.pemeriksaan_id', '=', 'pemeriksaans.id')
                ->join('pengguna_wilayahs', 'progres.user_id', '=', 'pengguna_wilayahs.user_id')
                ->select('pemeriksaans.jenis_pemeriksaan', 'pengguna_wilayahs.nama_pengguna', 'pengguna_wilayahs.nama_wilayah', 'pengguna_wilayahs.alamat_wilayah', 'progres.*')
                ->where('progres.user_id', $id)
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
                'progres_pemeriksaan' => 'required',
                'tanggal' => 'required',
                'lampiran' => 'required|file|mimes:pdf|max:2048',
                'keterangan' => 'required',
                'pemeriksaan_id' => 'required|exists:pemeriksaans,id',
            ]);
            $validatedData['user_id'] = auth()->user()->id;

            DB::beginTransaction();
            try {
                $filePath = $request->file('lampiran')->store('lampiran_pemeriksaans', 'public');
                $data = Progres::create([
                    'progres_pemeriksaan' => $validatedData['progres_pemeriksaan'],
                    'tanggal' => $validatedData['tanggal'],
                    'lampiran' => $filePath,
                    'keterangan' => $validatedData['keterangan'],
                    'pemeriksaan_id' => $validatedData['pemeriksaan_id'],
                    'user_id' => $validatedData['user_id'],
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

    public function validasi(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required',
            ]);

            DB::beginTransaction();
            try {
                $data = Progres::find($id);
                $data->status = $validatedData['status'];
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

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'progres_pemeriksaan' => 'required',
                'tanggal' => 'required',
                'lampiran' => 'nullable|file|mimes:pdf|max:2048',
                'keterangan' => 'required',
                'pemeriksaan_id' => 'required|exists:pemeriksaans,id',
            ]);
            $validatedData['user_id'] = auth()->user()->id;

            DB::beginTransaction();
            try {
                $data = Progres::find($id);
                if ($request->hasFile('lampiran')) {
                    if ($data->lampiran && Storage::disk('public')->exists($data->lampiran)) {
                        Storage::disk('public')->delete($data->lampiran);
                    }
                    $filePath = $request->file('lampiran')->store('lampiran_pemeriksaans', 'public');
                    $data->lampiran = $filePath;
                }
                $data->progres_pemeriksaan = $validatedData['progres_pemeriksaan'];
                $data->tanggal = $validatedData['tanggal'];
                // $data->lampiran = $validatedData['lampiran'];
                $data->keterangan = $validatedData['keterangan'];
                $data->pemeriksaan_id = $validatedData['pemeriksaan_id'];
                $data->user_id = $validatedData['user_id'];
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
            $data = Progres::find($id);
            if ($data) {
                if ($data->lampiran && Storage::disk('public')->exists($data->lampiran)) {
                    Storage::disk('public')->delete($data->lampiran);
                }
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
