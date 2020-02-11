<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
sec_session_start();
$conn = $mysqli;
$id = (int) mysqli_real_escape_string($conn, htmlentities($_POST["id"]));
if ($_POST["button_1"] == 'Deletar') {

    include_once './includes/db_connect.php';
    /** Check that the page was requested from itself via the POST method. */
    $queryalt = "DELETE FROM tab_correcao "
            . "WHERE id=$id";
    mysqli_query($conn, $queryalt);


    header('Location: RelatorioCorrecaoPage.php');
    exit;
} else if ($_POST["button_1"] == 'Alterar') {
    ?>
    <html>
        <form  action="AlteraCorrecaoPage.php" method="POST" id="frm1">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
        </form>
        <script type="text/javascript">
            document.getElementById('frm1').submit(); // SUBMIT FORM
        </script>

    </html>
    <?php
}
