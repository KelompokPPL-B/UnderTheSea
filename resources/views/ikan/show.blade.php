@extends('layouts.app')

@section('content')

<style>
    body {
        margin: 0;
    }

    .fish-detail-page {
        min-height: 100vh;
        padding: 55px 20px 90px;
        background:
            linear-gradient(rgba(0, 28, 55, 0.20), rgba(0, 18, 40, 0.38)),
            url('{{ asset("images/ocean-bg.jpg") }}') no-repeat center center fixed;
        background-size: cover;
    }

    .detail-wrapper {
        max-width: 1100px;
        margin: 0 auto;
    }

.breadcrumb-box {
    width: fit-content;
    margin: 0 auto 22px 20px;
    padding: 0 24px;
    min-height: 50px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.55);
    backdrop-filter: blur(6px);
    box-shadow: 0 8px 22px rgba(0, 60, 100, 0.18);

    display: flex;
    align-items: center;
    justify-content: center;
}

.breadcrumb-box nav,
.breadcrumb-box ol,
.breadcrumb-box ul {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 1 !important;
}

.breadcrumb-box a,
.breadcrumb-box span,
.breadcrumb-box li {
    color: #004b73 !important;
    font-weight: 700 !important;
    line-height: 1 !important;
}

    .detail-card {
        background: rgba(0, 31, 63, 0.88);
        border: 1px solid rgba(88, 190, 255, 0.35);
        border-radius: 28px;
        padding: 34px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        backdrop-filter: blur(8px);
        color: white;
    }

    .top-detail {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 34px;
        align-items: center;
        margin-bottom: 32px;
    }

    .image-box {
        width: 100%;
        height: 330px;
        border-radius: 22px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 22px 45px rgba(0, 0, 0, 0.45);
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: 0.35s ease;
    }

    .image-box:hover img {
        transform: scale(1.04);
    }

    .no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.7);
        background: linear-gradient(135deg, rgba(0, 119, 200, 0.25), rgba(0, 200, 255, 0.12));
    }

    .title-area h1 {
        font-size: 46px;
        font-weight: 800;
        margin: 0;
        color: #ffffff;
        text-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
    }

    .subtitle {
        color: #39b9ff;
        font-size: 18px;
        font-weight: 700;
        margin-top: 8px;
        margin-bottom: 24px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 22px;
    }

    .info-box {
        padding: 16px;
        border-radius: 16px;
        background: rgba(0, 119, 200, 0.16);
        border: 1px solid rgba(70, 180, 255, 0.45);
    }

    .info-box.green {
        background: rgba(20, 150, 95, 0.16);
        border-color: rgba(90, 240, 160, 0.45);
    }

    .info-label {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        color: #42c2ff;
        margin-bottom: 7px;
    }

    .info-box.green .info-label {
        color: #6ff0a9;
    }

    .info-text {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        line-height: 1.5;
    }

    .short-desc {
        color: rgba(255, 255, 255, 0.82);
        line-height: 1.8;
        font-size: 15px;
    }

    .content-box {
        margin-top: 30px;
        padding: 28px;
        border-radius: 22px;
        background: rgba(0, 45, 86, 0.42);
        border: 1px solid rgba(90, 190, 255, 0.22);
        box-shadow: inset 0 0 28px rgba(0, 145, 255, 0.08);
    }

    .section-item {
        padding: 22px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.13);
    }

    .section-item:first-child {
        padding-top: 0;
    }

    .section-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .section-item h3 {
        font-size: 22px;
        font-weight: 800;
        color: white;
        margin-bottom: 8px;
    }

    .section-item p {
        color: rgba(255, 255, 255, 0.82);
        line-height: 1.8;
        font-size: 15px;
        margin: 0;
    }

    .button-area {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid rgba(255, 255, 255, 0.14);
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        border-radius: 30px;
        color: #56c8ff;
        background: rgba(0, 119, 200, 0.18);
        border: 1px solid rgba(86, 200, 255, 0.65);
        text-decoration: none;
        font-weight: 700;
        transition: 0.25s ease;
    }

    .back-btn:hover {
        background: #0077c8;
        color: white;
        transform: translateY(-2px);
    }

    .edit-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        border-radius: 30px;
        color: white;
        background: #f59e0b;
        border: none;
        text-decoration: none;
        font-weight: 700;
        transition: 0.25s ease;
    }

    .edit-btn:hover {
        background: #d97706;
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 850px) {
        .detail-card {
            padding: 24px;
        }

        .top-detail {
            grid-template-columns: 1fr;
        }

        .title-area h1 {
            font-size: 36px;
        }

        .image-box {
            height: 260px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="fish-detail-page">
    <div class="detail-wrapper">

        <div class="breadcrumb-box">
            @include('layouts.breadcrumb', ['breadcrumbs' => [
                ['label' => 'Fish Species', 'url' => route('ikan.index')],
                ['label' => $ikan->nama]
            ]])
        </div>

        <div class="detail-card">

            <div class="top-detail">
                <div class="image-box">
                    @if($ikan->gambar)
                        <img src="{{ asset('storage/' . $ikan->gambar) }}" alt="{{ $ikan->nama }}" loading="lazy">
                    @else
                        <div class="no-image">No image</div>
                    @endif
                </div>

                <div class="title-area">
                    <h1>{{ $ikan->nama }}</h1>
                    <div class="subtitle">🐟 Fish Species</div>

                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-label">Habitat</div>
                            <div class="info-text">{{ $ikan->habitat ?? 'Not specified' }}</div>
                        </div>

                        <div class="info-box green">
                            <div class="info-label">Conservation Status</div>
                            <div class="info-text">{{ $ikan->status_konservasi ?? 'Not specified' }}</div>
                        </div>
                    </div>

                    <p class="short-desc">
                        {{ $ikan->deskripsi ?? 'No description available' }}
                    </p>
                </div>
            </div>

            <div class="content-box">
                <div class="section-item">
                    <h3>Description</h3>
                    <p>{{ $ikan->deskripsi ?? 'No description available' }}</p>
                </div>

                <div class="section-item">
                    <h3>Characteristics</h3>
                    <p>{{ $ikan->karakteristik ?? 'No characteristics available' }}</p>
                </div>

                <div class="section-item">
                    <h3>Unique Facts</h3>
                    <p>{{ $ikan->fakta_unik ?? 'No unique facts available' }}</p>
                </div>
            </div>

            <div class="button-area">
                <a href="{{ route('ikan.index') }}" class="back-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                    Back to Fish
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('ikan.edit', $ikan->id_ikan) }}" class="edit-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit
                        </a>
                    @endif
                @endauth
            </div>

        </div>
    </div>
</div>

@endsection