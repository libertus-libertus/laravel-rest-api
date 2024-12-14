<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'gender' => 'required',
                'phone' => 'required'
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'gender.required' => 'Jenis kelamin harus diisi',
                'phone' => 'No telp harus diisi'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Pastikan seluruh inputan sudah valid',
                'errors' => $validator->errors()
            ]);
        }

        $teacher = Teacher::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditemukan',
                'data' => $teacher
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
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'gender' => 'nullable',
            'phone' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Pastikan seluruh inputan sudah valid',
                'errors' => $validator->errors()
            ]);
        }

        $teacher = Teacher::findOrFail($id);

        $teacher->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbaharui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil di hapus'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Maaf, data tidak ditemukan'
            ]);
        }
    }
}
