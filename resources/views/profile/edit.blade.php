<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil - Dor Sahara</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Modifier le Profil</h1>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Mettre à jour</button>
        </form>

        <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-blue-500 hover:underline">Retour au tableau de bord</a>
    </div>
</body>
</html>
