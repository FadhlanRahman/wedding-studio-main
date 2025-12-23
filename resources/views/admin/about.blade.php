@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4 md:p-6 text-[var(--color-text-light)]">
    <h1 class="text-2xl md:text-3xl font-serif font-bold mb-8 text-white flex items-center gap-3">
        <span>👥</span> Kelola Tim
    </h1>

    {{-- Form Tambah Tim --}}
    <div class="bg-[var(--color-secondary-bg)] p-6 rounded-2xl shadow-xl border border-[var(--color-gold)]/20 mb-8">
        <h2 class="text-xl font-bold mb-6 text-[var(--color-gold)] border-b border-[var(--color-gold)]/10 pb-2">➕ Tambah Tim Baru</h2>
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-[var(--color-text-muted)] mb-1 uppercase tracking-wide">Nama</label>
                <input type="text" name="name" class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-2 text-[var(--color-text-light)] focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-bold text-[var(--color-text-muted)] mb-1 uppercase tracking-wide">Role</label>
                <select name="role" class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-2 text-[var(--color-text-light)] focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none transition appearance-none">
                    <option value="" class="bg-[var(--color-primary-bg)]">-- Pilih Role --</option>
                    <option value="Founder & MUA" class="bg-[var(--color-primary-bg)]">Founder & MUA</option>
                    <option value="Fotografer" class="bg-[var(--color-primary-bg)]">Fotografer</option>
                    <option value="Event Organizer" class="bg-[var(--color-primary-bg)]">Event Organizer</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-[var(--color-text-muted)] mb-1 uppercase tracking-wide">Foto</label>
                <input type="file" name="photo" class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-2 text-[var(--color-text-light)] focus:ring-1 focus:ring-[var(--color-gold)] file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[var(--color-gold)] file:text-[var(--color-primary-bg)] hover:file:bg-[var(--color-gold-light)] transition">
            </div>
            <div class="pt-2">
                <button type="submit" class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-6 py-2 rounded-xl font-bold shadow-lg hover:bg-[var(--color-gold-light)] active:scale-95 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    {{-- List Tim --}}
    <div class="bg-[var(--color-secondary-bg)] p-6 rounded-2xl shadow-xl border border-[var(--color-gold)]/20">
        <h2 class="text-xl font-bold mb-6 text-[var(--color-gold)] border-b border-[var(--color-gold)]/10 pb-2">📋 Daftar Tim</h2>

        {{-- ✅ Tabel untuk Desktop --}}
        <div class="hidden md:block overflow-x-auto rounded-xl border border-[var(--color-gold)]/20">
            <table class="w-full border-collapse text-sm md:text-base">
                <thead>
                    <tr class="bg-[var(--color-primary-bg)] text-[var(--color-gold)] uppercase tracking-wider text-xs">
                        <th class="p-4 text-left font-serif">Foto</th>
                        <th class="p-4 text-left font-serif">Nama</th>
                        <th class="p-4 text-left font-serif">Role</th>
                        <th class="p-4 text-left font-serif">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--color-gold)]/10">
                    @forelse($teams as $team)
                    <tr class="hover:bg-[var(--color-gold)]/5 transition">
                        <td class="p-4">
                            @if($team->photo)
                                <img src="{{ asset('storage/'.$team->photo) }}" class="w-12 h-12 rounded-full shadow-md border border-[var(--color-gold)]/30 object-cover">
                            @else
                                <span class="text-[var(--color-text-muted)] italic text-xs">No Photo</span>
                            @endif
                        </td>
                        <td class="p-4 font-bold text-white">{{ $team->name }}</td>
                        <td class="p-4 text-[var(--color-text-muted)]">{{ $team->role }}</td>
                        <td class="p-4 space-y-2">
                            {{-- Form Update --}}
                            <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $team->name }}" class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/20 rounded-lg p-2 text-xs w-full text-[var(--color-text-light)] focus:ring-1 focus:ring-[var(--color-gold)] focus:outline-none">
                                <select name="role" class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/20 rounded-lg p-2 text-xs w-full text-[var(--color-text-light)] focus:ring-1 focus:ring-[var(--color-gold)] focus:outline-none appearance-none">
                                    <option value="Founder & MUA" {{ $team->role == 'Founder & MUA' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Founder & MUA</option>
                                    <option value="Fotografer" {{ $team->role == 'Fotografer' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Fotografer</option>
                                    <option value="Event Organizer" {{ $team->role == 'Event Organizer' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Event Organizer</option>
                                </select>
                                <input type="file" name="photo" class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/20 rounded-lg p-2 text-xs w-full text-[var(--color-text-light)]">
                                <button type="submit" class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-3 py-1.5 rounded-lg shadow hover:bg-[var(--color-gold-light)] transition w-full text-xs font-bold">✏️ Update</button>
                            </form>

                            {{-- Hapus --}}
                            <form action="{{ route('admin.team.delete', $team->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tim ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-900/50 border border-red-500/30 text-red-200 px-3 py-1.5 rounded-lg shadow hover:bg-red-900/80 transition w-full text-xs">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-[var(--color-text-muted)] italic">
                            Belum ada anggota tim yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ✅ Card View untuk Mobile --}}
        <div class="md:hidden space-y-4">
            @forelse($teams as $team)
            <div class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/20 rounded-xl p-5 shadow-lg">
                <div class="flex items-center gap-4 mb-4">
                    @if($team->photo)
                        <img src="{{ asset('storage/'.$team->photo) }}" class="w-16 h-16 rounded-full object-cover shadow-md border border-[var(--color-gold)]/30">
                    @else
                        <div class="w-16 h-16 bg-[var(--color-secondary-bg)] rounded-full flex items-center justify-center text-[var(--color-text-muted)] border border-[var(--color-gold)]/10">
                            <span class="text-xs">No Photo</span>
                        </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-lg text-white">{{ $team->name }}</h3>
                        <p class="text-[var(--color-gold)] text-sm">{{ $team->role }}</p>
                    </div>
                </div>

                {{-- Update Form --}}
                <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $team->name }}" class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/20 rounded-lg p-2 text-sm w-full text-[var(--color-text-light)] focus:ring-1 focus:ring-[var(--color-gold)] focus:outline-none">
                    <select name="role" class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/20 rounded-lg p-2 text-sm w-full text-[var(--color-text-light)] focus:ring-1 focus:ring-[var(--color-gold)] focus:outline-none appearance-none">
                        <option value="Founder & MUA" {{ $team->role == 'Founder & MUA' ? 'selected' : '' }} class="bg-[var(--color-secondary-bg)]">Founder & MUA</option>
                        <option value="Fotografer" {{ $team->role == 'Fotografer' ? 'selected' : '' }} class="bg-[var(--color-secondary-bg)]">Fotografer</option>
                        <option value="Event Organizer" {{ $team->role == 'Event Organizer' ? 'selected' : '' }} class="bg-[var(--color-secondary-bg)]">Event Organizer</option>
                    </select>
                    <input type="file" name="photo" class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/20 rounded-lg p-2 text-sm w-full text-[var(--color-text-light)]">
                    <button type="submit" class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-3 py-2 rounded-lg shadow hover:bg-[var(--color-gold-light)] w-full text-sm font-bold">
                        ✏️ Update
                    </button>
                </form>

                {{-- Delete --}}
                <form action="{{ route('admin.team.delete', $team->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tim ini?')" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-900/50 border border-red-500/30 text-red-200 px-3 py-2 rounded-lg shadow hover:bg-red-900/80 w-full text-sm">
                        🗑️ Delete
                    </button>
                </form>
            </div>
            @empty
                <p class="text-center text-[var(--color-text-muted)] italic">Belum ada anggota tim yang ditambahkan.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
