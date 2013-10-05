<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once($root . '/db.inc');
    require_once($root . '/team-auction.inc');

    check_auth();
    $balances = load_balances();
    $teams = load_teams();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Money Maker Football - Team Auction</title>
    <!-- TODO: remove 'http:' from src when this is eventually hosted -->
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
    <!-- CSS Includes -->
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <!-- Google Web Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Chango|Oxygen' rel='stylesheet' type='text/css'>
</head>
<body class="team-auction-page">
    <div class="main-container">
        <form method="post" action="login.php">
            <h1 class="float-left">Step 1: Pick a Team</h1>
            <div class="go-home float-right">
                <a href="/"><img src="/images/home-icon.png" /></a>
            </div>
            <div class="clear">
            <?= show_status() ?>
            <div class="description">
                <p>Your money will grow based on which team you choose.</p>
                <p>Will you go for the obvious favorite and pay a premium in the process?</p>
                <p>Or will you go cheap and take what you can get for free?</p>
            </div>
            <h2>Current standings:</h2>
            <div class="standings">
                <table>
                    <?php foreach ($balances as $value): ?>
                        <tr>
                            <?php if ($value['email'] != $_SESSION['auth']['email']): ?>
                                <td class="rank"><?= ordinal($value['rank']) ?></td>
                                <td class="name"><?= $value['franchise'] ?></td>
                                <td class="balance">$<?= $value['balance'] ?></td>
                            <?php else: ?>
                                <th class="rank"><?= ordinal($value['rank']) ?></th>
                                <th class="name"><?= $value['franchise'] ?></th>
                                <th class="balance">$<?= $value['balance'] ?></th>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <h2>This week's teams:</h2>
            <div class="teams">
                <table>
                    <tr>
                        <th class="team">Team</th>
                        <th class="opp">Opponent</th>
                        <th class="bid">Bid</th>
                    </tr>
                    <?php foreach ($teams as $value): ?>
                        <tr>                            
                            <td class="team"><?= $value['team_record'] ?> <?= $value['team_name'] ?></td>
                            <td class="opp"><?= ($value['is_team_home']) ? 'vs' : 'at' ?> <?= $value['opp_name'] ?> <?= $value['opp_record'] ?></td>
                            <td class="bid"><input name="bid-<?= $value['team_abbr'] ?>" class="form-text" /></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <input type="submit" value="Save" class="form-button" />
        </form>
    </div>
</body>
</html>