<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
require_once 'includes/jpgraph-4.2.11/src/jpgraph.php';
require_once 'includes/jpgraph-4.2.11/src/jpgraph_radar.php';
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
        <link rel="stylesheet" type="text/css" href="CSS/StyleProj_1.css"/>
    </head>
    <body>
        <?php
        include_once './includes/Menu.php';
        ?>
        <div id="content">
            <?php if (login_check($mysqli) == true) : ?>
                <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
                <p>Current Ability for reading : <?php
                    $stmt = $mysqli->prepare("SELECT ability 
                    FROM user
                   WHERE username = ?
                    LIMIT 1");
                    $stmt->bind_param('s', $_SESSION['username']);  // Relaciona  "$email" ao parâmetro.
                    $stmt->execute();    // Executa a tarefa estabelecida.
                    $stmt->store_result();


                    $stmt->bind_result($ability);
                    $stmt->fetch();
                    ?>\</p>
                <div><?php
                    $graph = new RadarGraph(300, 200);
                    $graph->img->SetAntiAliasing();

// Set background color and shadow
                    $graph->SetColor("white");
                    $graph->SetShadow();

// Position the graph
                    $graph->SetCenter(0.4, 0.55);

// Setup the axis formatting 	
                    $graph->axis->SetFont(FF_FONT1, FS_BOLD);

// Setup the grid lines
                    $graph->grid->SetLineStyle("solid");
                    $graph->grid->SetColor("navy");
                    $graph->grid->Show();
                    $graph->HideTickMarks();

// Setup graph titles
                    $graph->title->Set("Quality result");
                    $graph->title->SetFont(FF_FONT1, FS_BOLD);

                    $graph->SetTitles($gDateLocale->GetShortMonth());

// Create the first radar plot		
                    $plot = new RadarPlot(array(70, 80, 60, 90, 71, 81, 47));
                    $plot->SetLegend("Goal");
                    $plot->SetColor("red", "lightred");
                    $plot->SetFill(false);
                    $plot->SetLineWeight(2);

// Create the second radar plot
                    $plot2 = new RadarPlot(array(70, 40, 30, 80, 31, 51, 14));
                    $plot2->SetLegend("Actual");
                    $plot2->SetLineWeight(2);
                    $plot2->SetColor("blue");
                    $plot2->SetFill(false);

// Add the plots to the graph
                    $graph->Add($plot2);
                    $graph->Add($plot);

// And output the graph
                    $graph->Stroke();
                    ?> TESTE
                </div>
            </p>
            <p>

            </p> <?php else : ?>
            <p>
                <span class="error"></span> Please <a href="LoginPage.php">login</a>.
            </p>
<?php endif; ?>


    </div>        
</body>

<?php
include_once './includes/rodape.php';
?>
</html>
