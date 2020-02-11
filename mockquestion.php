<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();

function verify($answer, $ra) {
    if ($answer == $ra) {
        echo "<script type='text/javascript'>alert('Correct!');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Wrong!');</script>";
    }
}
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
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {


                verify($_POST["q1"], $_SESSION["ra"]);
                ;
            }


            if (login_check($mysqli) == true) :
                ?>
                <form  action="mockquestion.php" method="POST">    
                    <p class="question"><?php
                        $stmt = $mysqli->prepare("SELECT ability 
                    FROM user
                   WHERE username = ?
                    LIMIT 1");
                        $stmt->bind_param('s', $_SESSION['username']);  // Relaciona  "$email" ao parâmetro.
                        $stmt->execute();    // Executa a tarefa estabelecida.
                        $stmt->store_result();


                        $stmt->bind_result($ability);
                        $stmt->fetch();
                        $quest=$ability+log(1.2);
                        $min=$quest-0.2;
                        $max=$quest+0.1;
                        //echo $quest;
                        $sql = "SELECT * FROM questions WHERE dificulty BETWEEN '$min' AND '$max' ORDER BY RAND() LIMIT 1";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "id: " . $row["id"] . " -  " . $row["text"] . " <br>";
                                $_SESSION['ra'] = $row["rightanswer"];
                                ?></p>
                            <u2 class = "answers">

                                <input type = "radio" name = "q1" value = "1" id = "q1a"><label for = "q1a">Option 1</label><br/>

                                <input type = "radio" name = "q1" value = "2" id = "q1b"><label for = "q1b">Option 2</label><br/>
                                <?php if ($row["type"] == 0) {
                                    ?>
                                    <input type="radio" name="q1" value="3" id="q1c"><label for="q1c">Option 3</label><br/>

                                    <input type="radio" name="q1" value="4" id="q1d"><label for="q1d">Option 4</label><br/>
                                <?php } ?>
                            </u2>
                            <?php
                        }
                    }
                    ?>




                    <input type="submit" value="answer" name="answer" />
                </form>



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
