@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    @if(session('error'))
        <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid-3" style="grid-template-columns: 1fr 2fr; gap: 3rem;">
        
        <!-- Sol Sütun: Yeni Sunucu -->
        <div>
            <div style="background: var(--color-white); padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid var(--color-gray-light); position: sticky; top: 100px;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Yeni Sunucu Kur</h3>
                <form action="{{ route('servers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-input" placeholder="Sunucu Adı (Örn: Güz Yarıyılı Çalışma)" required>
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-input" placeholder="Açıklama" rows="3"></textarea>
                    </div>
                    <button class="btn btn-gold" style="width: 100%;" type="submit">Oluştur</button>
                </form>
            </div>
        </div>

        <!-- Sağ Sütun: Sunucu Listesi -->
        <div>
            <h2 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 1.5rem;">Sunucular (Gruplar)</h2>
            
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($allServers as $server)
                    @php
                        $isMember = $myServers->contains($server->id);
                    @endphp
                    <div style="background: var(--color-white); padding: 1.5rem; border-radius: 12px; border: 1px solid {{ $isMember ? 'var(--color-gold)' : 'var(--color-gray-light)' }}; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.25rem;">
                                {{ $server->name }}
                                @if($isMember)
                                    <span style="font-size: 0.75rem; background: var(--color-cream); color: var(--color-gold); padding: 2px 8px; border-radius: 12px; margin-left: 0.5rem; border: 1px solid var(--color-gold);">Katıldın</span>
                                @endif
                            </h3>
                            <p class="text-gray" style="font-size: 0.9rem;">{{ $server->description ?: 'Açıklama yok' }}</p>
                            <p style="font-size: 0.8rem; font-weight: 600; color: var(--color-gray); margin-top: 0.5rem;">👥 {{ $server->users_count }} Üye</p>
                        </div>
                        
                        <div>
                            @if($isMember)
                                <a href="{{ route('servers.show', $server->id) }}" class="btn btn-outline-gold" style="padding: 0.5rem 1.5rem;">Gir</a>
                            @else
                                <form action="{{ route('servers.join', $server->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-gold" style="padding: 0.5rem 1.5rem;" type="submit">Katıl</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                @if($allServers->isEmpty())
                     <div style="padding: 3rem; text-align: center; border: 1px dashed var(--color-gray-light); border-radius: 12px; background: white;">
                        <p class="text-gray">Henüz hiç sunucu açılmamış. İlkini sen kur!</p>
                     </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
