<!DOCTYPE html>
<html>
<head>
    <title>Money Maker Football - Watch Football!</title>
    <!-- TODO: remove 'http:' from src when this is eventually hosted -->
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
    <!-- CSS Includes -->
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <!-- Google Web Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Chango|Oxygen' rel='stylesheet' type='text/css'>
</head>
<body class="watch-football-page">
    <div class="main-container">
        <form method="post" action="login.php">
            <h1>Step 3: Watch Football!</h1>
            <div class="compare-scoring-methods">
                <table>
                    <tr class="even">
                        <th class="stat label">Your Team: Seahwaks</th>
                        <th class="actual">Actual</th>
                        <th class="standard">STD</th>
                        <th class="aerial">AIR</th>
                        <th class="ground">RUN</th>
                        <th class="stingyd">DEF</th>
                        <th class="justwin hidden">WIN</th>
                        <th class="yours">WIN</th>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">Passing Yards</td>
                        <td class="actual">331</td>
                        <td class="standard">$66</td>
                        <td class="aerial">$132</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$66</td>
                        <td class="yours">$66</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Rushing Yards</td>
                        <td class="actual">156</td>
                        <td class="standard">$78</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$156</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$78</td>
                        <td class="yours">$78</td>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">Defensive Points Allowed</td>
                        <td class="actual">17</td>
                        <td class="standard">$25</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$50</td>
                        <td class="justwin hidden">$25</td>
                        <td class="yours">$25</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Passing TDs</td>
                        <td class="actual">5</td>
                        <td class="standard">$100</td>
                        <td class="aerial">$100</td>
                        <td class="ground">$100</td>
                        <td class="stingyd">$100</td>
                        <td class="justwin hidden">$100</td>
                        <td class="yours">$100</td>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">Rushing TDs</td>
                        <td class="actual">1</td>
                        <td class="standard">$30</td>
                        <td class="aerial">$30</td>
                        <td class="ground">$30</td>
                        <td class="stingyd">$30</td>
                        <td class="justwin hidden">$30</td>
                        <td class="yours">$30</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Defensive / Special Team TDs</td>
                        <td class="actual">0</td>
                        <td class="standard">$0</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$0</td>
                        <td class="yours">$0</td>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">Extra Points</td>
                        <td class="actual">6</td>
                        <td class="standard">$30</td>
                        <td class="aerial">$30</td>
                        <td class="ground">$30</td>
                        <td class="stingyd">$30</td>
                        <td class="justwin hidden">$30</td>
                        <td class="yours">$30</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Field Goals: 0-39</td>
                        <td class="actual">1</td>
                        <td class="standard">$15</td>
                        <td class="aerial">$15</td>
                        <td class="ground">$15</td>
                        <td class="stingyd">$15</td>
                        <td class="justwin hidden">$15</td>
                        <td class="yours">$15</td>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">Field Goals: 40-49</td>
                        <td class="actual">0</td>
                        <td class="standard">$0</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$0</td>
                        <td class="yours">$0</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Field Goals: 50+</td>
                        <td class="actual">0</td>
                        <td class="standard">$0</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$0</td>
                        <td class="yours">$0</td>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">Sacks</td>
                        <td class="actual">3</td>
                        <td class="standard">$15</td>
                        <td class="aerial">$15</td>
                        <td class="ground">$15</td>
                        <td class="stingyd">$15</td>
                        <td class="justwin hidden">$15</td>
                        <td class="yours">$15</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Interceptions</td>
                        <td class="actual">2</td>
                        <td class="standard">$20</td>
                        <td class="aerial">$20</td>
                        <td class="ground">$20</td>
                        <td class="stingyd">$20</td>
                        <td class="justwin hidden">$20</td>
                        <td class="yours">$20</td>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">Safeties</td>
                        <td class="actual">0</td>
                        <td class="standard">$0</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$0</td>
                        <td class="yours">$0</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Blocked Kicks</td>
                        <td class="actual">0</td>
                        <td class="standard">$0</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$0</td>
                        <td class="yours">$0</td>
                    </tr>
                    <tr class="odd">
                        <td class="stat label">2pt Conversions</td>
                        <td class="actual">0</td>
                        <td class="standard">$0</td>
                        <td class="aerial">$0</td>
                        <td class="ground">$0</td>
                        <td class="stingyd">$0</td>
                        <td class="justwin hidden">$0</td>
                        <td class="yours">$0</td>
                    </tr>
                    <tr class="even">
                        <td class="stat label">Team Win</td>
                        <td class="actual">Yes</td>
                        <td class="standard">$68</td>
                        <td class="aerial">$68</td>
                        <td class="ground">$68</td>
                        <td class="stingyd">$68</td>
                        <td class="justwin hidden">$136</td>
                        <td class="yours">$136</td>
                    </tr>
                    <tr class="odd total-income">
                        <th class="stat label">Total Income</th>
                        <th class="actual"></th>
                        <th class="standard">$457</th>
                        <th class="aerial">$420</th>
                        <th class="ground">$444</th>
                        <th class="stingyd">$338</th>
                        <th class="justwin hidden">$525</th>
                        <th class="yours">$525</th>
                    </tr>
                </table>
            </div>
            <!-- TODO: add a 'compare with other players' table -->
            <h1>Final Results</h1>
            <div class="final-scoring">
                <table>
                    <tr>
                        <th class="player label">Player</th>
                        <th class="before-salaries">Before</th>
                        <th class="salaries">Salaries</th>
                        <th class="after-salaries">After</th>
                    </tr>
                    <tr>
                        <td class="player">1st Generic Team</td>
                        <td class="before-salaries">$432</td>
                        <td class="salaries">$304</td>
                        <td class="after-salaries">$128</td>
                    </tr>
                    <tr>
                        <td class="player">2nd Stuck in First</td>
                        <td class="before-salaries">$389</td>
                        <td class="salaries">$275</td>
                        <td class="after-salaries">$114</td>
                    </tr>
                    <tr>
                        <td class="player">3rd Your Favre-orite Team</td>
                        <td class="before-salaries">$198</td>
                        <td class="salaries">$140</td>
                        <td class="after-salaries">$58</td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</body>
</html>