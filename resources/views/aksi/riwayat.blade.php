@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-4xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-6">
            <h1 style="font-size:28px; font-weight:700; color:#0c4a6e; margin-bottom:4px;">
                My Action History
            </h1>
            <p style="font-size:14px; color:#6b7280;">
                Track all the conservation actions you've contributed to.
            </p>
        </div>

        {{-- Flash: clear success --}}
        @if(session('clear_success'))
            <div style="display:flex; align-items:center; gap:10px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:12px; padding:12px 16px; margin-bottom:20px; font-size:13px; font-weight:500; color:#15803d;">
                <span style="font-size:16px; flex-shrink:0;">✅</span>
                {{ session('clear_success') }}
            </div>
        @endif

        {{-- Flash: info --}}
        @if(session('tandai_info'))
            <div style="display:flex; align-items:center; gap:10px; background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; padding:12px 16px; margin-bottom:20px; font-size:13px; font-weight:500; color:#1d4ed8;">
                <span style="font-size:16px; flex-shrink:0;">ℹ️</span>
                {{ session('tandai_info') }}
            </div>
        @endif

        {{-- ===================== --}}
        {{-- EMPTY STATE           --}}
        {{-- ===================== --}}
        @if($riwayat->isEmpty())
            <div style="background:#fff; border-radius:20px; box-shadow:0 2px 12px rgba(0,0,0,0.07); padding:64px 32px; text-align:center;">
                <div style="font-size:56px; margin-bottom:16px;">🌊</div>
                <h3 style="font-size:20px; font-weight:700; color:#0c4a6e; margin-bottom:8px;">No history yet</h3>
                <p style="font-size:14px; color:#6b7280; margin-bottom:28px; line-height:1.6;">
                    You haven't marked any conservation actions yet.<br>
                    Start contributing and your history will appear here!
                </p>
                <a href="{{ route('aksi.index') }}"
                   style="position:relative; z-index:10; display:inline-block; background:#2563eb; color:#fff; font-size:13px; font-weight:700; padding:10px 24px; border-radius:10px; text-decoration:none;"
                   onmouseover="this.style.background='#1d4ed8'"
                   onmouseout="this.style.background='#2563eb'">
                    Browse Conservation Actions
                </a>
            </div>

        {{-- ===================== --}}
        {{-- LIST RIWAYAT          --}}
        {{-- ===================== --}}
        @else

            {{-- Toolbar --}}
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:12px;">

                {{-- Kiri: Actions Done badge — ukuran angka dan teks diselaraskan --}}
                <div style="display:inline-flex; align-items:center; gap:8px; background:#fff; border:1.5px solid #bfdbfe; border-radius:14px; padding:9px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                    <span style="font-size:16px; font-weight:700; color:#1e40af; line-height:1;">{{ $riwayat->total() }}</span>
                    <span style="font-size:14px; color:#6b7280; font-weight:500; line-height:1;">Actions Done</span>
                </div>

                {{-- Kanan: ikon tong sampah + Sort --}}
                <div style="display:flex; align-items:center; gap:10px;">

                    {{-- Tombol Clear History: hanya ikon tong sampah merah --}}
                    <form action="{{ route('aksi.riwayat.clear') }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to clear all your history? This cannot be undone.');"
                          style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                title="Clear History"
                                style="display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; background:#fff; border:1.5px solid #fca5a5; border-radius:10px; cursor:pointer; transition:all 0.2s; padding:0;"
                                onmouseover="this.style.background='#fef2f2'; this.style.borderColor='#ef4444';"
                                onmouseout="this.style.background='#fff'; this.style.borderColor='#fca5a5';">
                            {{-- Ikon tong sampah SVG merah --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 style="width:17px; height:17px; color:#ef4444;"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke="#ef4444" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>

                    {{-- Sort by --}}
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:13px; color:#6b7280; font-weight:500; white-space:nowrap;">Sort by:</span>
                        <select onchange="window.location.href='{{ route('aksi.riwayat') }}?sort=' + this.value"
                                style="font-size:13px; padding:8px 36px 8px 14px; border:1.5px solid #bfdbfe; border-radius:10px; background-color:#fff; color:#1e3a5f; font-weight:600; cursor:pointer; appearance:none; background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%236b7280%22 stroke-width=%222.5%22><path stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M19 9l-7 7-7-7%22/></svg>'); background-repeat:no-repeat; background-position:right 12px center; min-width:155px; outline:none;">
                            {{-- "event" diganti "action" --}}
                            <option value="newest_event" {{ $sort === 'newest_event' ? 'selected' : '' }}>Newest Action</option>
                            <option value="oldest_event" {{ $sort === 'oldest_event' ? 'selected' : '' }}>Oldest Action</option>
                        </select>
                    </div>

                </div>
            </div>

            {{-- List cards --}}
            <div class="space-y-3">
                @foreach($riwayat as $item)
                    @php
                        $aksi = $item->aksi;
                        $no   = ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration;

                        if ($aksi && $aksi->tanggal_kegiatan) {
                            $tanggalLabel  = $aksi->tanggal_kegiatan->format('d M Y');
                            $tanggalPrefix = 'Event Date';
                        } else {
                            $tanggalLabel  = $item->ditandai_pada->format('d M Y, H:i');
                            $tanggalPrefix = 'Marked Date';
                        }
                    @endphp

                    <div style="background:#fff; border-radius:16px; box-shadow:0 1px 6px rgba(0,0,0,0.07); overflow:hidden; transition:box-shadow 0.2s;"
                         onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.11)'"
                         onmouseout="this.style.boxShadow='0 1px 6px rgba(0,0,0,0.07)'">
                        <div style="display:flex; align-items:center; min-height:80px;">

                            {{-- Nomor --}}
                            <div style="display:flex; align-items:center; justify-content:center; width:48px; min-width:48px; background:#f0f9ff; border-right:1px solid #e0f2fe; align-self:stretch; flex-shrink:0;">
                                <span style="font-size:12px; font-weight:700; color:#7dd3fc;">{{ $no }}.</span>
                            </div>

                            {{-- Thumbnail 52x52 --}}
                            <div style="padding:0 14px; flex-shrink:0;">
                                <div style="width:52px; height:52px; border-radius:10px; overflow:hidden; border:1px solid #e5e7eb;">
                                    @if($aksi && $aksi->gambar)
                                        <img src="/storage/{{ $aksi->gambar }}"
                                             alt="{{ $aksi->judul_aksi }}"
                                             style="width:52px; height:52px; object-fit:cover; display:block;">
                                    @else
                                        <div style="width:52px; height:52px; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#e0f2fe,#d1fae5);">
                                            <span style="font-size:20px; line-height:1;">🌿</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Konten tengah --}}
                            <div style="flex:1; min-width:0; padding:12px 12px 12px 0;">

                                @if($aksi)
                                    <a href="{{ route('aksi.show', $aksi->id_aksi) }}"
                                       style="font-size:14px; font-weight:700; color:#0c4a6e; display:block; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:5px; text-decoration:none;"
                                       onmouseover="this.style.color='#0284c7'"
                                       onmouseout="this.style.color='#0c4a6e'">
                                        {{ $aksi->judul_aksi }}
                                    </a>
                                @else
                                    <p style="font-size:14px; font-weight:700; color:#9ca3af; font-style:italic; margin-bottom:5px;">
                                        [Action no longer available]
                                    </p>
                                @endif

                                {{-- Baris 1: Avatar + Nama --}}
                                <div style="display:flex; align-items:center; gap:6px; margin-bottom:4px;">
                                    <div style="width:18px; height:18px; border-radius:50%; background:#bfdbfe; display:flex; align-items:center; justify-content:center; font-size:9px; font-weight:700; color:#1d4ed8; flex-shrink:0;">
                                        {{ strtoupper(substr($item->nama_peserta, 0, 1)) }}
                                    </div>
                                    <span style="font-size:12px; font-weight:600; color:#1e3a5f; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                        {{ $item->nama_peserta }}
                                    </span>
                                </div>

                                {{-- Baris 2: Tanggal + Lokasi --}}
                                <div style="display:flex; align-items:center; gap:6px; flex-wrap:nowrap; overflow:hidden;">
                                    <div style="display:flex; align-items:center; gap:4px; flex-shrink:0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:12px; height:12px; flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="#93c5fd" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span style="font-size:11px; color:#94a3b8; font-weight:500; white-space:nowrap;">{{ $tanggalPrefix }}:</span>
                                        <span style="font-size:11px; color:#6b7280; white-space:nowrap;">{{ $tanggalLabel }}</span>
                                    </div>

                                    @if($aksi && $aksi->lokasi)
                                        <span style="color:#d1d5db; font-size:11px; flex-shrink:0;">·</span>
                                        <div style="display:flex; align-items:center; gap:4px; min-width:0; overflow:hidden;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width:12px; height:12px; flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="#6ee7b7" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span style="font-size:11px; color:#6b7280; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $aksi->lokasi }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Kolom kanan: Done + View --}}
                            <div style="display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; padding:0 18px; border-left:1px solid #f1f5f9; align-self:stretch; min-width:100px; flex-shrink:0;">
                                <span style="display:inline-flex; align-items:center; gap:4px; background:#dcfce7; color:#15803d; font-size:11px; font-weight:700; padding:4px 10px; border-radius:999px; border:1px solid #bbf7d0; white-space:nowrap;">
                                    ✅ Done
                                </span>
                                @if($aksi)
                                    <a href="{{ route('aksi.show', $aksi->id_aksi) }}"
                                       style="font-size:12px; color:#0ea5e9; font-weight:600; white-space:nowrap; text-decoration:none;"
                                       onmouseover="this.style.textDecoration='underline'"
                                       onmouseout="this.style.textDecoration='none'">
                                        View →
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8 flex justify-center">
                {{ $riwayat->appends(['sort' => $sort])->links() }}
            </div>

        @endif

    </div>
</div>
@endsection