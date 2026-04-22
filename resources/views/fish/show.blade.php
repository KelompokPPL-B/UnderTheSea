@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Detail Ikan</h1>

            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                        <img id="fish-image" src="" class="img-fluid" alt="Gambar Ikan">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 id="fish-name">-</h3>
                            <p><strong>Nama Ilmiah:</strong> <span id="fish-scientific">-</span></p>
                            <p><strong>Habitat:</strong> <span id="fish-habitat">-</span></p>
                            <p><strong>Deskripsi:</strong> <span id="fish-description">-</span></p>
                            <p><strong>Makanan:</strong> <span id="fish-food">-</span></p>
                            <a href="{{ route('ikan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // read id from URL path (/ikan/{id})
        const pathParts = window.location.pathname.split('/').filter(Boolean);
        const id = pathParts[pathParts.length - 1];
        const key = `fish_${id}`;
        const raw = localStorage.getItem(key);
        if (!raw) {
            // create default Nemo if missing
            const nemo = {
                id: 1,
                name: 'Ikan Nemo',
                scientific_name: 'Amphiprioninae',
                habitat: 'Terumbu karang',
                description: 'Ikan Nemo adalah ikan kecil berwarna oranye dengan garis putih yang hidup di laut tropis.',
                food: 'Plankton dan alga',
                image: '/images/nemo.jpg'
            };
            localStorage.setItem('fish_1', JSON.stringify(nemo));
            if (id == '1') populate(nemo);
            else document.getElementById('fish-name').textContent = 'Data ikan tidak tersedia';
            return;
        }

        try {
            const fish = JSON.parse(raw);
            populate(fish);
        } catch (e) {
            console.error('Invalid fish data in Local Storage', e);
            document.getElementById('fish-name').textContent = 'Data ikan tidak tersedia';
        }

        function populate(fish) {
            document.getElementById('fish-name').textContent = fish.name || '-';
            document.getElementById('fish-scientific').textContent = fish.scientific_name || '-';
            document.getElementById('fish-habitat').textContent = fish.habitat || '-';
            document.getElementById('fish-description').textContent = fish.description || '-';
            document.getElementById('fish-food').textContent = fish.food || '-';
            const img = document.getElementById('fish-image');
            img.src = fish.image || '/images/nemo.jpg';
            img.alt = fish.name || 'Ikan';
        }
    });
</script>

@endsection
