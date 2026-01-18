@extends('layouts.app')

@section('title', 'LuhurCamp - Debug Mode')

@section('content')
    <div class="min-h-screen bg-gray-900 text-white flex items-center justify-center flex-col gap-4">
        <h1 class="text-4xl font-bold text-azure-500">DEBUG MODE</h1>
        <p class="text-gray-400">Jika halaman ini muncul, berarti Layout & Vite aman.</p>
        <p>Masalah ada di kode konten landing page (kemungkinan syntax error atau asset hilang).</p>
    </div>
@endsection