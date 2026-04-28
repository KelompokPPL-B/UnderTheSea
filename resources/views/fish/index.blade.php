@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Fish</h1>
            <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start mb-10">
            @auth
                <a href="{{ route('ikan.create') }}" class="btn btn-primary btn-sm whitespace-nowrap">+ Create fish</a>
            @endauth
        </div>
            <!-- Bootstrap card for Ikan Nemo -->
            <div class="card mb-3" style="max-width: 740px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/images/nemo.jpg" class="img-fluid rounded-start" alt="Ikan Nemo">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Ikan Nemo</h5>
                            <p class="card-text">Ikan Nemo adalah ikan kecil berwarna oranye dengan garis putih yang hidup di laut tropis.</p>
                            <a href="{{ route('ikan.show', 1) }}" class="btn btn-primary" id="lihat-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
