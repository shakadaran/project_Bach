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
                        echo $ability; ?></p>
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
