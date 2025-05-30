{{-- resources/views/hotels/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold mb-4">{{ $hotel->name }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- صور الفندق --}}
        @if ($hotel->images->count())
            <div class="space-y-4">
                @foreach ($hotel->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="Photo {{ $loop->iteration }}" class="w-full h-64 object-cover rounded-lg">
                @endforeach
            </div>
        @endif

        {{-- الوصف والمزايا --}}
        <div>
            <p class="text-gray-700 mb-4">{{ $hotel->description }}</p>
            <ul class="list-disc ml-5 mb-4">
                <li>Prix par nuit : {{ $hotel->price_per_night }} MAD</li>
                <li>Étoiles : {{ $hotel->stars }} ⭐</li>
                {{-- إضافة أي حقول أخرى مثل: Adresse، Téléphone … --}}
            </ul>
            <a href="mailto:{{ $hotel->contact_email }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Réserver par email</a>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('hotels.index') }}" class="text-blue-500 hover:underline">&larr; Retour à la liste des hôtels</a>
    </div>
</div>
@endsection
