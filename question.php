<?php

include "assets/inc/user_access_control.php";

include "assets/inc/database_connection.php";

function DisplayQuestion($conn) {
    $id = $_GET['id'];
    $sql_questionDetails = "SELECT question.*, COUNT(questionlike.questionid) AS likes
                            FROM question
                            LEFT JOIN questionlike ON question.id = questionlike.questionid
                            WHERE question.id = $id
                            GROUP BY questionid
                            ";
    $rs_questionDetails = mysqli_query($conn, $sql_questionDetails);
    $details = mysqli_fetch_assoc($rs_questionDetails);
    echo "<h1>" . $details['title'] . "</h1>";
    echo "<p>" . $details['body'] . "</p>";
    echo "<h2>" . $details['username'] . "</h2>";
    DisplayQuestionLikes($conn, $details['likes']);
}

function DisplayQuestionLikes($conn, $numberOfLikes) {
    $id = $_GET['id'];
    $username = $_SESSION['username'];

    $sql_userLiked =   "SELECT *
                        FROM questionlike
                        WHERE questionid=$id
                        AND username='$username'";
    $rs_userLiked = mysqli_query($conn, $sql_userLiked);
    
    if (mysqli_num_rows($rs_userLiked) == 1) {
        echo "<table class='likes active'>";
        echo    "<tr>";
        echo        "<td><a href='assets/proc/like_process.php?type=question&id=" . $id . "&process=unlike'><i class='fa fa-thumbs-up' aria-hidden='true'></i></a></td>";
        echo        "<td><span>" . $numberOfLikes . "</span></td>";
        echo    "</tr>";
        echo "</table>";
    } else {
        echo "<table class='likes'>";
        echo    "<tr>";
        echo        "<td><a href='assets/proc/like_process.php?type=question&id=" . $id . "&process=like'><i class='fa fa-thumbs-up' aria-hidden='true'></i></a></td>";
        echo        "<td><span>" . $numberOfLikes . "</span></td>";
        echo    "</tr>";
        echo "</table>";
    }
}

function DisplayAnswers($conn) {
    $id = $_GET['id'];
    $sql_answerDetails =   "SELECT answer.*, COUNT(answerlike.answerid) AS likes
                            FROM answer
                            LEFT JOIN answerlike ON answer.id = answerlike.answerid
                            WHERE answer.questionid = $id
                            GROUP BY answer.id";
    $rs_answerDetails = mysqli_query($conn, $sql_answerDetails);

    $numberOfAnswers = mysqli_num_rows($rs_answerDetails);
    echo "<h2>Answers (" . $numberOfAnswers . ")</h2>";
    for ($i = 1; $i <= $numberOfAnswers; $i++) {
        $details = mysqli_fetch_assoc($rs_answerDetails);
        echo "<div class='answer'>";
        echo    "<p>" . $details['text'] . "</p>";
        echo    "<h2>" . $details['username'] . "</h2>";
        DisplayAnswerLikes($conn, $details['id'], $details['likes']);
        echo "</div>";
    }
}

function DisplayAnswerLikes($conn, $id, $numberOfLikes) {
    $username = $_SESSION['username'];

    $sql_userLiked =   "SELECT *
                        FROM answerlike
                        WHERE answerid=$id
                        AND username='$username'";
    $rs_userLiked = mysqli_query($conn, $sql_userLiked);
    
    if (mysqli_num_rows($rs_userLiked) == 1) {
        echo "<table class='likes active'>";
        echo    "<tr>";
        echo        "<td><a href='assets/proc/like_process.php?type=answer&id=" . $id . "&process=unlike'><i class='fa fa-thumbs-up' aria-hidden='true'></i></a></td>";
        echo        "<td><span>" . $numberOfLikes . "</span></td>";
        echo    "</tr>";
        echo "</table>";
    } else {
        echo "<table class='likes'>";
        echo    "<tr>";
        echo        "<td><a href='assets/proc/like_process.php?type=answer&id=" . $id . "&process=like'><i class='fa fa-thumbs-up' aria-hidden='true'></i></a></td>";
        echo        "<td><span>" . $numberOfLikes . "</span></td>";
        echo    "</tr>";
        echo "</table>";
    }
}

?>

<!DOCTYPE html>
<html>
<?php include "assets/inc/head.php"; ?>

<body id="question" class="flex-container">
    <?php include "assets/inc/sidemenu.php" ?>
    <div id="page">
        <div id="question-details">
            <?php DisplayQuestion($conn); ?>
        </div>
        <div id="answers">
            <h2>Share an Answer</h2>
            <form id="answer-form" method="POST" action="assets/proc/answer_process.php?id=<?php echo $_GET['id'];?>">
                <textarea name="answer" placeholder="Write an answer..."></textarea>
                <input type="submit" value="Post"/>
            </form>
            <?php DisplayAnswers($conn); ?>
        </div>
    </div>
</body>

</html>