@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    @if(session('success'))
        <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Upload Form -->
    <div style="background: var(--color-white); padding: 2rem; border-radius: 12px; margin-bottom: 3rem; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid var(--color-gray-light);">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Yeni Not Paylaş</h3>
        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid-3" style="gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <input type="text" name="title" class="form-input" placeholder="Not Başlığı" required>
                </div>
                <div>
                    <input type="number" name="price" class="form-input" placeholder="Fiyat (₺) - Ücretsiz ise 0" step="0.01" value="0">
                </div>
                <div>
                    <input type="file" name="note_file" class="form-input" style="padding: 0.6rem;" required>
                </div>
            </div>
            <textarea name="description" class="form-input" placeholder="Kısa açıklama (Opsiyonel)" style="margin-bottom: 1rem;" rows="2"></textarea>
            @error('note_file') <div class="error" style="margin-bottom:1rem;">{{ $message }}</div> @enderror
            <button class="btn btn-gold" type="submit">Paylaş</button>
        </form>
    </div>

    <!-- Feed / Akış -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="font-size: 2rem; font-weight: 800;">Akış <span class="text-gold" style="font-size: 1.2rem; font-weight: 600;">{{ Auth::user()->course }}</span></h2>
    </div>
    
    @if($notes->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            @foreach($notes as $note)
                <div style="background: var(--color-white); border-radius: 12px; overflow: hidden; border: 1px solid var(--color-gray-light); transition: transform 0.2s; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
                    <div style="padding: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <h3 style="font-size: 1.25rem; font-weight: 700;">{{ $note->title }}</h3>
                            <span style="background: {{ $note->price > 0 ? 'var(--color-gold)' : 'var(--color-gray-light)' }}; color: {{ $note->price > 0 ? 'white' : 'var(--color-black)' }}; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.85rem; font-weight: 600;">
                                {{ $note->price > 0 ? number_format($note->price, 2) . ' ₺' : 'Ücretsiz' }}
                            </span>
                        </div>
                        <p class="text-gray" style="font-size: 0.95rem; margin-bottom: 1.5rem; min-height: 3em;">{{ Str::limit($note->description, 100) ?: 'Açıklama yok' }}</p>
                        
                        <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--color-gray-light); padding-top: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="width: 30px; height: 30px; background: var(--color-cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.8rem; color: var(--color-gold);">
                                    {{ substr($note->user->name, 0, 1) }}
                                </div>
                                <span style="font-size: 0.85rem; font-weight: 500;">{{ $note->user->name }}</span>
                            </div>
                            <!-- "SATIN AL" mantığı çok basit tutuldu. Fiyat 0 ise direkt indir, değilse satın almaya yönlendir  -->
                            @if($note->price > 0)
                                <a href="#" onclick="alert('Satın alma entegrasyonu sonraki aşamada eklenecektir.')" class="btn btn-gold" style="font-size: 0.85rem; padding: 0.4rem 1rem;">Satın Al</a>
                            @else
                                <a href="{{ Storage::url($note->file_path) }}" target="_blank" class="text-gold" style="font-weight: 600; text-decoration: none; font-size: 0.9rem;">Görüntüle</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="background: white; padding: 4rem 2rem; border-radius: 12px; text-align: center; border: 1px dashed var(--color-gray-light);">
            <div style="font-size: 3rem; margin-bottom: 1rem;">📝</div>
            <h3 style="margin-bottom: 1rem; font-size: 1.5rem;">Henüz Not Yok</h3>
            <p class="text-gray" style="max-width: 400px; margin: 0 auto;">Sınıfınızda henüz bir not paylaşılmamış. İlk paylaşan olmak ister misiniz?</p>
        </div>
    @endif
</div>
@endsection
