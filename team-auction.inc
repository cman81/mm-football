<?php
	session_start();

	function load_balances() {
		$balances = $_SESSION['auth']['gamedata']['balances'];

		if (count($balances) == 0) {
			$balances = array();

			$qry = sprintf(
				"
					SELECT user_id, franchise_name
					FROM user_league_map
					WHERE league_id = '%s'
				",
				mysql_real_escape_string($_SESSION['auth']['league'])
			);
			$data = q($qry);

			foreach ($data as $value) {
				$balances[] = array(
					'email' => $value['user_id'],
					'franchise' => $value['franchise_name'],
					'balance' => 100,
				);
			}

			// randomize initial ranking
				shuffle($balances);
				foreach ($balances as $key => $value) {
					$balances[$key]['rank'] = $key + 1;
				}

				$_SESSION['auth']['gamedata']['balances'] = $balances;
				set_gamedata();
		}

		return $balances;
	}

	function load_teams() {
		return array(
			array(
				'team_abbr' => 'ATL',
				'team_name' => 'Falcons',
				'team_record' => '(4-2)',
				'is_team_home' => TRUE,
				'opp_name' => 'Bucs',
				'opp_record' => '(2-4)',
			),
			array(
				'team_abbr' => 'NE',
				'team_name' => 'Patriots',
				'team_record' => '(5-1)',
				'is_team_home' => FALSE,
				'opp_name' => 'Packers',
				'opp_record' => '(5-1)',
			),
			array(
				'team_abbr' => 'NYJ',
				'team_name' => 'Jets',
				'team_record' => '(1-5)',
				'is_team_home' => TRUE,
				'opp_name' => 'Broncos',
				'opp_record' => '(6-0)',
			),
			array(
				'team_abbr' => 'IND',
				'team_name' => 'Colts',
				'team_record' => '(5-1)',
				'is_team_home' => FALSE,
				'opp_name' => 'Dolphins',
				'opp_record' => '(2-4)',
			),
			array(
				'team_abbr' => 'SD',
				'team_name' => 'Chargers',
				'team_record' => '(6-0)',
				'is_team_home' => TRUE,
				'opp_name' => 'Texans',
				'opp_record' => '(4-2)',
			),
		);
	}
