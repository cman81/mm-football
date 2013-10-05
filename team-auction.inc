<?php
	session_start();

	function load_balances() {
		return array(
			array(
				'rank' => 1,
				'email' => 'mmagpayo@gmail.com',
				'team_name' => 'Pip\'s Revenge',
				'balance' => 169
			),
			array(
				'rank' => 2,
				'email' => 'cmanalansan@gmail.com',
				'team_name' => 'Mark\'s Yoda',
				'balance' => 100
			),
			array(
				'rank' => 3,
				'email' => 'amanalansan@gmail.com',
				'team_name' => 'What Would Alan Do?',
				'balance' => 88
			),
			array(
				'rank' => 4,
				'email' => 'askpauld@gmail.com',
				'team_name' => 'Ask Paul D',
				'balance' => 43
			),
		);
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
