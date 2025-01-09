@extends('layouts.app')

@section('title', ' - Cartes')

@section('content')
    <div class="wrapper">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 mx-auto">
            <h1 id="page-title" class="text-4xl font-bold md:mt-12 mt-6">Nombre total de crimes et délits en 2022</h1>
            
            <div class="grid grid-cols-2 mt-2 md:mt-6 gap-3">
                <div class="col-span-2 md:col-span-1">
                    <h5 class="text-secondary font-bold mb-3">Filtre</h5>
                    <div class="">
                        <select id="theme" class="mt-4 block w-full rounded-md border-0 py-3 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" selected>Sélectionner un filtre</option>
                            <option value="annee">Année</option>
                            <option value="crimes">Crimes</option>
                            <option value="delits">Délits</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-span-2 md:col-span-1">
                    <h5 class="text-secondary font-bold mb-3">Tri</h5>
                    <div class="h-10">
                        <select id="tri" class="mt-4 block w-full rounded-md border-0 py-3 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </select>
                    </div>
                </div>

                <div id="filtre-secondaire" class="hidden col-span-2 md:col-span-1">
                    <h5 class="text-secondary font-bold mb-3">Filtrer par année</h5>
                    <div class="h-10">
                        <select id="filtre-annee" class="mt-4 block w-full rounded-md border-0 py-3 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Toutes les années confondues</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-8 mt-8 relative">
                <div id="map" class="rounded w-full" style="height: 600px;"></div>
            </div>
        </div>
    </div>

    <script>
        //Création de la carte
        let map = L.map('map').setView([46.903354, 1.888334], 6);

        //Chargement de la carte
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        let tblCrimes = [
            "Homicides",
            "Violences sexuelles",
            "Vols avec armes",
            "Trafic de stupéfiants"
        ]; // Tableau des crimes

        let tblDelits = [
            "Coups et blessures volontaires",
            "Coups et blessures volontaires intrafamiliaux",
            "Autres coups et blessures volontaires",
            "Vols violents sans arme",
            "Vols sans violence contre des personnes",
            "Cambriolages de logement",
            "Vols de véhicules",
            "Vols dans les véhicules",
            "Vols d'accessoires sur véhicules",
            "Destructions et dégradations volontaires",
            "Escroqueries",
            "Usage de stupéfiants"
        ]; // Tableau des délits

        let tblAnnee = [
            "2016",
            "2017",
            "2018",
            "2019",
            "2020",
            "2021",
            "2022",
            "2023"
        ]; // Tableau des années

        document.getElementById('theme').addEventListener('change', function() {
            const filtre = document.getElementById('theme').value;
            const filtreSecondaire = document.getElementById('filtre-secondaire');
            const filtreAnnee = document.getElementById('filtre-annee');
            const tri = document.getElementById('tri');
            const check = document.getElementById('check');

            if(filtre == "annee") {
                tri.innerHTML = "";
                if(!filtreSecondaire.classList.contains('hidden')) {
                    filtreSecondaire.classList.add('hidden');
                }
                tri.innerHTML += `<option value="">Toutes les années confondues</option>`;
                tblAnnee.forEach(annee => {
                    tri.innerHTML += `<option value="${annee}">${annee}</option>`;
                });
            } else if(filtre == "crimes") {
                tri.innerHTML = "";
                filtreAnnee.innerHTML = "";
                if(filtreSecondaire.classList.contains('hidden')) {
                    filtreSecondaire.classList.remove('hidden');
                }
                tblCrimes.forEach(crime => {
                    tri.innerHTML += `<option value="${crime}">${crime}</option>`;
                });
                filtreAnnee.innerHTML += `<option value="">Toutes les années confondues</option>`;
                tblAnnee.forEach(annee => {
                    filtreAnnee.innerHTML += `<option value="${annee}">${annee}</option>`;
                });
            } else if(filtre == "delits") {
                tri.innerHTML = "";
                filtreAnnee.innerHTML = "";
                if(filtreSecondaire.classList.contains('hidden')) {
                    filtreSecondaire.classList.remove('hidden');
                }
                filtreAnnee.innerHTML += `<option value="">Toutes les années confondues</option>`;
                tblDelits.forEach(delit => {
                    tri.innerHTML += `<option value="${delit}">${delit}</option>`;
                });
                tblAnnee.forEach(annee => {
                    filtreAnnee.innerHTML += `<option value="${annee}">${annee}</option>`;
                });
            } else {
                tri.innerHTML = "";
                if(!filtreSecondaire.classList.contains('hidden')) {
                    filtreSecondaire.classList.add('hidden');
                }
            }
        });

        document.getElementById('tri').addEventListener('change', function() {
            const filtre = document.getElementById('theme').value;
            const tri = document.getElementById('tri').value;
            const pageTitle = document.getElementById('page-title');

            if(filtre == "annee") {
                if(tri == "") {
                    pageTitle.innerText = `Nombre total de crimes et délits toutes années confondues`;
                    AddLayer();
                } else {
                    pageTitle.innerText = `Nombre total de crimes et délits en ${tri}`;
                    AddLayer();
                }
            } else if(filtre == "crimes") {
                pageTitle.innerText = `Nombre total de ${tri.toLowerCase()}`;
                AddLayer();
            } else if(filtre == "delits") {
                pageTitle.innerText = `Nombre total de ${tri.toLowerCase()}`;
                AddLayer();
            }
        });

        document.getElementById('filtre-annee').addEventListener('change', function() {
            const filtre = document.getElementById('theme').value;
            const annee = document.getElementById('filtre-annee').value;
            const tri = document.getElementById('tri').value;
            const pageTitle = document.getElementById('page-title');

            if(filtre == "crimes" && annee != "") {
                pageTitle.innerText = `Nombre total de ${tri.toLowerCase()} en ${annee}`;
                AddLayer();
            } else if(filtre == "delits" && annee != "") {
                pageTitle.innerText = `Nombre total de ${tri.toLowerCase()} en ${annee}`;
                AddLayer();
            } else {
                pageTitle.innerText = `Nombre total de ${tri.toLowerCase()}`;
                AddLayer();
            }
        });

        const apiUrl = "http://localhost:8000/api"; // URL de l'API
        const geoJsonUrl = "https://france-geojson.gregoiredavid.fr/repo/departements.geojson"; // URL de l'API GeoJSON


        const filtre = document.getElementById('theme');
        const tri = document.getElementById('tri');
        const filtreAnnee = document.getElementById('filtre-annee');
        var tblClassement = {};

        function AddLayer() {
            fetch(geoJsonUrl) // Récupération des contours des départements
                .then(response => response.json())
                .then(geoJsonData => {
                    fetch(`${apiUrl}`) // Récupération des données
                        .then(response => response.json())
                        .then(response => {
                            const data = response.data
                            let totalDepartement = {};

                            //Supprimer les anciennes pop-ups et les contours des départements
                            map.eachLayer((layer) => {
                                if (layer instanceof L.GeoJSON) {
                                    map.removeLayer(layer);
                                }
                            });
                            
                            if(filtre.value == "annee") { // Filtrage par année
                                data.forEach(item => {
                                    if (tri.value == "") {
                                        let dept = item["Code.département"];
                                        if (!totalDepartement[dept]) {
                                            totalDepartement[dept] = 0;
                                        }
                                        totalDepartement[dept] += item["faits"] || 0;
                                    } else if (item["annee"] == tri.value.split("")[2] + tri.value.split("")[3]) {
                                        let dept = item["Code.département"];
                                        if (!totalDepartement[dept]) {
                                            totalDepartement[dept] = 0;
                                        }
                                        totalDepartement[dept] += item["faits"] || 0;
                                    }
                                });
                            } else if(filtre.value == "delits") { // Filtrage par délits
                                data.forEach(item => {
                                    if (item["classe"] == tri.value && filtreAnnee.value == "") { 
                                        let dept = item["Code.département"];
                                        if (!totalDepartement[dept]) {
                                            totalDepartement[dept] = 0;
                                        }
                                        totalDepartement[dept] += item["faits"] || 0;
                                    } else if(item["classe"] == tri.value && item["annee"] == filtreAnnee.value.split("")[2] + filtreAnnee.value.split("")[3]) {
                                        let dept = item["Code.département"];
                                        if (!totalDepartement[dept]) {
                                            totalDepartement[dept] = 0;
                                        }
                                        totalDepartement[dept] += item["faits"] || 0;
                                    }
                                });
                            } else if(filtre.value == "crimes") {   // Filtrage par crimes
                                data.forEach(item => {
                                    if (item["classe"] == tri.value && filtreAnnee.value == "") {
                                        let dept = item["Code.département"];
                                        if (!totalDepartement[dept]) {
                                            totalDepartement[dept] = 0;
                                        }
                                        totalDepartement[dept] += item["faits"] || 0;
                                    } else if(item["classe"] == tri.value && item["annee"] == filtreAnnee.value.split("")[2] + filtreAnnee.value.split("")[3]) {
                                        let dept = item["Code.département"];
                                        if (!totalDepartement[dept]) {
                                            totalDepartement[dept] = 0;
                                        }
                                        totalDepartement[dept] += item["faits"] || 0;
                                    }
                                });
                            } else {
                                data.forEach(item => { // Par défaut, les données de l'année 2022 sont affichées
                                    if (item["annee"] == "22") {
                                        let dept = item["Code.département"];
                                        if (!totalDepartement[dept]) {
                                            totalDepartement[dept] = 0;
                                        }
                                        totalDepartement[dept] += item["faits"] || 0;
                                    }
                                });
                            }

                            L.geoJson(geoJsonData, { // Ajout des contours des départements
                                style: function(feature) {
                                    let total = totalDepartement[feature.properties.code];
                                    return {
                                        fillColor: getColor(total),
                                        weight: 1,
                                        opacity: 1,
                                        color: 'white',
                                        fillOpacity: 0.7
                                    };
                                },
                                onEachFeature: function(feature, layer) { // Ajout des pop-ups
                                    let total = totalDepartement[feature.properties.code];
                                    layer.bindPopup(
                                        `<strong>${feature.properties.code} - ${feature.properties.nom}</strong><br>
                                        Total: ${total} faits`
                                    );
                                }
                            }).addTo(map);
                        });
                });
        }

        function getColor(total) {
            return total > 100000 ? '#800026' :
                total > 50000  ? '#BD0026' :
                total > 20000  ? '#E31A1C' :
                total > 10000  ? '#FC4E2A' :
                total > 5000   ? '#FD8D3C' :
                total > 2000   ? '#FEB24C' :
                total > 1000   ? '#FED976' :
                                '#FFEDA0';
        }

        AddLayer();
    </script>
@endsection