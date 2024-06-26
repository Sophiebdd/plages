//let bouton = document.getElementById('monBouton');
//bouton.addEventListener("click", confirm("Etes-vous certain de vouloir supprimer cette ligne?"));

// Data retrieved from https://worldpopulationreview.com/country-rankings/countries-by-density
Highcharts.chart('container', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: 'Part en pourcentage de chaque type de terrain sur cette plage:',
        align: 'left'
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
            'Area (square km): <b>{point.y}</b><br/>' +
            'Population density (people per square km): <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        borderRadius: 5,
        data: [{
            name: 'Spain',
            y: 505992,
            z: 92
        }, {
            name: 'France',
            y: 551695,
            z: 119
        }, {
            name: 'Poland',
            y: 312679,
            z: 121
        }, {
            name: 'Czech Republic',
            y: 78865,
            z: 136
        }, {
            name: 'Italy',
            y: 301336,
            z: 200
        }, {
            name: 'Switzerland',
            y: 41284,
            z: 213
        }, {
            name: 'Germany',
            y: 357114,
            z: 235
        }],
        colors: [
            '#4caefe',
            '#3dc3e8',
            '#2dd9db',
            '#1feeaf',
            '#0ff3a0',
            '#00e887',
            '#23e274'
        ]
    }]
});





