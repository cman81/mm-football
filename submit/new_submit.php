<?php
	session_start();
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	require_once($root . '/db.inc');

	$email = $_POST['email'];
	$password_clear = $POST['password'];
	$password_md5 = md5($password_clear . get_salt());
	$league_id = $_POST['league_id'];
	$new_league = $_POST['new_league'];
	$is_auth = FALSE;

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
					'" . uniqid() . "'
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
				$host = $_SERVER['HTTP_HOST'];
				$self = $_SERVER['PHP_SELF'];
				header("Location: http://" . $host . $self);
				exit();
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
				$host = $_SERVER['HTTP_HOST'];
				$self = $_SERVER['PHP_SELF'];
				header("Location: http://" . $host . $self);
				exit();
			}
			// create the league
				$qry = "
					INSERT INTO leagues (name)
					VALUES ('" . $new_league . "')
				";
				q($qry);
				$league_id = $new_league;
				$_SESSION['mmf_success'][] = 'New league "' . $league_id . '" created.';
		} else { // does this user already exist in this league?
			$qry = "
				SELECT user_id, league_id
				FROM user_league_map
				WHERE user_id = '" . $email . "'
				AND league_id = '" . $league_id . "'
			";
			$data = q($qry);
			if (count($data) > 1) {
				$_SESSION['mmf_error'][] = 'This user is already a member of this league.';
				$host = $_SERVER['HTTP_HOST'];
				$self = $_SERVER['PHP_SELF'];
				header("Location: http://" . $host . $self);
				exit();
			}
		}
		
		// map this user to this league
			$qry = "
				INSERT INTO user_league_map (id, user_id, league_id)
				VALUES ('" . uniqid() . "', '" . $email . "', '" . $league_id . "')
			";
			q($qry);
			$_SESSION['mmf_success'][] = 'User "' . $email . '" has been added to league "' . $league_id . '".';

	// send user to login page
		$host = $_SERVER['HTTP_HOST'];
		header("Location: http://" . $host);