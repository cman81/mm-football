<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require_once($root . '/includes/db.inc');
	header('Content-type: application/json');
	$date_created = date('Y-m-d H:i:s');

	// Check for blank email
		$email = $_GET['email'];
		if ($email == '') {
			exit(json_encode(array(
				'status' => 'error',
				'reason' => 'blank email',
			)));
		}
		$qry = "
			SELECT id
			FROM users
			WHERE email = '" . $email . "'
		";
		$data = q($qry);
		if (count($data) > 0) {
			exit(json_encode(array(
				'status' => 'error',
				'reason' => 'email already exists',
			)));
		}

	// Get the proper league
		$league_name = $_GET['league'];
		if ($league_name == '') {
			exit(json_encode(array(
				'status' => 'error',
				'reason' => 'blank league',
			)));
		}
		$qry = "
			SELECT id
			FROM leagues
			WHERE name = '" . $league_name . "'
		";
		$data = q($qry);

		if (count($data) != 1) { // no league found, create it!
			$league_id = md5('league' . $date_created);
			$qry = "
				INSERT INTO leagues (id, name)
				VALUES ('" . $league_id . "', '" . $league_name . "')
			";
			q($qry);
		} else {
			$league_id = $data[0]['id'];
		}

	// setup the password salt
		$salt = get_salt();

	// setup the password
		$locker_combo = $_GET['locker'];
		if ($locker_combo == '') {
			exit(json_encode(array(
				'status' => 'error',
				'reason' => 'blank locker',
			)));
		}
		$locker_md5 = md5($locker_combo . $salt);

	// insert the record
		$user_id = md5('user' . $date_created);
		$qry = "
			INSERT INTO users (id, email, locker_md5, date_created)
			VALUES ('" . $user_id . "', '" . $email . "', '" . $locker_md5 . "', '" . $date_created . "')
		";
		q($qry);

		$map_id = md5('map' . $date_created);
		$qry = "
			INSERT INTO user_league_map (id, user_id, league_id)
			VALUES ('" . $map_id . "', '" . $user_id . "', '" . $league_id . "')
		";
		q($qry);
		exit(json_encode(array(
			'status' => 'success',
			'return' => array(
				'id' => $user_id,
				'email' => $email,
				'locker_md5' => $locker_md5,
				'date_created' => $date_created,
				'league' => $league_name,
			)
		)));