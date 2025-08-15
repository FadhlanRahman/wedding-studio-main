@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Akun</h1>

    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.accounts.update', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-bold">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-bold">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Perubahan</button>
        <a href="{{ route('admin.accounts') }}" class="ml-2 px-4 py-2 rounded border hover:bg-gray-100">Batal</a>
    </form>
</div>
@endsection
