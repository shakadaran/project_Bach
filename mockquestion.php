<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();


function verify($answer, $ra) {
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
    if ($answer == $ra) {
        echo "<script type='text/javascript'>alert('Correct!');</script>";
        if ($_SESSION['typeq'] == 1) {
            $stmt = $mysqli->prepare("INSERT INTO overall_progress (user_date,questions1r)"
                    . "VALUES (?,1)"
                    . "ON DUPLICATE KEY UPDATE questions1r = questions1r+1;");
            $userdate = $_SESSION['user_id'] . "_" . date("Y-m-d");
            $stmt->bind_param('s', $userdate);  // Relaciona  "$email" ao parâmetro.
            $stmt->execute();    // Executa a tarefa estabelecida.
           
        } elseif ($_SESSION['typeq'] == 2) {
            $stmt = $mysqli->prepare("INSERT INTO overall_progress (user_date,questions2r)"
                    . "VALUES (?,1)"
                    . "ON DUPLICATE KEY UPDATE questions2r = questions2r+1;");
            $userdate = $_SESSION['user_id'] . "_" . date("Y-m-d");
            $stmt->bind_param('s', $userdate);  // Relaciona  "$email" ao parâmetro.
            $stmt->execute();    // Executa a tarefa estabelecida.
        } else {
            $stmt = $mysqli->prepare("INSERT INTO overall_progress (user_date,questions3r)"
                    . "VALUES (?,1)"
                    . "ON DUPLICATE KEY UPDATE questions3r = questions3r+1;");
            $userdate = $_SESSION['user_id'] . "_" . date("Y-m-d");
            $stmt->bind_param('s', $userdate);  // Relaciona  "$email" ao parâmetro.
            $stmt->execute();    // Executa a tarefa estabelecida.
        }
    } else {
        echo "<script type='text/javascript'>alert('Wrong!');</script>";
        if ($_SESSION['typeq'] == 1) {
            $stmt = $mysqli->prepare("INSERT INTO overall_progress (user_date,questions1w)"
                    . "VALUES (?,1)"
                    . "ON DUPLICATE KEY UPDATE questions1w = questions1w+1;");
            $userdate = $_SESSION['user_id'] . "_" . date("Y-m-d");
            $stmt->bind_param('s', $userdate);  // Relaciona  "$email" ao parâmetro.
            $stmt->execute();    // Executa a tarefa estabelecida.
        } elseif ($_SESSION['typeq'] == 2) {
            $stmt = $mysqli->prepare("INSERT INTO overall_progress (user_date,questions2w)"
                    . "VALUES (?,1)"
                    . "ON DUPLICATE KEY UPDATE questions2w = questions2w+1;");
            $userdate = $_SESSION['user_id'] . "_" . date("Y-m-d");
            $stmt->bind_param('s', $userdate);  // Relaciona  "$email" ao parâmetro.
            $stmt->execute();    // Executa a tarefa estabelecida.
        } else {
            $stmt = $mysqli->prepare("INSERT INTO overall_progress (user_date,questions3w)"
                    . "VALUES (?,1)"
                    . "ON DUPLICATE KEY UPDATE questions3w = questions3w+1;");
            $userdate = $_SESSION['user_id'] . "_" . date("Y-m-d");
            $stmt->bind_param('s', $userdate);  // Relaciona  "$email" ao parâmetro.
            $stmt->execute();    // Executa a tarefa estabelecida.
        }
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
        <link rel="stylesheet" type="text/css" href="CSS/StyleProj.css"/>
    </head>
    <body>
        <div style="top:10px;position:fixed"><?php
            include_once './includes/Menu.php';
            ?></div>

        <div class="content" style="bottom:auto" >
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {


                verify($_POST["q1"], $_SESSION["ra"]);
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
                        $stmt = $mysqli->prepare("SELECT id
                    FROM user
                   WHERE username = ?
                    LIMIT 1");
                        $stmt->bind_param('s', $_SESSION['username']);  // Relaciona  "$email" ao parâmetro.
                        $stmt->execute();    // Executa a tarefa estabelecida.
                        $stmt->store_result();


                        $stmt->bind_result($_SESSION['id']);
                        $stmt->fetch();
                        $quest = $ability + log(1.2);
                        $min = $quest - 0.2;
                        $max = $quest + 0.1;
                        //echo $quest;
                        $sql = "SELECT * FROM questions  ORDER BY RAND() LIMIT 1";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "id: " . $row["id"] . " -  " . $row["text"] . " <br>";
                                $_SESSION['ra'] = $row["answer1"];
                                $_SESSION['typeq'] = $row["type"];
                            }
                        }
                        ?></p>
                    <u2 class = "answers">                                
                        <?php
                        if ($_SESSION['typeq'] == 1) {
                            $sql = "SELECT * FROM propos ORDER BY RAND() LIMIT 4";
                            $result = $mysqli->query($sql);
                            $answers = [];
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['propos'] != $_SESSION['ra'] && sizeof($answers) < 3) {
                                        $answers[] = $row['propos'];
                                    }
                                }
                                $answers[] = $_SESSION['ra'];
                                shuffle($answers);
                                foreach ($answers as $value) {
                                    ?>
                                    <input type="radio" name="q1" value="<?php echo($value) ?>" id="q1d"><label for="q1d"><?php echo($value) ?></label><br/>
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


</html>
