<?php

include "assets/inc/user_access_control.php";

include "assets/inc/database_connection.php";

?>

<!DOCTYPE html>
<html>
<?php include "assets/inc/head.php"; ?>

<body id="ask" class="flex-container">
    <?php include "assets/inc/sidemenu.php" ?>
    <div id="page">
        <h1 id="title">Ask a question</h1>
        <form id="ask-form" action="assets/proc/ask_process.php" method="POST">
            <label for="title">Question</label>
            <textarea name="title" maxlength="50"></textarea>
            <label for="body">Further Details</label>
            <textarea name="body" maxlength="255"></textarea>
            <input type="submit" value="Ask!"/>
        </form>
    </div>
</body>

</html>