<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

/* if (login_check($mysqli) == true) {
  $logged = 'in';
  } else {
  $logged = 'out';
  } */
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="shortcut icon" href="Images/ampersand-full.256.png" type="favicon/ico" />
        <link rel="stylesheet" type="text/css" href="CSS/LoginStyle.css"/>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Erro ao fazer o login!</p>';
        }
        ?> 
        <div class="container">
            <div class="login">
                <h1>Login</h1>
                <form method="post" action="includes/process_login.php">
                    <p><input type="text" name="email"  placeholder="Username or Email"></p>
                    <p><input type="password" name="password"  placeholder="Password" id="password"></p>

                    <p class="submit"><input type="button" 
                                             value="Login" 
                                             onclick="formhash(this.form, this.form.password);" /> </p>
                </form>
            </div>



        </div>
    </body>
</html>
