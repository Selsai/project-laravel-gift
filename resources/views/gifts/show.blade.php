<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $gift->name }} - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen p-6">
    <div class="max-w-2xl mx-auto">
        <header class="mb-6">
            <h1 class="text-3xl font-bold mb-2">Détails du cadeau</h1>
        </header>

        <main class="bg-white dark:bg-[#161615] rounded-lg shadow p-6">
            <div class="space-y-4">
                <div>
                    <span class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Nom :</span>
                    <p class="text-lg">{{ $gift->name }}</p>
                </div>

                <div>
                    <span class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Prix :</span>
                    <p class="text-lg">{{ number_format($gift->price, 2) }} €</p>
                </div>
                
                @if($gift->url)
                    <div>
                        <span class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">URL :</span>
                        <p><a href="{{ $gift->url }}" target="_blank" class="text-[#f53003] dark:text-[#FF4433] hover:underline">{{ $gift->url }}</a></p>
                    </div>
                @endif
                
                @if($gift->details)
                    <div>
                        <span class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">Détails :</span>
                        <p class="mt-1 whitespace-pre-wrap">{{ $gift->details }}</p>
                    </div>
                @endif
            </div>

            <div class="mt-6 flex gap-3 flex-wrap">
                <a href="{{ route('gifts.index') }}" class="inline-block px-5 py-2 border border-[#19140035] dark:border-[#3E3E3A] rounded hover:border-black dark:hover:border-white transition">
                    Retour à la liste
                </a>
                <a href="{{ route('gifts.edit', $gift) }}" class="inline-block px-5 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded hover:bg-black dark:hover:bg-white transition">
                    Modifier
                </a>
                <form action="{{ route('gifts.destroy', $gift) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cadeau ?')" class="px-5 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                        Supprimer
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>