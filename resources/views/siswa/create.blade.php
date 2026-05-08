@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="card" style="max-width:700px; margin:0 auto;">
    <div class="page-title">➕ Tambah Data Siswa</div>

    @if($errors->any())
    <div class="alert alert-error">
        ❌ Mohon perbaiki kesalahan berikut:
        <ul style="margin-top:6px; padding-left:20px;">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('siswa.store') }}" id="form-tambah-siswa">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="nis">NIS <span class="required">*</span></label>
                <input type="text" id="nis" name="nis" value="{{ old('nis') }}"
                       placeholder="Contoh: 12345" maxlength="20">
                @error('nis')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                       placeholder="Contoh: Budi Santoso" maxlength="100">
                @error('nama')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="kelas">Kelas <span class="required">*</span></label>
                <select id="kelas" name="kelas">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach(['X RPL 1','X RPL 2','XI RPL 1','XI RPL 2','XII RPL 1','XII RPL 2'] as $k)
                        <option value="{{ $k }}" {{ old('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kelas')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki"  {{ old('jenis_kelamin') == 'Laki-laki'  ? 'selected' : '' }}>♂ Laki-laki</option>
                    <option value="Perempuan"  {{ old('jenis_kelamin') == 'Perempuan'  ? 'selected' : '' }}>♀ Perempuan</option>
                </select>
                @error('jenis_kelamin')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="no_hp">No. HP / WA</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                       placeholder="Contoh: 08123456789" maxlength="15">
                @error('no_hp')<div class="error-msg">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       placeholder="Contoh: budi@email.com" maxlength="100">
                @error('email')<div class="error-msg">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" placeholder="Alamat lengkap siswa...">{{ old('alamat') }}</textarea>
            @error('alamat')<div class="error-msg">{{ $message }}</div>@enderror
        </div>

        <div style="display:flex; gap:10px; margin-top:8px;">
            <button type="submit" class="btn btn-primary" id="btn-simpan">💾 Simpan</button>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">✕ Batal</a>
        </div>
    </form>
</div>
@endsection
