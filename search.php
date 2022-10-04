<?php

include "assets/inc/user_access_control.php";

include "assets/inc/database_connection.php";

function DisplayResults($conn) {
    
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
    } else {
        $searchTerm = "";
    }
    $username = $_SESSION['username'];
    $sql_searchResults = "SELECT question.*
                            FROM question
                            LEFT JOIN answer on question.id = answer.questionid
                            WHERE question.title LIKE '%$searchTerm%'
                            OR question.body LIKE '%$searchTerm%'
                            OR question.username LIKE '%$searchTerm%'
                            OR answer.text LIKE '%$searchTerm%'
                            OR answer.username LIKE '%$searchTerm%'
                            GROUP BY question.id";
    $rs_searchResults = mysqli_query($conn, $sql_searchResults);
    $numberResults = mysqli_num_rows($rs_searchResults);
    if ($numberResults > 0) {
        for ($i = 1; $i <= $numberResults; $i++) {
            $thisResult = mysqli_fetch_assoc($rs_searchResults);
            echo "<div class='question-summary'>";
            echo    "<h1>" . $thisResult['title'] . "</h1>";
            echo    "<h2>" . $thisResult['username'] . "</h2>";
            echo    "<p>" . (strlen($thisResult['body']) > 150 ? substr($thisResult['body'], 0, 150) . "..." : $thisResult['body']) . "</p>";
            echo    "<a class='action-button' href='question.php?id=" . $thisResult['id'] . "'>View Details</a>";
            echo "</div>";
        }
    } else {
        echo "<h2 id='no-results'>No search results</h2>";
    }


}
?>

<!DOCTYPE html>
<html>
<?php include "assets/inc/head.php"; ?>

<body id="search" class="flex-container">
    <?php include "assets/inc/sidemenu.php" ?>
    <div id="page">
        <h1 id="title">Search Page</h1>
        <form id="search-box" method="GET" action="search.php">
            <input type="text" name="search" placeholder="Search term"/>
            <input type="submit" value="Search"/>
        </form>
        <div id="search-results">
            <?php DisplayResults($conn); ?>
        </div>
    </div>
</body>

</html>