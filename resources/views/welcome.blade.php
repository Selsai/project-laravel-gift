<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Liste des cadeaux</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
        <header class="mb-6">
            <h1 class="text-3xl font-bold mb-4">Liste des cadeaux</h1>
            
            @if(session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('gifts.create') }}" class="inline-block px-5 py-2 bg-[#1b1b18] dark:bg-[#eeeeec] text-white dark:text-[#1C1C1A] rounded hover:bg-black dark:hover:bg-white transition">
                Ajouter un cadeau
            </a>
        </header>

        <main>
            @if($gifts->isEmpty())
                <p class="text-[#706f6c] dark:text-[#A1A09A]">Aucun cadeau pour le moment.</p>
            @else
                <div class="bg-white dark:bg-[#161615] rounded-lg shadow overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-[#f5f5f5] dark:bg-[#1b1b18]">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium">Nom</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Prix</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                            @foreach($gifts as $gift)
                                <tr class="hover:bg-[#f9f9f9] dark:hover:bg-[#1b1b18] transition">
                                    <td class="px-6 py-4">{{ $gift->name }}</td>
                                    <td class="px-6 py-4">{{ number_format($gift->price, 2) }} €</td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('gifts.show', $gift) }}" class="text-[#f53003] dark:text-[#FF4433] hover:underline">
                                                Voir
                                            </a>
                                            <a href="{{ route('gifts.edit', $gift) }}" class="text-[#f53003] dark:text-[#FF4433] hover:underline">
                                                Modifier
                                            </a>
                                            <form action="{{ route('gifts.destroy', $gift) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cadeau ?')" class="text-red-600 dark:text-red-400 hover:underline">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </main>
    </div>
</body>
</html>