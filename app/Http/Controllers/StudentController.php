<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        $mahasiswaPerProdi = Student::select('prodi', DB::raw('count(*) as total'))
            ->groupBy('prodi')->get();

        $mahasiswaPerAngkatan = Student::select('angkatan', DB::raw('count(*) as total'))
            ->groupBy('angkatan')->orderBy('angkatan')->get();

        $lulusPerAngkatan = Student::select('angkatan', DB::raw('count(*) as total'))
            ->where('status_lulus', 1)
            ->groupBy('angkatan')->orderBy('angkatan')->get();

        $perJenisKelamin = Student::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')->get();

        return view('student.index', compact(
            'students',
            'mahasiswaPerProdi',
            'mahasiswaPerAngkatan',
            'lulusPerAngkatan',
            'perJenisKelamin'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email',
            'prodi'         => 'required|string',
            'angkatan'      => 'required|integer',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        Student::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'prodi'         => $request->prodi,
            'angkatan'      => $request->angkatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_lulus'  => $request->has('status_lulus') ? 1 : 0,
        ]);

        return redirect('/student')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:students,email,' . $id,
            'prodi'         => 'required|string',
            'angkatan'      => 'required|integer',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $student = Student::findOrFail($id);

        $student->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'prodi'         => $request->prodi,
            'angkatan'      => $request->angkatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_lulus'  => $request->has('status_lulus') ? 1 : 0,
        ]);

        return redirect('/student')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return redirect('/student')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}