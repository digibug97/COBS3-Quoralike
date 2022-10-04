<?php

include "assets/inc/user_access_control.php";

include "assets/inc/database_connection.php";

function DisplayQuestionsAsked($conn) {
    $username = $_SESSION['username'];
    $sql_questionsAsked = "SELECT question.*
                            FROM question
                            WHERE username='$username'";
    $rs_questionsAsked = mysqli_query($conn, $sql_questionsAsked);
    QuestionDisplay($rs_questionsAsked);
    
}

function DisplayQuestionsAnswered($conn) {
    $username = $_SESSION['username'];
    $sql_questionsAnswered = "SELECT question.*
                                FROM question
                                INNER JOIN answer ON question.id = answer.questionid
                                WHERE answer.username='$username'
                                GROUP BY question.id";
    $rs_questionsAnswered = mysqli_query($conn, $sql_questionsAnswered);
    QuestionDisplay($rs_questionsAnswered);
}

function QuestionDisplay($recordSet) {
    $numberOfQuestions = mysqli_num_rows($recordSet);
    for ($i = 1; $i <= $numberOfQuestions; $i++) {
        $thisQuestion = mysqli_fetch_assoc($recordSet);
        echo "<h2>" . $thisQuestion['title'] . "</h2>";
        echo "<a class='action-button' href='question.php?id=" . $thisQuestion['id'] . "'>View</a>";
    }
}

?>

<!DOCTYPE html>
<html>
<?php include "assets/inc/head.php"; ?>

<body id="profile" class="flex-container">
    <?php include "assets/inc/sidemenu.php" ?>
    <div id="page">
        <h1 id="title">Your Profile</h1>
        <div id="profile-info" class="flex-container">
            <div id="questions-asked">
                <h1>Questions Asked</h1>
                <?php DisplayQuestionsAsked($conn); ?>
            </div>
            <div id="questions-answered">
                <h1>Questions Answered</h1>
                <?php DisplayQuestionsAnswered($conn); ?>
            </div>
        </div>
    </div>
</body>

</html>