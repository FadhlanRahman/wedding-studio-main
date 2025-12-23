@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto bg-[var(--color-secondary-bg)] shadow-xl rounded-3xl p-6 md:p-8 border border-[var(--color-gold)]/20 text-[var(--color-text-light)]">
    <h1 class="text-2xl md:text-3xl font-serif font-bold mb-8 text-white flex items-center gap-3 border-b border-[var(--color-gold)]/20 pb-4">
        ✏️ <span>Edit Layanan</span>
    </h1>

    {{-- tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-900/50 border border-red-500/30 text-red-200 p-4 rounded-xl mb-6">
            <strong class="block mb-2 font-bold uppercase tracking-wide text-xs">Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside text-sm space-y-1 opacity-80">
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
          class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm">Judul Layanan</label>
            <input type="text" name="title" value="{{ old('title', $service->title) }}"
                   class="w-full bg-[var(--color-primary-bg)] rounded-xl border border-[var(--color-gold)]/30 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] px-4 py-3 text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition"
                   placeholder="Masukkan nama layanan..." required>
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full bg-[var(--color-primary-bg)] rounded-xl border border-[var(--color-gold)]/30 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] px-4 py-3 text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition"
                      placeholder="Deskripsikan layanan secara singkat..." required>{{ old('description', $service->description) }}</textarea>
        </div>

        {{-- Price --}}
        <div>
            <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm">Harga</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $service->price) }}"
                   class="w-full bg-[var(--color-primary-bg)] rounded-xl border border-[var(--color-gold)]/30 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] px-4 py-3 text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition"
                   placeholder="Masukkan harga layanan..." required>
        </div>

        {{-- Icon --}}
        <div>
            <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm">Ikon (Opsional)</label>
            <input type="text" name="icon" value="{{ old('icon', $service->icon) }}"
                   class="w-full bg-[var(--color-primary-bg)] rounded-xl border border-[var(--color-gold)]/30 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] px-4 py-3 text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition"
                   placeholder="Contoh: 💍 🎉 📸">
            <p class="text-xs text-[var(--color-text-muted)] mt-2 opacity-70">Gunakan emoji atau ikon sederhana untuk mempercantik tampilan layanan.</p>
        </div>

        {{-- Upload PDF + Preview Lama & Baru --}}
        <div class="border border-[var(--color-gold)]/20 rounded-xl p-5 bg-[var(--color-primary-bg)]">
            <label for="pdf_file" class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm">Deskripsi Paket (PDF)</label>
            <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf"
                   class="block w-full text-sm text-[var(--color-text-muted)] border border-[var(--color-gold)]/30 rounded-lg cursor-pointer bg-[var(--color-secondary-bg)] focus:outline-none focus:ring-1 focus:ring-[var(--color-gold)] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[var(--color-gold)] file:text-[var(--color-primary-bg)] hover:file:bg-[var(--color-gold-light)] transition">
            <p class="text-xs text-[var(--color-text-muted)] mt-2 opacity-70">Upload file PDF baru untuk mengganti file lama (maksimal 10 MB).</p>

            {{-- Preview PDF Lama (jika ada) --}}
            @if ($service->pdf_path)
                <div id="existing-pdf-wrapper" class="mt-4 border border-[var(--color-gold)]/20 rounded-xl overflow-hidden bg-white shadow-sm">
                    <div class="flex justify-between items-center bg-[var(--color-secondary-bg)] px-4 py-2 border-b border-[var(--color-gold)]/10">
                        <p class="text-sm font-bold text-[var(--color-gold)]">📄 Pratinjau File PDF Saat Ini</p>
                        <button type="button" id="toggle-existing-preview" class="text-xs text-[var(--color-text-muted)] hover:text-white transition uppercase tracking-wider font-bold">
                            Sembunyikan
                        </button>
                    </div>
                    <iframe id="existing-pdf-preview" src="{{ asset('storage/' . $service->pdf_path) }}" class="w-full h-80 bg-gray-100" frameborder="0"></iframe>
                </div>
            @endif

            {{-- Preview PDF Baru --}}
            <div id="pdf-preview-wrapper" class="hidden mt-4 border border-[var(--color-gold)]/20 rounded-xl overflow-hidden bg-white shadow-lg">
                <div class="flex justify-between items-center bg-[var(--color-secondary-bg)] px-4 py-2 border-b border-[var(--color-gold)]/10">
                    <p class="text-sm font-bold text-[var(--color-gold)]">👀 Pratinjau File PDF Baru</p>
                    <button type="button" id="toggle-preview" class="text-xs text-[var(--color-text-muted)] hover:text-white transition uppercase tracking-wider font-bold">
                        Sembunyikan
                    </button>
                </div>
                <iframe id="pdf-preview" class="w-full h-80 bg-gray-100" frameborder="0"></iframe>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row justify-end gap-4 pt-8 border-t border-[var(--color-gold)]/10">
            <a href="{{ route('admin.services.index') }}" 
               class="w-full sm:w-auto text-center bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 hover:bg-[var(--color-gold)]/10 text-[var(--color-text-light)] font-bold px-8 py-3 rounded-xl shadow-lg transition uppercase tracking-wider text-sm">
                ⬅ Batal
            </a>
            <button type="submit" 
                    class="w-full sm:w-auto bg-[var(--color-gold)] hover:bg-[var(--color-gold-light)] text-[var(--color-primary-bg)] font-bold px-8 py-3 rounded-xl shadow-lg transition uppercase tracking-wider text-sm transform hover:-translate-y-0.5">
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
