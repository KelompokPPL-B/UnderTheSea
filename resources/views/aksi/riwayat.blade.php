@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-4xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-ocean-900 mb-1">My Action History</h1>
            <p class="text-gray-500 text-sm mb-6">
                Track all the conservation actions you've contributed to.
            </p>
        </div>

        {{-- Flash messages --}}
        @if(session('tandai_info'))
            <div class="mb-5 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium bg-blue-50 border border-blue-200 text-blue-800">
                <span class="shrink-0 text-base">ℹ️</span>
                {{ session('tandai_info') }}
            </div>
        @endif

        {{-- Empty State --}}
        @if($riwayat->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-14 text-center">
                <div class="text-6xl mb-4">🌊</div>
                <h3 class="text-xl font-bold text-ocean-900 mb-2">No history yet</h3>
                <p class="text-gray-500 text-sm mb-6">
                    You haven't marked any conservation actions yet.<br>
                    Start contributing and your history will appear here!
                </p>
                <a href="{{ route('aksi.index') }}" class="btn btn-primary btn-sm">
                    Browse Conservation Actions
                </a>
            </div>

        @else

            {{-- Toolbar: Actions Done (kiri) + Sort by (kanan) --}}
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">

                {{-- Actions Done --}}
                <div style="display: inline-flex; align-items: center; gap: 10px; background: #fff; border: 1.5px solid #bfdbfe; border-radius: 16px; padding: 10px 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                    <span style="font-size: 22px; font-weight: 700; color: #1e40af;">{{ $riwayat->total() }}</span>
                    <span style="font-size: 13px; color: #6b7280; font-weight: 500;">Actions Done</span>
                </div>

                {{-- Sort by --}}
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 14px; color: #6b7280; font-weight: 500; white-space: nowrap;">Sort by:</span>
                    <select onchange="window.location.href='{{ route('aksi.riwayat') }}?sort=' + this.value"
                            style="font-size: 14px; padding: 8px 36px 8px 14px; border: 1.5px solid #bfdbfe; border-radius: 10px; background-color: #fff; color: #1e3a5f; font-weight: 600; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%236b7280%22 stroke-width=%222.5%22><path stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M19 9l-7 7-7-7%22/></svg>'); background-repeat: no-repeat; background-position: right 12px center; min-width: 160px; outline: none;">
                        <option value="newest_event" {{ $sort === 'newest_event' ? 'selected' : '' }} style="font-size: 14px;">Newest Event</option>
                        <option value="oldest_event" {{ $sort === 'oldest_event' ? 'selected' : '' }} style="font-size: 14px;">Oldest Event</option>
                    </select>
                </div>
            </div>

            {{-- List cards --}}
            <div class="space-y-4">
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

                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition overflow-hidden">
                        <div style="display: flex; align-items: center; min-height: 88px;">

                            {{-- Nomor --}}
                            <div style="display: flex; align-items: center; justify-content: center; width: 52px; background: #f0f9ff; border-right: 1px solid #e0f2fe; align-self: stretch; flex-shrink: 0;">
                                <span style="font-size: 13px; font-weight: 700; color: #7dd3fc;">{{ $no }}.</span>
                            </div>

                            {{-- Thumbnail FIXED 56x56 --}}
                            <div style="padding: 0 16px; flex-shrink: 0;">
                                <div style="width: 56px; height: 56px; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; flex-shrink: 0;">
                                    @if($aksi && $aksi->gambar)
                                        <img src="/storage/{{ $aksi->gambar }}"
                                             alt="{{ $aksi->judul_aksi }}"
                                             style="width: 56px; height: 56px; object-fit: cover; display: block;">
                                    @else
                                        <div style="width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #e0f2fe, #d1fae5);">
                                            <span style="font-size: 22px; line-height: 1;">🌿</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Konten tengah --}}
                            <div style="flex: 1; min-width: 0; padding: 14px 16px 14px 0;">

                                @if($aksi)
                                    <a href="{{ route('aksi.show', $aksi->id_aksi) }}"
                                       style="font-size: 14px; font-weight: 700; color: #0c4a6e; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 6px; text-decoration: none;"
                                       onmouseover="this.style.color='#0284c7'"
                                       onmouseout="this.style.color='#0c4a6e'">
                                         {{ $aksi->judul_aksi }}
                                    </a>
                                @else
                                    <p style="font-size: 14px; font-weight: 700; color: #9ca3af; font-style: italic; margin-bottom: 6px;">
                                        [Action no longer available]
                                    </p>
                                @endif

                                {{-- Baris 1: Avatar + Nama --}}
                                <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 5px;">
                                    <div style="width: 20px; height: 20px; border-radius: 50%; background: #bfdbfe; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: #1d4ed8; flex-shrink: 0;">
                                        {{ strtoupper(substr($item->nama_peserta, 0, 1)) }}
                                    </div>
                                    <span style="font-size: 12px; font-weight: 600; color: #1e3a5f; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->nama_peserta }}</span>
                                </div>

                                {{-- Baris 2: Tanggal + Lokasi --}}
                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: nowrap;">

                                    <div style="display: flex; align-items: center; gap: 5px; flex-shrink: 0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 13px; height: 13px; color: #93c5fd; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span style="font-size: 11px; color: #94a3b8; font-weight: 500; white-space: nowrap;">{{ $tanggalPrefix }}:</span>
                                        <span style="font-size: 12px; color: #6b7280; white-space: nowrap;">{{ $tanggalLabel }}</span>
                                    </div>

                                    @if($aksi && $aksi->lokasi)
                                        <span style="color: #d1d5db; font-size: 12px; flex-shrink: 0;">·</span>
                                        <div style="display: flex; align-items: center; gap: 5px; min-width: 0;">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 13px; height: 13px; color: #6ee7b7; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span style="font-size: 12px; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $aksi->lokasi }}</span>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            {{-- Kolom kanan: Done + View --}}
                            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; padding: 0 20px; border-left: 1px solid #f1f5f9; align-self: stretch; min-width: 110px; flex-shrink: 0;">
                                <span style="display: inline-flex; align-items: center; gap: 5px; background: #dcfce7; color: #15803d; font-size: 11px; font-weight: 700; padding: 5px 12px; border-radius: 999px; border: 1px solid #bbf7d0; white-space: nowrap;">
                                    ✅ Done
                                </span>
                                @if($aksi)
                                    <a href="{{ route('aksi.show', $aksi->id_aksi) }}"
                                       style="font-size: 12px; color: #0ea5e9; font-weight: 600; white-space: nowrap; text-decoration: none;"
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