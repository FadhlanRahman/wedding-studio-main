@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-6 md:p-8 mt-6 relative overflow-hidden">
    {{-- Decorative background --}}
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-60 rounded-2xl pointer-events-none"></div>

    <h1 class="relative text-2xl md:text-3xl font-extrabold mb-6 text-gray-800 flex items-center gap-2">
        ✏️ <span>Edit Layanan</span>
    </h1>

    {{-- tampilkan error validasi --}}
    @if ($errors->any())
        <div class="relative bg-red-100 text-red-800 p-4 rounded-lg mb-5 border border-red-300">
            <strong class="block mb-2">Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Start --}}
    <form action="{{ route('admin.services.update', $service->id) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="relative space-y-6">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Judul Layanan</label>
            <input type="text" name="title" value="{{ old('title', $service->title) }}"
                   class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition px-4 py-2.5 text-gray-700"
                   placeholder="Masukkan nama layanan..." required>
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition px-4 py-2.5 text-gray-700"
                      placeholder="Deskripsikan layanan secara singkat..." required>{{ old('description', $service->description) }}</textarea>
        </div>

        {{-- Price --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Harga</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $service->price) }}"
                   class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition px-4 py-2.5 text-gray-700"
                   placeholder="Masukkan harga layanan..." required>
        </div>

        {{-- Icon --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Ikon (Opsional)</label>
            <input type="text" name="icon" value="{{ old('icon', $service->icon) }}"
                   class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition px-4 py-2.5 text-gray-700"
                   placeholder="Contoh: 💍 🎉 📸">
            <p class="text-sm text-gray-500 mt-1">Gunakan emoji atau ikon sederhana untuk mempercantik tampilan layanan.</p>
        </div>

        {{-- Upload PDF + Preview Lama & Baru --}}
        <div class="border border-gray-200 rounded-xl p-4 bg-blue-50/50">
            <label for="pdf_file" class="block font-semibold text-gray-700 mb-2">Deskripsi Paket (PDF)</label>
            <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf"
                   class="block w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-300">
            <p class="text-sm text-gray-500 mt-1">Upload file PDF baru untuk mengganti file lama (maksimal 10 MB).</p>

            {{-- Preview PDF Lama (jika ada) --}}
            @if ($service->pdf_path)
                <div id="existing-pdf-wrapper" class="mt-4 border border-gray-300 rounded-lg overflow-hidden bg-white shadow-sm">
                    <div class="flex justify-between items-center bg-gray-50 px-3 py-2 border-b">
                        <p class="text-sm font-semibold text-gray-600">📄 Pratinjau File PDF Saat Ini</p>
                        <button type="button" id="toggle-existing-preview" class="text-sm text-blue-600 hover:underline">
                            Sembunyikan
                        </button>
                    </div>
                    <iframe id="existing-pdf-preview" src="{{ asset('storage/' . $service->pdf_path) }}" class="w-full h-80 rounded-b-lg" frameborder="0"></iframe>
                </div>
            @endif

            {{-- Preview PDF Baru --}}
            <div id="pdf-preview-wrapper" class="hidden mt-4 border border-gray-300 rounded-lg overflow-hidden bg-white shadow-sm">
                <div class="flex justify-between items-center bg-gray-50 px-3 py-2 border-b">
                    <p class="text-sm font-semibold text-gray-600">👀 Pratinjau File PDF Baru</p>
                    <button type="button" id="toggle-preview" class="text-sm text-blue-600 hover:underline">
                        Sembunyikan
                    </button>
                </div>
                <iframe id="pdf-preview" class="w-full h-80 rounded-b-lg" frameborder="0"></iframe>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6">
            <a href="{{ route('admin.services.index') }}" 
               class="w-full sm:w-auto text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-2.5 rounded-lg shadow-sm transition">
                ⬅ Batal
            </a>
            <button type="submit" 
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition">
                💾 Update Layanan
            </button>
        </div>
    </form>
</div>

{{-- JS untuk preview PDF lama & baru --}}
<script>
    const fileInput = document.getElementById('pdf_file');
    const previewWrapper = document.getElementById('pdf-preview-wrapper');
    const previewFrame = document.getElementById('pdf-preview');
    const toggleBtn = document.getElementById('toggle-preview');
    const existingWrapper = document.getElementById('existing-pdf-wrapper');
    const existingFrame = document.getElementById('existing-pdf-preview');
    const toggleExisting = document.getElementById('toggle-existing-preview');
    let isVisibleNew = true;
    let isVisibleOld = true;

    if (fileInput) {
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file && file.type === "application/pdf") {
                const fileURL = URL.createObjectURL(file);
                previewFrame.src = fileURL;
                previewWrapper.classList.remove('hidden');
                isVisibleNew = true;
                toggleBtn.textContent = "Sembunyikan";
            } else {
                previewWrapper.classList.add('hidden');
                previewFrame.src = "";
            }
        });
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            isVisibleNew = !isVisibleNew;
            previewFrame.style.display = isVisibleNew ? 'block' : 'none';
            toggleBtn.textContent = isVisibleNew ? 'Sembunyikan' : 'Tampilkan';
        });
    }

    if (toggleExisting) {
        toggleExisting.addEventListener('click', function () {
            isVisibleOld = !isVisibleOld;
            existingFrame.style.display = isVisibleOld ? 'block' : 'none';
            toggleExisting.textContent = isVisibleOld ? 'Sembunyikan' : 'Tampilkan';
        });
    }
</script>
@endsection
