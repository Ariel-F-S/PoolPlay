@extends('layouts.master')

@section('title', 'PoolPlay - Tentang Kami')

@section('content')
<div class="container py-5">
    
    <div class="card border-0 shadow-sm p-4 rounded-4" style="max-width: 600px; margin: 0 auto;">
        <h4 class="fw-bold mb-3" style="color: #023E8A;">Tentang Pengembang</h4>
        
        <p class="text-muted">
            Website toko perlengkapan renang <strong>PoolPlay</strong> ini dibuat untuk memenuhi tugas pemrograman web menggunakan framework Laravel dan basis data MySQL.
        </p>

        <hr>

        <img src="{{ asset('WIN_20260415_07_54_07_Pro.jpg')}}">

        <h6 class="fw-bold text-dark mb-3">Biodata Singkat:</h6>
        <ul class="list-unstyled mb-0">
            <li class="mb-2"><strong>Nama:</strong> Ariel Ferdiansyah Susanto</li>
            <li class="mb-2"><strong>Prodi:</strong> D3 Manajemen Informatika</li>
            <li class="mb-2"><strong>Kampus:</strong> Politeknik Negeri Malang PSDKU Kediri</li>
            <li class="mb-0"><strong>Project:</strong> PoolPlay Web App (Laravel CRUD)</li>
        </ul>
    </div>

</div>
@endsection