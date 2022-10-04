<!DOCTYPE html>
<html>
<?php include "assets/inc/head.php"; ?>

<body id="signup" class="center-contents form-page">
    <div id="content">
        <form class="glass-card" action="assets/proc/signup_process.php" method="POST">
            <div>
                <a id="back" href="default.php">Go back home</a>
                <h1>Signup</h1>
                <div class="section">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" />
                </div>
                <div class="section">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" />
                </div>
                <div class="section">
                    <label for="password2">Confirm Password</label>
                    <input type="password" id="password2" name="password2" />
                </div>
                <input type="submit" class="action-button" value="Go!" />
            </div>
        </form>
    </div>
</body>

</html>