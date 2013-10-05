<?php
    session_start();
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once($root . '/db.inc');

    check_auth();
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
                    <tr>
                        <td class="rank">1st</td>
                        <td class="name">Generic Team</td>
                        <td class="balance">$169</td>
                    </tr>
                    <tr>
                        <th class="rank">2nd</th>
                        <th class="name">Stuck in First</th>
                        <th class="balance">$88</th>
                    </tr>
                    <tr>
                        <td class="rank">3rd</td>
                        <td class="name">Your Favre-orite Team</td>
                        <td class="balance">$43</td>
                    </tr>
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
                    <tr>
                        <td class="team">(4-2) Falcons</td>
                        <td class="opp">vs Bucs (2-4)</td>
                        <td class="bid"><input name="bid-atl" class="form-text" /></td>
                    </tr>
                    <tr>
                        <td class="team">(5-1) Patriots</td>
                        <td class="opp">at Packers (6-0)</td>
                        <td class="bid"><input name="bid-ne" class="form-text" /></td>
                    </tr>
                    <tr>
                        <td class="team">(3-3) Cowboys</td>
                        <td class="opp">vs Dolphins (2-4)</td>
                        <td class="bid"><input name="bid-dal" class="form-text" /></td>
                    </tr>
                    <tr>
                        <td class="team">(1-5) Jets</td>
                        <td class="opp">at Chargers (3-3)</td>
                        <td class="bid"><input name="bid-nyj" class="form-text" /></td>
                    </tr>
                </table>
            </div>
            <input type="submit" value="Save" class="form-button" />
        </form>
    </div>
</body>
</html>