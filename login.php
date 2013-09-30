<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require_once($root . '/includes/db.inc');
	header('Content-type: application/json');

	$email = $_POST['email'];
	$league_id = $_POST['league'];
	$locker_combo = $_POST['locker']; // TODO: this is not very secure, can we pass the MD5 directly?

// testing only
/*
$email = $_GET['email'];
$league_name = $_GET['league'];
$locker_combo = $_GET['locker'];	
*/

	if ($email == '') {
		exit(json_encode(array(
			'status' => 'error',
			'reason' => 'blank email',
		)));
	}
	if ($league_name == '') {
		exit(json_encode(array(
			'status' => 'error',
			'reason' => 'blank league',
		)));
	}
	if ($locker_combo == '') {
		exit(json_encode(array(
			'status' => 'error',
			'reason' => 'blank locker',
		)));
	}

	// Build locker MD5
		$salt = get_salt();
		$locker_md5 = md5($locker_combo . $salt);

	$qry = "
		SELECT l.gamedata, ulm.turndata
		FROM leagues l
		INNER JOIN user_league_map ulm ON ulm.league_id = l.id
		INNER JOIN users u ON u.id = ulm.user_id
		WHERE u.email = '" . $email . "'
		AND u.locker_md5 = '" . $locker_md5 . "'
		AND l.id = '" . $league_id . "'
	";
	$data = q($qry);

	if (count($data) != 1) {
		exit(json_encode(array(
			'status' => 'error',
			'reason' => 'login not successful'
		)));
	}

	exit(json_encode(array(
		'status' => 'success',
		'data' => $data[0],
	)));
