<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveaux propriétaires @yield('title', '')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>
    <header>
        <nav class="sticky top-0 w-full mt-0 bg-white shadow-sm">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <div class="pl-16 no-underline opacity-100 hover:text-white hover:no-underline">
                    <span class="pl-2 text-2xl text-blue">
                        <img src="/img/logo.png" class="inline w-48" alt="Nouveaux propriétaires">
                    </span>
                </div>

                <div class="pr-16 block text-lg">
                    <a href="{{ route("home") }}" class="block mt-4 font-light hover:text-secondary text-slim text-primary hover:text-black hover:no-underline md:inline-block md:mt-0 md:ml-6">Accueil</a>
                    <a href="{{ route("map") }}" class="block mt-4 font-light hover:text-secondary text-slim text-primary hover:text-black hover:no-underline md:inline-block md:mt-0 md:ml-6">Carte</a>
                    <a href="{{ route("department") }}" class="block mt-4 font-light hover:text-secondary text-slim text-primary hover:text-black hover:no-underline md:inline-block md:mt-0 md:ml-6">Départements</a>           
                </div>
            </div>
        </nav>
    </header>

    @yield('content', 'Default content')
</body>
</html>