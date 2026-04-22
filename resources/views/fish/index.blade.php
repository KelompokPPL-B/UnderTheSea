@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Fish</h1>

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

<!-- Script: initialize Local Storage for Nemo if not present -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const key = 'fish_1';
        if (!localStorage.getItem(key)) {
            const nemo = {
                id: 1,
                name: 'Ikan Nemo',
                scientific_name: 'Amphiprioninae',
                habitat: 'Terumbu karang',
                description: 'Ikan Nemo adalah ikan kecil berwarna oranye dengan garis putih yang hidup di laut tropis.',
                food: 'Plankton dan alga',
                image: '/images/nemo.jpg'
            };
            localStorage.setItem(key, JSON.stringify(nemo));
        }
    });
</script>

@endsection
