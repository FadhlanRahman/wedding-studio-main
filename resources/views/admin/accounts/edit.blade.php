@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4 md:p-6 max-w-lg">
    <h1 class="text-xl md:text-2xl font-bold mb-6 text-gray-800 text-center md:text-left">✏️ Edit Akun</h1>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg text-sm md:text-base">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('admin.accounts.update', $user->id) }}" method="POST" 
          class="bg-white p-4 md:p-6 rounded-xl shadow-md border border-gray-200 space-y-5">
        @csrf
        @method('PUT')

        {{-- Input Nama --}}
        <div>
            <label for="name" class="block mb-1 font-semibold text-gray-700 text-sm md:text-base">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 rounded-lg px-3 py-2 text-sm md:text-base"
                   placeholder="Masukkan nama pengguna" required>
        </div>

        {{-- Input Email --}}
        <div>
            <label for="email" class="block mb-1 font-semibold text-gray-700 text-sm md:text-base">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 rounded-lg px-3 py-2 text-sm md:text-base"
                   placeholder="Masukkan alamat email" required>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mt-6">
            <button type="submit" 
                    class="w-full md:w-auto bg-blue-600 text-white px-4 py-2.5 rounded-lg shadow hover:bg-blue-700 transition text-sm md:text-base">
                💾 Simpan Perubahan
            </button>

            <a href="{{ route('admin.accounts.index') }}" 
               class="w-full md:w-auto text-center border border-gray-300 px-4 py-2.5 rounded-lg hover:bg-gray-100 transition text-sm md:text-base">
                ↩️ Batal
            </a>
        </div>
    </form>
</div>
@endsection
