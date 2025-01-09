@extends('layouts.app')

@section('title', ' - Accueil')

@section('content')
<div class="wrapper">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-16 mx-auto">
        <h1 class="text-3xl font-bold md:mt-12 mt-6">Classements des départements les plus sûrs pour l'année 2023</h1>

        <div class="text-secondary justify-items-stretch md:flex-row flex-wrap flex-col grid-cols-1 md:grid-cols-3 auto-cols-auto md:auto-cols-auto">
            <div class="col-span-3 mt-10 md:mt-2">
                <div class="flex justify-between container mx-auto w-full items-left pt-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-48">
                        <ul id="classement1" class="flex flex-col gap-5">
                        </ul>
                        <ul id="classement2" class="flex flex-col gap-5">
                        </ul>
                        <ul id="classement3" class="flex flex-col gap-5">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-3xl font-bold md:mt-12 mt-6">Évolution des crimes et délits sur les 9 dernières années</h1>

        <div class="col-span-2 md:col-span-1 mt-5">
            <div>
                <select id="departement" class="mt-4 block w-full rounded-md border-0 py-3 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" selected>Sélectionner un département</option>
                </select>
            </div>
        </div>
        
        <div id="container" class="mt-15" style="width:100%; height:400px;"></div>
    </div>
</div>

<script>
    let tblClassement = {};
    let tblEvolution = {};
    let departements = [
        { code: "01", nom: "Ain" },
        { code: "02", nom: "Aisne" },
        { code: "03", nom: "Allier" },
        { code: "04", nom: "Alpes-de-Haute-Provence" },
        { code: "05", nom: "Hautes-Alpes" },
        { code: "06", nom: "Alpes-Maritimes" },
        { code: "07", nom: "Ardèche" },
        { code: "08", nom: "Ardennes" },
        { code: "09", nom: "Ariège" },
        { code: "10", nom: "Aube" },
        { code: "11", nom: "Aude" },
        { code: "12", nom: "Aveyron" },
        { code: "13", nom: "Bouches-du-Rhône" },
        { code: "14", nom: "Calvados" },
        { code: "15", nom: "Cantal" },
        { code: "16", nom: "Charente" },
        { code: "17", nom: "Charente-Maritime" },
        { code: "18", nom: "Cher" },
        { code: "19", nom: "Corrèze" },
        { code: "21", nom: "Côte-d'Or" },
        { code: "22", nom: "Côtes-d'Armor" },
        { code: "23", nom: "Creuse" },
        { code: "24", nom: "Dordogne" },
        { code: "25", nom: "Doubs" },
        { code: "26", nom: "Drôme" },
        { code: "27", nom: "Eure" },
        { code: "28", nom: "Eure-et-Loir" },
        { code: "29", nom: "Finistère" },
        { code: "30", nom: "Gard" },
        { code: "31", nom: "Haute-Garonne" },
        { code: "32", nom: "Gers" },
        { code: "33", nom: "Gironde" },
        { code: "34", nom: "Hérault" },
        { code: "35", nom: "Ille-et-Vilaine" },
        { code: "36", nom: "Indre" },
        { code: "37", nom: "Indre-et-Loire" },
        { code: "38", nom: "Isère" },
        { code: "39", nom: "Jura" },
        { code: "40", nom: "Landes" },
        { code: "41", nom: "Loir-et-Cher" },
        { code: "42", nom: "Loire" },
        { code: "43", nom: "Haute-Loire" },
        { code: "44", nom: "Loire-Atlantique" },
        { code: "45", nom: "Loiret" },
        { code: "46", nom: "Lot" },
        { code: "47", nom: "Lot-et-Garonne" },
        { code: "48", nom: "Lozère" },
        { code: "49", nom: "Maine-et-Loire" },
        { code: "50", nom: "Manche" },
        { code: "51", nom: "Marne" },
        { code: "52", nom: "Haute-Marne" },
        { code: "53", nom: "Mayenne" },
        { code: "54", nom: "Meurthe-et-Moselle" },
        { code: "55", nom: "Meuse" },
        { code: "56", nom: "Morbihan" },
        { code: "57", nom: "Moselle" },
        { code: "58", nom: "Nièvre" },
        { code: "59", nom: "Nord" },
        { code: "60", nom: "Oise" },
        { code: "61", nom: "Orne" },
        { code: "62", nom: "Pas-de-Calais" },
        { code: "63", nom: "Puy-de-Dôme" },
        { code: "64", nom: "Pyrénées-Atlantiques" },
        { code: "65", nom: "Hautes-Pyrénées" },
        { code: "66", nom: "Pyrénées-Orientales" },
        { code: "67", nom: "Bas-Rhin" },
        { code: "68", nom: "Haut-Rhin" },
        { code: "69", nom: "Rhône" },
        { code: "70", nom: "Haute-Saône" },
        { code: "71", nom: "Saône-et-Loire" },
        { code: "72", nom: "Sarthe" },
        { code: "73", nom: "Savoie" },
        { code: "74", nom: "Haute-Savoie" },
        { code: "75", nom: "Paris" },
        { code: "76", nom: "Seine-Maritime" },
        { code: "77", nom: "Seine-et-Marne" },
        { code: "78", nom: "Yvelines" },
        { code: "79", nom: "Deux-Sèvres" },
        { code: "80", nom: "Somme" },
        { code: "81", nom: "Tarn" },
        { code: "82", nom: "Tarn-et-Garonne" },
        { code: "83", nom: "Var" },
        { code: "84", nom: "Vaucluse" },
        { code: "85", nom: "Vendée" },
        { code: "86", nom: "Vienne" },
        { code: "87", nom: "Haute-Vienne" },
        { code: "88", nom: "Vosges" },
        { code: "89", nom: "Yonne" },
        { code: "90", nom: "Territoire de Belfort" },
        { code: "91", nom: "Essonne" },
        { code: "92", nom: "Hauts-de-Seine" },
        { code: "93", nom: "Seine-Saint-Denis" },
        { code: "94", nom: "Val-de-Marne" },
        { code: "95", nom: "Val-d'Oise" },
        { code: "2A", nom: "Corse-du-Sud" },
        { code: "2B", nom: "Haute-Corse" }
    ]; // Liste des départements

    const apiUrl = "http://localhost:8000/api"; // URL de l'API

    fetch(apiUrl)
        .then(response => response.json())
        .then(response => {
            let data = response.data;
            data.forEach(item => {
                let dept = item["Code.département"];
                let annee = item["annee"];

                // Pour le classement 2023
                if (annee == "23") {
                    if (!tblClassement[dept]) {
                    tblClassement[dept] = 0;
                    }
                    tblClassement[dept] += item["faits"] || 0;
                }

                // Pour l'évolution par année
                if (!tblEvolution[dept]) {
                    tblEvolution[dept] = {};
                }
                if (!tblEvolution[dept][annee]) {
                    tblEvolution[dept][annee] = 0;
                }
                tblEvolution[dept][annee] += item["faits"] || 0;
            });

            tblClassement = Object.entries(tblClassement).sort((a, b) => a[1] - b[1]); // Tri du classement
            tblClassement.forEach((item, index) => {
            let itemClassement = `
                <li class="border-gray-400 flex flex-row mb-2 min-w-full">
                <div class="bg-gray-100 rounded-md flex flex-1 items-center p-3">
                    <div class="flex flex-col rounded-md w-10 h-10 justify-center items-center mr-4" style="background-image: url(&quot;img/${item[0]}.jpeg&quot;); background-size: cover; color: rgb(255, 255, 255); text-shadow: black 2px 2px 4px;">
                    <span>${index+1}</span>
                    </div>
                    <div class="flex-1 pl-1 mr-8">
                    <div class="font-medium">
                        <p>${departements.find(d => d.code === item[0])?.nom}</p>
                    </div>
                    <div class="text-gray-600 text-sm">
                        <p>${item[1]} crimes et délits</p>
                    </div>
                    </div>
                </div>
                </li>
            `; // J'utilise find pour récupérer le nom du département à partir du code
            
            if (index < 5) {
                document.getElementById("classement1").innerHTML += itemClassement; // Affichage des 5 premiers
            } else if (index < 10) {
                document.getElementById("classement2").innerHTML += itemClassement; // Affichage des 5 suivants
            } else if (index < 15) {
                document.getElementById("classement3").innerHTML += itemClassement; // Affichage des 5 derniers
            }
        });
        })
        .catch(error => console.error("Erreur: " + error));

        document.getElementById('departement').addEventListener('change', function () {
            let dept = document.getElementById("departement");
            let values = Object.values(tblEvolution[dept.value]); // Récupération des valeurs
            const chart = Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: `${dept.options[dept.selectedIndex].text}` // Nom du département
                },
                xAxis: {
                    categories: ['2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023'] 
                },
                yAxis: {
                    title: {
                        text: 'Nombre de crimes et délits'
                    }
                },
                series: [{
                    name: "Faits",
                    data: values
                }]
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            let dept = document.getElementById("departement");
            departements.forEach(item => {
                dept.innerHTML += `<option value="${item.code}">${item.code} - ${item.nom}</option>`; // Remplissage du select avec les départements
            });
        });
</script>
@endsection