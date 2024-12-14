<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapel::all();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil di tampilkan',
            'data' => $mapel
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['name' => 'required'],
            ['name.required' => 'Mata pelajaran harus di isikan']
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak berhasil di tambahkan',
                'errors' => $validator->errors()
            ]);
        }

        $mapel = Mapel::create(['name' => $request->name]);

        return response()->json([
            'status' => true,
            'message' => 'Data sudah di tambahkan',
            'data' => $mapel
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $mapel = Mapel::findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $mapel
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),
            ['name' => 'nullable']
        );

        $mapel = Mapel::findOrFail($id);
        $mapel->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil di perbaharui',
            'data' => $mapel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mapel = Mapel::findOrFail($id);
            $mapel->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil di hapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan, tidak berhasil dihapus'
            ]);
        }
    }
}
