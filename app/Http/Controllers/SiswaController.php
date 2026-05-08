<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $siswas = Siswa::when($search, function ($query, $search) {
            $query->where('nama', 'ilike', "%{$search}%")
                  ->orWhere('nis', 'ilike', "%{$search}%")
                  ->orWhere('kelas', 'ilike', "%{$search}%");
        })->orderBy('nama')->paginate(10);

        return view('siswa.index', compact('siswas', 'search'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'           => 'required|string|max:20|unique:siswas,nis',
            'nama'          => 'required|string|max:100',
            'kelas'         => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp'         => 'nullable|string|max:15',
            'email'         => 'nullable|email|max:100|unique:siswas,email',
            'alamat'        => 'nullable|string',
        ], [
            'nis.required'           => 'NIS wajib diisi.',
            'nis.unique'             => 'NIS sudah terdaftar.',
            'nama.required'          => 'Nama wajib diisi.',
            'kelas.required'         => 'Kelas wajib dipilih.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'email.unique'           => 'Email sudah terdaftar.',
        ]);

        Siswa::create($request->only(['nis', 'nama', 'kelas', 'jenis_kelamin', 'no_hp', 'email', 'alamat']));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis'           => 'required|string|max:20|unique:siswas,nis,' . $siswa->id,
            'nama'          => 'required|string|max:100',
            'kelas'         => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp'         => 'nullable|string|max:15',
            'email'         => 'nullable|email|max:100|unique:siswas,email,' . $siswa->id,
            'alamat'        => 'nullable|string',
        ], [
            'nis.required'           => 'NIS wajib diisi.',
            'nis.unique'             => 'NIS sudah digunakan siswa lain.',
            'nama.required'          => 'Nama wajib diisi.',
            'kelas.required'         => 'Kelas wajib dipilih.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'email.unique'           => 'Email sudah digunakan siswa lain.',
        ]);

        $siswa->update($request->only(['nis', 'nama', 'kelas', 'jenis_kelamin', 'no_hp', 'email', 'alamat']));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
