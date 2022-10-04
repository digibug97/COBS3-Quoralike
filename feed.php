<?php

include "assets/inc/user_access_control.php";

include "assets/inc/database_connection.php";

function DisplayQuestions($conn) {
    $sql_questions = "SELECT question.*
                        FROM question";
    $rs_questions = mysqli_query($conn, $sql_questions);
    $numberOfQuestions = mysqli_num_rows($rs_questions);
    for ($i = 1; $i <= $numberOfQuestions; $i++) {
        $thisQuestion = mysqli_fetch_assoc($rs_questions);
        echo "<div class='question-summary'>";
        echo    "<h1>" . $thisQuestion['title'] . "</h1>";
        echo    "<h2>" . $thisQuestion['username'] . "</h2>";
        echo    "<p>" . (strlen($thisQuestion['body']) > 150 ? substr($thisQuestion['body'], 0, 150) . "..." : $thisQuestion['body']) . "</p>";
        echo    "<a class='action-button' href='question.php?id=" . $thisQuestion['id'] . "'>View Details</a>";
        echo "</div>";
    }
}

?>

<!DOCTYPE html>
<html>
<?php include "assets/inc/head.php"; ?>

<body id="feed" class="flex-container">
    <?php include "assets/inc/sidemenu.php" ?>
    <div id="page">
        <h1 id="title">Feed</h1>
        <div id="questions-container">
            <?php DisplayQuestions($conn);?>
        </div>
    </div>
</body>

</html>