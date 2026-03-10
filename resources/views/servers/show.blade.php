@extends('layouts.app')

@section('content')
<div class="dashboard-container" style="max-width: 900px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <a href="{{ route('servers.index') }}" class="text-gray" style="text-decoration: none; font-size: 0.9rem;">&larr; Sunuculara Dön</a>
            <h2 style="font-size: 2rem; font-weight: 800; margin-top: 0.5rem;">{{ $server->name }}</h2>
            <p class="text-gray" style="font-size: 0.95rem;">{{ $server->description }}</p>
        </div>
        <div class="text-gray" style="font-weight: 600; font-size: 0.9rem; background: var(--color-white); padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid var(--color-gray-light);">
            👥 {{ $server->users()->count() }} Üye
        </div>
    </div>

    <!-- Sohbet Ekranı (Sayfa Yenilemeli) -->
    <div style="background: var(--color-white); border-radius: 12px; border: 1px solid var(--color-gray-light); box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; flex-direction: column; height: 60vh;">
        
        <!-- Mesajlar Listesi -->
        <div style="flex: 1; overflow-y: auto; padding: 2rem; display: flex; flex-direction: column; gap: 1.5rem; background: #faf9f6;">
            @if($messages->isEmpty())
                <div style="text-align: center; margin: auto; color: var(--color-gray);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">👋</div>
                    <p>Sunucuya ilk mesajı gönder!</p>
                </div>
            @endif

            @foreach($messages as $message)
                @php
                    $isMe = $message->user_id === Auth::id();
                @endphp
                <div style="display: flex; gap: 1rem; max-width: 80%; {{ $isMe ? 'align-self: flex-end; flex-direction: row-reverse;' : 'align-self: flex-start;' }}">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $isMe ? 'var(--color-gold)' : 'var(--color-white)' }}; display: flex; align-items: center; justify-content: center; font-weight: bold; color: {{ $isMe ? 'white' : 'var(--color-gold)' }}; border: 1px solid {{ $isMe ? 'var(--color-gold)' : 'var(--color-gray-light)' }}; flex-shrink: 0;">
                        {{ substr($message->user->name, 0, 1) }}
                    </div>
                    <div style="background: {{ $isMe ? 'var(--color-gold)' : 'var(--color-white)' }}; color: {{ $isMe ? 'white' : 'var(--color-black)' }}; padding: 1rem 1.25rem; border-radius: 12px; {{ $isMe ? 'border-top-right-radius: 2px;' : 'border-top-left-radius: 2px;' }} border: 1px solid {{ $isMe ? 'var(--color-gold)' : 'var(--color-gray-light)' }}; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        @if(!$isMe)
                            <div style="font-weight: 700; font-size: 0.85rem; margin-bottom: 0.25rem; color: var(--color-gold);">
                                {{ $message->user->name }}
                            </div>
                        @endif
                        <div style="font-size: 0.95rem; line-height: 1.5; word-break: break-word;">
                            {{ $message->body }}
                        </div>
                        <div style="font-size: 0.7rem; color: {{ $isMe ? 'rgba(255,255,255,0.8)' : 'var(--color-gray)' }}; margin-top: 0.5rem; text-align: right;">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Mesaj Gönderme Alanı -->
        <div style="padding: 1.5rem; background: var(--color-white); border-top: 1px solid var(--color-gray-light); border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
            <form action="{{ route('servers.message', $server->id) }}" method="POST" style="display: flex; gap: 1rem;">
                @csrf
                <input type="text" name="body" class="form-input" style="flex: 1; border-radius: 9999px; padding: 0.75rem 1.5rem;" placeholder="{{ $server->name }} sunucusuna mesaj gönder..." required autocomplete="off" autofocus>
                <button type="submit" class="btn btn-gold" style="border-radius: 9999px; padding: 0.75rem 2rem;">Gönder</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Mesajlar kutusunu her yüklendiğinde en alta kaydır
    document.addEventListener("DOMContentLoaded", function() {
        var messagesDiv = document.querySelector('.flex-1.overflow-y-auto') || document.querySelector('[style*="overflow-y: auto"]');
        if(messagesDiv) {
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
    });
</script>
@endsection
