<?php
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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>
    <body>
        <div style="top:10px;position:fixed"><?php
            include_once './includes/Menu.php';
            ?></div>


        <div id="content" style="overflow-y: auto;position:fixed ;top:200px ; height: 500px">
            <div id="dashboard1" style="">            
                <div id="chart_div"></div>
                <div id="control_div"></div>
                <p><span id='dbgchart' style="visibility: hidden"></span></p>
            </div>
            <div id="dashboard2" style="width:auto">            
                <div id="control"></div>
                <div id="chart"></div>
            </div>   
            <div id="dashboard3">
                <div id="control1"></div>
                <div id="control2"></div>
                <div id="chart2"></div>
            </div>
        </div>

    </body>
    <?php

    function request_db($type) {
        if ($type == 1) {
            $table = array();
            $table['cols'] = array(
                // Labels for your chart, these represent the column titles
                // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
                array('label' => 'Weekly Task', 'type' => 'string'),
                array('label' => 'Percentage', 'type' => 'number')
            );

            $rows = array();
            while ($r = mysql_fetch_assoc($sth)) {
                $temp = array();
                // the following line will be used to slice the Pie chart
                $temp[] = array('v' => (string) $r['Weekly_task']);

                // Values of each slice
                $temp[] = array('v' => (int) $r['percentage']);
                $rows[] = array('c' => $temp);
            }

            $table['rows'] = $rows;
            $jsonTable = json_encode($table);
//echo $jsonTable;
            ?>
    }
    }
    ?>

    <script type="text/javascript">

        google.charts.load('current', {'packages': ['corechart', 'table', 'gauge', 'controls']});
        google.charts.setOnLoadCallback(drawMainDashboard);
        function drawMainDashboard() {

            var data = new google.visualization.DataTable();
            data.addColumn('date', 'X');
            data.addColumn('number', 'Y1');
            data.addColumn('number', 'Y2');
            data.addColumn('number', 'Y3');
            data.addRow([new Date(2016, 0, 1), 1, 123, 3]);
            data.addRow([new Date(2016, 1, 1), 6, 42, 3]);
            data.addRow([new Date(2016, 2, 1), 4, 49, 3]);
            data.addRow([new Date(2016, 3, 1), 23, 486, 3]);
            data.addRow([new Date(2016, 4, 1), 89, 476, 3]);
            data.addRow([new Date(2016, 5, 1), 46, 444, 3]);
            data.addRow([new Date(2016, 6, 1), 178, 442, 3]);
            data.addRow([new Date(2016, 7, 1), 12, 274, 3]);
            data.addRow([new Date(2016, 8, 1), 123, 4934, 3]);
            data.addRow([new Date(2016, 9, 1), 144, 4145, 3]);
            data.addRow([new Date(2016, 10, 1), 135, 946, 3]);
            data.addRow([new Date(2016, 11, 1), 178, 747, 3]);
            var control = new google.visualization.ControlWrapper({
                controlType: 'ChartRangeFilter',
                containerId: 'control_div',
                options: {
                    filterColumnIndex: 0,
                    ui: {
                        chartOptions: {
                            height: 30,
                            width: 900,
                            chartArea: {
                                width: '80%'
                            }
                        }
                    }
                }
            });
            var chart = new google.visualization.ChartWrapper({
                chartType: 'LineChart',
                containerId: 'chart_div',
                options: {
                    width: 900,
                    chartArea: {
                        width: '70%'
                    },
                    hAxis: {
                        format: 'MMM',
                        slantedText: false,
                        maxAlternation: 1
                    }, colors: ['#a52714', '#097138', '#F6FF33'],
                    crosshair: {
                        color: '#000',
                        trigger: 'selection'
                    }

                }
            });
            function setOptions() {
                var firstDate;
                var lastDate;
                var v = control.getState();
                if (v.range) {
                    document.getElementById('dbgchart').innerHTML = v.range.start + ' to ' + v.range.end;
                    firstDate = new Date(v.range.start.getTime() + 1);
                    lastDate = new Date(v.range.end.getTime() - 1);
                    data.setValue(v.range.start.getMonth(), 0, firstDate);
                    data.setValue(v.range.end.getMonth(), 0, lastDate);
                } else {
                    firstDate = data.getValue(0, 0);
                    lastDate = data.getValue(data.getNumberOfRows() - 1, 0);
                }

                var ticks = [];
                for (var i = firstDate.getMonth(); i <= lastDate.getMonth(); i++) {
                    ticks.push(data.getValue(i, 0));
                }

                chart.setOption('hAxis.ticks', ticks);
                chart.setOption('hAxis.viewWindow.min', firstDate);
                chart.setOption('hAxis.viewWindow.max', lastDate);
                if (dash) {
                    chart.draw();
                }
            }

            setOptions();
            google.visualization.events.addListener(control, 'statechange', setOptions);
            var dash = new google.visualization.Dashboard(document.getElementById('dashboard'));
            dash.bind([control], [chart]);
            dash.draw(data);
        }



    </script>
    <script type="text/javascript">

        google.charts.load('current', {'packages': ['corechart', 'table', 'gauge', 'controls']});
        google.charts.setOnLoadCallback(drawMainDashboard2);
        function drawMainDashboard2() {
            var dashboard2 = new google.visualization.Dashboard(
                    document.getElementById('dashboard_div'));

            var categoryPicker = new google.visualization.ControlWrapper({
                'controlType': 'CategoryFilter',
                'containerId': 'control',
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
            var pie = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart',
                'options': {
                    'width': 300,
                    'height': 300,
                    'legend': 'none',
                    'chartArea': {'left': 15, 'top': 15, 'right': 0, 'bottom': 0},
                    'pieSliceText': 'label'
                },
                'view': {'columns': [0, 5]}
            });
            pie.setOption('title', 'Pie 1');


            var data2 = google.visualization.arrayToDataTable([
                ['Dimension', 'Progress', 'Qr', 'QW', 'Date', 'totals'],
                ['Grammar', 1000, 12, 5, new Date(2016, 1, 1), 17],
                ['Writing', 1000, 12, 5, new Date(2016, 1, 1), 19],
                ['Listenning', 1000, 12, 5, new Date(2016, 1, 1), 18],
                ['Slangs', 1000, 12, 5, new Date(2016, 1, 1), 15],
            ]);


            dashboard2.bind([categoryPicker], [pie]);
            dashboard2.draw(data2);
        }


    </script>
    <script type="text/javascript">

        google.charts.load('current', {'packages': ['corechart', 'table', 'gauge', 'controls']});
        google.charts.setOnLoadCallback(drawMainDashboard3);
        function drawMainDashboard3() {
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
                    containerId: 'chart2',
                    dataTable: data,
                    options: {
                        title: 'Foobar',
                        width: 600,
                        height: 400
                    }
                });

                var columnFilter = new google.visualization.ControlWrapper({
                    controlType: 'CategoryFilter',
                    containerId: 'control1',
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
</html>
