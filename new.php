<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once($root . '/db.inc');

    // get list of Leagues
        $qry = "
            SELECT name
            FROM leagues
            ORDER BY name ASC
        ";
        $leagues = q($qry);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Money Maker Football - New Player or League</title>
    <!-- TODO: remove 'http:' from src when this is eventually hosted -->
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
    <!-- CSS Includes -->
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <!-- Google Web Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Chango|Oxygen' rel='stylesheet' type='text/css'>
</head>
<body class="registration-page">
    <div class="main-container">
        <form method="post" action="/submit/new_submit.php">
            <h1>Registration</h1>
            <div class="status error">
                Invalid login.
            </div>
            <div class="description"></div>
            <div class="username field">
                <div class="label">Enter your email address.</div>
                <input name="email" class="form-text" />
            </div>
            <div class="password field">
                <div class="label">
                    <p>Existing user? Enter your password.</p>
                    <p>New? Enter the password you wish to use.</p>
                </div>
                <input type="password" name="password" class="form-text" />
            </div>
            <div class="league field">
                <div class="label">Which league would you like to join?</div>
                <select name="league_id">
                    <?php foreach ($leagues as $value): ?>
                        <option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                    <option value="~NEW~">[Create a new league...]</option>
                </select>
            </div>
            <div class="new-league field">
                <div class="label">Enter the name of your new league.</div>
                <input name="new_league" class="form-text" />
            </div>
            <input type="submit" value="Register New User and/or League" class="form-button" />
        </form>
    </div>
</body>
</html>