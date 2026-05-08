@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
<div class="card">
    <div class="page-title">📋 Daftar Siswa RPL</div>

    {{-- Search + Tambah --}}
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:16px;">
        <form method="GET" action="{{ route('siswa.index') }}" class="search-bar" style="margin-bottom:0;">
            <input type="text" id="search" name="search" placeholder="Cari nama, NIS, atau kelas..."
                   value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary">🔍 Cari</button>
            @if($search)
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">✕ Reset</a>
            @endif
        </form>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary" id="btn-tambah">+ Tambah Siswa</a>
    </div>

    {{-- Info jumlah --}}
    <p style="font-size:13px; color:#6b7280; margin-bottom:8px;">
        Total: <strong>{{ $siswas->total() }}</strong> siswa
        @if($search) — hasil pencarian "<em>{{ $search }}</em>" @endif
    </p>

    {{-- Tabel --}}
    @if($siswas->count() > 0)
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>JK</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th style="width:130px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $i => $siswa)
                <tr>
                    <td>{{ $siswas->firstItem() + $i }}</td>
                    <td><strong>{{ $siswa->nis }}</strong></td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>
                        <span class="badge {{ $siswa->jenis_kelamin === 'Laki-laki' ? 'badge-laki' : 'badge-perempuan' }}">
                            {{ $siswa->jenis_kelamin === 'Laki-laki' ? '♂' : '♀' }} {{ $siswa->jenis_kelamin }}
                        </span>
                    </td>
                    <td>{{ $siswa->no_hp ?? '—' }}</td>
                    <td>{{ $siswa->email ?? '—' }}</td>
                    <td>
                        <div class="actions" style="justify-content:center;">
                            <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-warning btn-sm"
                               id="btn-edit-{{ $siswa->id }}">✏️ Edit</a>
                            <form method="POST" action="{{ route('siswa.destroy', $siswa) }}"
                                  onsubmit="return confirm('Yakin hapus data {{ $siswa->nama }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        id="btn-hapus-{{ $siswa->id }}">🗑️ Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination">
        {{ $siswas->appends(['search' => $search])->links() }}
    </div>

    @else
    <div class="empty-state">
        <div style="font-size:40px;">📭</div>
        <p>@if($search) Tidak ada siswa yang cocok dengan "<strong>{{ $search }}</strong>". @else Belum ada data siswa. Klik <strong>+ Tambah Siswa</strong> untuk mulai. @endif</p>
    </div>
    @endif
</div>
@endsection
