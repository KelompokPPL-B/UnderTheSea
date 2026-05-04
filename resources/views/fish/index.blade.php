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
                <a href="{{ route('ikan.create') }}" class="bg-[#42A5F5] hover:bg-[#1E88E5] text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 inline-block">+ Create fish</a>
            @endauth
        </div>
            <!-- Bootstrap card for Ikan Nemo -->
            <div class="card mb-3" style="max-width: 740px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/images/nemo.jpg" class="img-fluid rounded-start" alt="Ikan Nemo">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
