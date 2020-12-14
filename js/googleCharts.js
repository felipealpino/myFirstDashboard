// PRODUCAO
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Dia', 'Quantidade'],
        ['01', 2000],
        ['02', 2000],
        ['03', 2440],
        ['04', 2670],
        ['05', 2340],
        ['06', 2230],
        ['07', 2563],
        ['08', 2523],
        ['09', 1999],
        ['10', 1000],
        ['11', 2000],
        ['12', 2000],
        ['13', 2440],
        ['14', 2670],
        ['15', 2340],
        ['16', 2230],
        ['17', 2563],
        ['18', 2523],
        ['19', 1999],
        ['20', 1000],
        ['21', 2000],
        ['22', 2000],
        ['23', 2440],
        ['24', 2670],
        ['25', 2340],
        ['26', 2230],
        ['27', 2563],
        ['28', 2523],
        ['29', 1999],
        ['30', 1000],
        ['31', 1000],
    ]);

    var options = {
        chart: {
        title: 'Production Performance',
        subtitle: 'Production / day',
        },
        hAxis:{
            maxValue: 3000,
        },
        bars: 'vertical' // Required for Material Bar Charts.
    };

    var chart = new google.charts.Bar(document.getElementById('dashboard-grafico-producao'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
}


// ESTOQUE 
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', 'Expenses'],
        ['2013',  1000,      400],
        ['2014',  1170,      460],
        ['2015',  660,       1120],
        ['2016',  1030,      540]
    ]);

    var options = {
        title: 'Company Performance',
        hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('dashboard-grafico-estoque'));
    chart.draw(data, options);
}


// VENDAS
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', 'Expenses'],
        ['2004',  1000,      400],
        ['2005',  1170,      460],
        ['2006',  660,       1120],
        ['2007',  1030,      540]
    ]);

    var options = {
        title: 'Company Performance',
        curveType: 'function',
        legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('dashboard-grafico-vendas'));

    chart.draw(data, options);
}



// COMPRAS
google.charts.load('current', {
    'packages':['geochart'],
    // Note: you will need to get a mapsApiKey for your project.
    // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
    'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable([
        ['Country', 'Popularity'],
        ['Germany', 200],
        ['United States', 300],
        ['Brazil', 400],
        ['Canada', 500],
        ['France', 600],
        ['RU', 700]
    ]);

    var options = {};

    var chart = new google.visualization.GeoChart(document.getElementById('dashboard-grafico-compras'));

    chart.draw(data, options);
}
