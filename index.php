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

</head>
<body>
    <form method="post" action="login.php">
        <h1>Login Screen</h1>
        <div class="username-field">
            Player E-mail:
            <input name="email" />
        </div>
        <div class="password-field">
            Password:
            <input type="password" name="password" />
        </div>
        <div class="league-field">
            League:
            <select name="league_id">
                <?php foreach ($leagues as $value): ?>
                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="submit" value="Enter the Arena" />
    </form>
</body>
</html>