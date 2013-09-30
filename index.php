<!DOCTYPE html>
<html>
<head>
    <title>Money Maker Football</title>
    <!-- TODO: remove 'http:' from src when this is eventually hosted -->
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>

</head>
<body>
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
            <?php foreach ($leagues as $key => $value): ?>
                <option value="<?= $key ?>"><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Enter the Arena" />
</body>
</html>