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

    </head>
    <body>
        <div style="top:10px;position:fixed"><?php
            include_once './includes/Menu.php';
            ?></div>



        <div class="iactiveImg" data-ii="12020"style="position:fixed ;width: 60%; height: auto ;bottom:10px "></div><script src="https://interactive-img.com/js/include.js"></script>
    </body>


</html>
