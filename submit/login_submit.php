<?php
	session_start();
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require_once($root . '/db.inc');

	$email = trim($_POST['email']);
	$password_clear = trim($_POST['password']);
	$password_md5 = md5($password_clear . get_salt());
	$league_id = trim($_POST['league_id']);

	// logout as a precaution
		unset($_SESSION['auth']);

	// basic validation
		if ($email == '') {
			$_SESSION['mmf_error'][] = 'Email cannot be blank.';
			mmf_goto('');
		}

	$qry = "
		SELECT l.gamedata, ulm.turndata, l.launch_date
		FROM leagues l
		INNER JOIN user_league_map ulm ON ulm.league_id = l.name
		INNER JOIN users u ON u.email = ulm.user_id
		WHERE u.email = '" . $email . "'
		AND u.is_verified = 1
		AND u.enc_pass = '" . $password_md5 . "'
		AND l.name = '" . $league_id . "'
	";
	$data = q($qry);

	if (count($data) != 1) {
		$_SESSION['mmf_error'][] = 'Login not successful.';
		mmf_goto('');
	}

	// has their league launched yet?
		$launch_date = strtotime($data[0]['launch_date']);
		if ($launch_date > time()) {
			$_SESSION['mmf_error'][] = 'You league has not started yet. Check back on your launch date of ' . date('n/j/Y', $launch_date) . '!';
			mmf_goto();
		}

	// initialize authenticated user details
		$_SESSION['mmf_success'][] = 'Welcome to the league!';
		$_SESSION['auth'] = array(
			'email' => $email,
			'league' => $league_id,
			'current_step' => 1,
		);
		$_SESSION['auth']['gamedata'] = json_decode($data[0]['gamedata'], TRUE);

	// analyze gamedata to determine what phase we go to

	switch ($_SESSION['auth']['current_step']) {
		case 2:
			mmf_goto('purchase-stats.php');
			break;
		case 3:
			mmf_goto('watch-football.php');
			break;
		default:
			mmf_goto('team-auction.php');
			break;
	}