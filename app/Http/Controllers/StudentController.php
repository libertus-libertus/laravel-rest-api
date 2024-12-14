<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'phone' => 'required|string|max:15',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Alamat email wajib diisi',
                'phone.required' => 'Phone wajib diisi',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ], 402);
    }
}
