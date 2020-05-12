<?ph p
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>  
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="shortcut icon" href="Images/ampersand-full.256.png" type="favicon/ico" />
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="CSS/StyleProj.css"/>

    </head>
    <body>
        <div  <?php
        include_once './includes/Menu.php';
        ?>
            />


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

            google.charts.load('current', {'packages': ['corechart', 'table', 'gauge', 'controls']});
            google.charts.setOnLoadCallback(drawMainDashboard2);
            function drawMainDashboard2() {
                google.load('visualization', '1', {packages: ['controls']});
                google.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Dimension');
                    data.addColumn('number', 'Questions Right');
                    data.addColumn('number', 'QuestionsWrong');

                    data.addRows([
                        ['Grammar', 45, 60],
                        ['Vocab', 155, 50],
                        ['Slang', 35, 31]
                        
                        

                    ]);

                    var columnsTable = new google.visualization.DataTable();
                    columnsTable.addColumn('number', 'colIndex');
                    columnsTable.addColumn('string', 'colLabel');
                    var initState = {selectedValues: []};
                    // put the columns into this data table (skip column 0)
                    for (var i = 1; i < data.getNumberOfColumns(); i++) {
                        columnsTable.addRow([i, data.getColumnLabel(i)]);
                        // you can comment out this next line if you want to have a default selection other than the whole list
                        initState.selectedValues.push(data.getColumnLabel(i));
                    }
                    // you can set individual columns to be the default columns (instead of populating via the loop above) like this:
                    // initState.selectedValues.push(data.getColumnLabel(4));

                    var chart = new google.visualization.ChartWrapper({
                        chartType: 'BarChart',
                        containerId: 'chart',
                        dataTable: data,
                        options: {
                            title: 'Foobar',
                            width: 600,
                            height: 400
                        }
                    });

                    var columnFilter = new google.visualization.ControlWrapper({
                        controlType: 'CategoryFilter',
                        containerId: 'control',
                        dataTable: columnsTable,
                        options: {
                            filterColumnLabel: 'colLabel',
                            ui: {
                                label: 'Columns',
                                allowTyping: false,
                                allowMultiple: true,
                                allowNone: false,
                                selectedValuesLayout: 'belowStacked'
                            }
                        },
                        state: initState
                    });
                    var categoryPicker = new google.visualization.ControlWrapper({
                        'controlType': 'CategoryFilter',
                        'containerId': 'control2',
                        'options': {
                            'filterColumnIndex': 0,
                            'ui': {
                                'labelStacking': 'vertical',
                                'label': 'Category Selection:',
                                'caption': 'All subjects',
                                'allowTyping': false,
                                'allowMultiple': true
                            }
                        }
                    });

                    function setChartView() {
                        var state = columnFilter.getState();
                        var row;
                        var view = {
                            columns: [0]
                        };
                        for (var i = 0; i < state.selectedValues.length; i++) {
                            row = columnsTable.getFilteredRows([{column: 1, value: state.selectedValues[i]}])[0];
                            view.columns.push(columnsTable.getValue(row, 0));
                        }
                        // sort the indices into their original order
                        view.columns.sort(function (a, b) {
                            return (a - b);
                        });
                        chart.setView(view);
                        chart.draw();
                    }
                    google.visualization.events.addListener(columnFilter, 'statechange', setChartView);

                    var dash = new google.visualization.Dashboard(document.getElementById('dashboard'));
                    setChartView();
                    columnFilter.draw();
                    dash.bind([categoryPicker], [chart]);
                    dash.draw(data);
                    


                }
            }


        </script>
    </head>
    <!--Div that will hold the dashboard-->
    <div id="dashboard_div" style="width:600px">            
        <div id="control"></div>
        <div id="control2"></div>
        <div id="chart"></div>

    </div> 

</body>



</html>
