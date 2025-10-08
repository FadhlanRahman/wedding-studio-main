@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4 md:p-6">
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800 text-center md:text-left">👥 Akun Terdaftar</h1>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow text-sm md:text-base">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg shadow text-sm md:text-base">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    {{-- Tampilan Mobile (Card List) --}}
    <div class="block md:hidden space-y-4">
        @forelse($users as $index => $user)
            <div class="bg-white shadow-md rounded-xl p-4 border border-gray-200">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="font-semibold text-gray-800 text-base">{{ $user->name }}</h2>
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                        📅 {{ $user->created_at->format('d M Y') }}
                    </span>
                </div>
                <p class="text-gray-600 text-sm mb-3">{{ $user->email }}</p>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.accounts.edit', $user->id) }}" 
                       class="flex items-center gap-1 bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600 transition text-xs">
                        ✏️ Edit
                    </a>

                    @if(auth()->id() !== $user->id)
                        <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="flex items-center gap-1 bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600 transition text-xs">
                                🗑️ Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Belum ada akun terdaftar.</p>
        @endforelse
    </div>

    {{-- Tampilan Desktop (Tabel) --}}
    <div class="hidden md:block bg-white rounded-xl shadow-md overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                    <th class="p-4 text-left font-semibold">#</th>
                    <th class="p-4 text-left font-semibold">Nama</th>
                    <th class="p-4 text-left font-semibold">Email</th>
                    <th class="p-4 text-left font-semibold">Tanggal Daftar</th>
                    <th class="p-4 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr class="{{ $loop->odd ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition">
                        <td class="p-4">{{ $index + 1 }}</td>
                        <td class="p-4 font-medium text-gray-800">{{ $user->name }}</td>
                        <td class="p-4 text-gray-600">{{ $user->email }}</td>
                        <td class="p-4">
                            <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                📅 {{ $user->created_at->format('d M Y') }}
                            </span>
                        </td>
                        <td class="p-4 flex gap-3">
                            <a href="{{ route('admin.accounts.edit', $user->id) }}" 
                               class="flex items-center gap-1 bg-blue-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-blue-600 transition">
                                ✏️ Edit
                            </a>

                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="flex items-center gap-1 bg-red-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-red-600 transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">
                            Belum ada akun terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
