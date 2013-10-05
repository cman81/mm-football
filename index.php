<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once($root . '/db.inc');

    // logout
        if (isset($_SESSION['auth'])) {
            $_SESSION['mmf_success'][] = 'You have been successfully logged out.';
        }
        unset($_SESSION['auth']);
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
    <title>Money Maker Football - Login</title>
    <!-- TODO: remove 'http:' from src when this is eventually hosted -->
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
    <!-- CSS Includes -->
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <!-- Google Web Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Chango|Oxygen' rel='stylesheet' type='text/css'>
</head>
<body class="login-page">
    <div class="main-container">
        <form method="post" action="/submit/login_submit.php">
            <h1>Money Maker Football</h1>
            <?= show_status() ?>
            <div class="username field">
                <div class="label float-left">Player E-mail:</div>
                <div class="new float-right"><a href="new.php">New Player?</a></div>
                <div class="clear"></div>
                <input name="email" class="form-text" />
                <div class="clear"></div>
            </div>
            <div class="password field">
                <div class="label float-left">Password:</div>
                <div class="reset-pw float-right"><a href="reset.php">Reset / Change?</a></div>
                <div class="clear"></div>
                <input type="password" name="password" class="form-text" />
                <div class="clear"></div>
            </div>
            <div class="league field">
                <div class="label float-left">League:</div>
                <div class="new float-right"><a href="new.php">New League?</a></div>
                <div class="clear"></div>
                <select name="league_id">
                    <?php foreach ($leagues as $value): ?>
                        <option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="clear"></div>
            </div>
            <input type="submit" value="Enter the Arena" class="form-button" />
        </form>
    </div>
</body>
</html>