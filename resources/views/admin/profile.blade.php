@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-serif font-bold text-[var(--color-gold)]">Admin Profile</h2>
    </div>

    <div class="bg-[var(--color-secondary-bg)] rounded-3xl p-8 shadow-2xl border border-[var(--color-gold)]/20 max-w-2xl mx-auto">
        <div class="flex flex-col items-center text-center">
            
            {{-- Profile Avatar Placeholder --}}
            <div class="w-32 h-32 rounded-full bg-[var(--color-primary-bg)] border-4 border-[var(--color-gold)] flex items-center justify-center text-4xl mb-6 shadow-lg">
                👤
            </div>

            <h3 class="text-2xl font-bold text-white mb-2">{{ $admin->name }}</h3>
            <p class="text-[var(--color-text-muted)] mb-8">{{ $admin->email }}</p>

            {{-- Details Grid --}}
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 text-left">
                <div class="bg-[var(--color-primary-bg)]/50 p-4 rounded-xl border border-[var(--color-gold)]/10">
                    <span class="block text-xs uppercase tracking-widest text-[var(--color-gold)] mb-1">Role</span>
                    <span class="text-white font-medium">Administrator</span>
                </div>
                <div class="bg-[var(--color-primary-bg)]/50 p-4 rounded-xl border border-[var(--color-gold)]/10">
                    <span class="block text-xs uppercase tracking-widest text-[var(--color-gold)] mb-1">Joined</span>
                    <span class="text-white font-medium">{{ $admin->created_at->format('d M Y') }}</span>
                </div>
            </div>

            {{-- Edit Button --}}
            <a href="{{ route('admin.accounts.edit', $admin->id) }}" 
               class="inline-block px-8 py-3 bg-[var(--color-gold)] text-[var(--color-primary-bg)] rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg hover:shadow-[var(--color-gold)]/30">
                Edit Profile
            </a>

        </div>
    </div>
</div>
@endsection
