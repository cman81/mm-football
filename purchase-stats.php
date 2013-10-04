<!DOCTYPE html>
<html>
<head>
    <title>Money Maker Football - Purchase Stats</title>
    <!-- TODO: remove 'http:' from src when this is eventually hosted -->
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
    <!-- CSS Includes -->
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <!-- Google Web Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Chango|Oxygen' rel='stylesheet' type='text/css'>
</head>
<body class="purchase-stats-page">
    <div class="main-container">
        <form method="post" action="login.php">
            <h1>Step 2: Purchase Stats</h1>
            <div class="status success">
                Your stats have been saved.
            </div>
            <div class="status error">
                Your cannot spend more money than you have. Try again.
            </div>
            <div class="description">
                <p>Now is the time to put your money where your mouth is.</p>
                <p>Will your team dominate? If so, blow your entire bankroll!</p>
                <p>Are you stuck with a bust? Then maybe it's best to save your money for the next round.</p>
            </div>
            <h2>Scoring Mode:</h2>
            <select name="scoring_mode" class="scoring-mode">
                <option value="standard">Standard</option>
                <option value="aerial">Aerial Attack</option>
                <option value="ground">Ground Game</option>
                <option value="stingyd">Stingy D</option>
                <option value="justwin">Just Win Baby!</option>
            </select>
            <div class="scoring description standard selected">
                Standard scoring includes the following stats for FREE:
                <ul>
                    <li>Passing Yards</li>
                    <li>Rushing Yards</li>
                    <li>Defensive Points Allowed</li>
                </ul>
            </div>
            <div class="scoring description aerial selected">
                Aerial Attack scoring:
                <ul>
                    <li>Double points for Passing Yards</li>
                    <li>No points for Rushing Yards</li>
                    <li>No points for Defensive Points Allowed</li>
                </ul>
            </div>
            <div class="scoring description ground">
                Ground Game scoring:
                <ul>
                    <li>Double points for Rushing Yards</li>
                    <li>No points for Passing Yards</li>
                    <li>No points for Defensive Points Allowed</li>
                </ul>
            </div>
            <div class="scoring description stingyd">
                Stingy D scoring:
                <ul>
                    <li>Double points for Defensive Points Allowed</li>
                    <li>No points for Passing Yards</li>
                    <li>No points for Rushing Yards</li>
                </ul>
            </div>
            <div class="scoring description stingyd">
                Just Win Baby scoring, when team wins:
                <ul>
                    <li>Double points for Team Win (x4 instead of x2)</li>
                    <li>Standard scoring for Passing Yards</li>
                    <li>Standard scoring for Rushing Yards</li>
                </ul>
            </div>
            <div class="spacer"></div>
            <h2 class="float-left">Stats To Purchase:</h2>
            <div class="remaining float-right">$74 remaining</div>
            <div class="clear"></div>
            <div class="stats">
                <table>
                    <tr>
                        <td class="check"><input type="checkbox" name="passing_td" checked="checked" /></td>
                        <td class="stat-name">Passing TDs: $15</td>
                        <td class="amount"><input name="passing_td_amount" class="form-text disabled" value="15" /></td>
                    </tr>
                    <tr>
                        <td class="check"><input type="checkbox" name="rushing_td" checked="checked" /></td>
                        <td class="stat-name">Rushing TDs: $10</td>
                        <td class="amount"><input name="rushing_td_amount" class="form-text disabled" value="10" /></td>
                    </tr>
                    <tr>
                        <td class="check"><input type="checkbox" name="other_td" checked="checked" /></td>
                        <td class="stat-name">Def / Spec TDs: $5</td>
                        <td class="amount"><input name="other_td_amount" class="form-text disabled" value="5" /></td>
                    </tr>
                    <tr>
                        <td class="check"><input type="checkbox" name="fg_extra" /></td>
                        <td class="stat-name">Kicking Plays: $25</td>
                        <td class="amount"><input name="fg_extra_amount" class="form-text disabled" value="0" /></td>
                    </tr>
                    <tr>
                        <td class="check"><input type="checkbox" name="hustle" /></td>
                        <td class="stat-name">Hustle Plays: $15</td>
                        <td class="amount"><input name="hustle_amount" class="form-text disabled" value="0" /></td>
                    </tr>
                    <tr>
                        <td class="check"></td>
                        <td class="stat-name">Team Win?</td>
                        <td class="amount"><input name="team_win_amount" class="form-text" value="44" /></td>
                    </tr>
                </table>
            </div>
            <input type="submit" value="Save" class="form-button" />
        </form>
    </div>
</body>
</html>