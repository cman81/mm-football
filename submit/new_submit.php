<?php
	session_start();
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require_once($root . '/db.inc');

	$email = trim($_POST['email']);
	$password_clear = trim($_POST['password']);
	$password_md5 = md5($password_clear . get_salt());
	$franchise = trim($_POST['franchise']);
	$league_id = trim($_POST['league_id']);
	$new_league = trim($_POST['new_league']);
	$new_league_launch = trim($_POST['new_league_launch']);
	$is_auth = FALSE;
	$is_valid = TRUE;

	// basic validation
		if ($email == '') {
			$_SESSION['mmf_error'][] = 'Email cannot be blank.';
			$is_valid = FALSE;
		}
		if ($password_clear == '') {
			$_SESSION['mmf_error'][] = 'Password cannot be blank.';
			$is_valid = FALSE;
		}
		if ($franchise == '') {
			$_SESSION['mmf_error'][] = 'Franchise cannot be blank.';
			$is_valid = FALSE;
		}
		if ($league_id == '~NEW~') {
			if ($new_league == '') {
				$_SESSION['mmf_error'][] = 'New league cannot be blank.';
				$is_valid = FALSE;
			} elseif ($new_league == '~NEW~') {
				$_SESSION['mmf_error'][] = 'Invalid league name.';	
				$is_valid = FALSE;
			}
		}
		if (!$is_valid) {
			mmf_goto('new.php');
		}

	// are we creating a new user or authenticating an existing user?
		$qry = "
			SELECT email, enc_pass
			FROM users
			WHERE email = '" . $email . "'
		";
		$data = q($qry);
		if (count($data) == 0) { // new user
			$qry = "
				INSERT INTO users (email, enc_pass, date_created, is_verified, verify_stamp)
				VALUES (
					'" . $email . "',
					'" . $password_md5 . "',
					'" . date('Y-m-d H:i:s') . "',
					1,
					'" . md5(rand() . uniqid()) . "'
				)
			";
			q($qry);

			// TODO: send email to this user to verify account creation (for now, we are ENABLING accounts by default)

			$is_auth = TRUE;
			$_SESSION['mmf_success'][] = 'New user "' . $email . '" created.';
		} else { // existing user
			if ($data[0]['enc_pass'] == $password_md5) {
				$is_auth = TRUE;
			} else {
				$_SESSION['mmf_error'][] = 'User already exists and your password does not match.';
				mmf_goto('new.php');
			}

		}

	// are we creating a new league or mapping a user to an existing league?
		if ($league_id == '~NEW~') { // new league, does this league name already exist?
			$qry = "
				SELECT name
				FROM leagues
				WHERE name = '" . $new_league . "'
			";
			$data = q($qry);
			if (count($data) > 0) {
				$_SESSION['mmf_error'][] = 'A league with this name already exists.';
				mmf_goto('new.php');
			}
			// create the league
				$qry = sprintf(
					"
						INSERT INTO leagues (name, launch_date)
						VALUES ('%s', '%s')
					",
					mysql_real_escape_string($new_league),
					mysql_real_escape_string($new_league_launch)
				);
				q($qry);
				$league_id = $new_league;
				$_SESSION['mmf_success'][] = 'New league "' . $league_id . '" created.';
		} else {
			// does this user already exist in this league?
				$qry = "
					SELECT user_id, league_id
					FROM user_league_map
					WHERE user_id = '" . $email . "'
					AND league_id = '" . $league_id . "'
				";
				$data = q($qry);
				if (count($data) > 0) {
					$_SESSION['mmf_error'][] = 'This user is already a member of this league.';
					mmf_goto('new.php');
				}
			// does this franchise name already exist?
				$qry = sprintf(
					"
						SELECT franchise_name, league_id
						FROM user_league_map
						WHERE franchise_name = '%s'
						AND league_id = '%s'
					",
					mysql_real_escape_string($franchise),
					mysql_real_escape_string($league_id)
				);
				$data = q($qry);
				if (count($data) > 0) {
					$_SESSION['mmf_error'][] = 'Someone already beat you to this franchise name.';
					mmf_goto('new.php');
				}
		}
		
		// map this user to this league
			$qry = sprintf(
				"
					INSERT INTO user_league_map (id, user_id, league_id, franchise_name)
					VALUES ('%s', '%s', '%s', '%s')
				",
				mysql_real_escape_string(uniqid()),
				mysql_real_escape_string($email),
				mysql_real_escape_string($league_id),
				mysql_real_escape_string($franchise)
			);
			q($qry);
			$_SESSION['mmf_success'][] = '"' . $franchise . '" has been added to league "' . $league_id . '."';

	// send user to login page
		$host = $_SERVER['HTTP_HOST'];
		header("Location: http://" . $host);