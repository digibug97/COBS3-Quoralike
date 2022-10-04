<!DOCTYPE html>
<html>
<?php include "assets/inc/head.php"; ?>

<body id="login" class="center-contents form-page">
    <div id="content">
        <form class="glass-card" action="assets/proc/login_process.php" method="POST">
            <div>
                <a id="back" href="default.php">Go back home</a>
                <h1>Login</h1>
                <div class="section">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" />
                </div>
                <div class="section">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" />
                </div>
                <input type="submit" class="action-button" value="Go!" />
                <a id="signup-link" href="signup.php" class="action-button">...but I don't have an account yet!</a>
            </div>
        </form>
        
    </div>
</body>

</html>