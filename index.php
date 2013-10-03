<?php
error_reporting(E_ALL);
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once($root . '/db.inc');

    // get list of Leagues
        $qry = "
            SELECT id, name
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
        <form method="post" action="login.php">
            <h1>Money Maker Football</h1>
            <div class="status error">
                Invalid login.
            </div>
            <div class="username field">
                <div class="label">Player E-mail:</div>
                <input name="email" class="form-text" />
                <div class="clear"></div>
            </div>
            <div class="password field">
                <div class="label">Password:</div>
                <input type="password" name="password" class="form-text" />
                <div class="clear"></div>
            </div>
            <div class="league field">
                <div class="label">League:</div>
                <select name="league_id">
                    <?php foreach ($leagues as $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="clear"></div>
            </div>
            <input type="submit" value="Enter the Arena" class="form-button" />
        </form>
    </div>
</body>
</html>