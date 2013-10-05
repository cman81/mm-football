<?php
	session_start();

	function load_balances() {
		$balances = $_SESSION['auth']['gamedata']['balances'];

		if (count($balances) == 0) { // if no balances, then we are starting a new game!
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
		$teams = $_SESSION['auth']['gamedata']['teams'];

		if (count($teams) == 0) {
			// shuffle the top half of the deck
				shuffle_teams();
			// repeat until n+1 slots are filled (i.e.: 4 players = 5 teams)
				while(count($teams) <= count($_SESSION['auth']['gamedata']['balances'])) {
					// draw a team, check if they are valid (not BYE, not Thursday/Monday based on setting, etc.)
						if (validate_team($this_team = draw_team())) {
							$teams[] = build_game($this_team);
						}
				}

			$_SESSION['auth']['gamedata']['teams'] = $teams;
			set_gamedata();
		}
		

		return $teams;
	}

	function get_team_deck() {
		$deck = $_SESSION['auth']['gamedata']['team_deck'];

		if (count($deck) == 0) { // initialize deck!
			$deck = array(
				array(
					'abbr' => 'ARI',
					'name' => 'Cardinals',
				),
				array(
					'abbr' => 'ATL',
					'name' => 'Falcons'
				),
				array(
					'abbr' => 'BAL',
					'name' => 'Ravens'
				),
				array(
					'abbr' => 'BUF',
					'name' => 'Bills'
				),
				array(
					'abbr' => 'CAR',
					'name' => 'Panthers'
				),
				array(
					'abbr' => 'CHI',
					'name' => 'Bears'
				),
				array(
					'abbr' => 'CIN',
					'name' => 'Bengals'
				),
				array(
					'abbr' => 'CLE',
					'name' => 'Browns'
				),
				array(
					'abbr' => 'DAL',
					'name' => 'Cowboys'
				),
				array(
					'abbr' => 'DEN',
					'name' => 'Broncos'
				),
				array(
					'abbr' => 'DET',
					'name' => 'Lions'
				),
				array(
					'abbr' => 'GB',
					'name' => 'Packers'
				),
				array(
					'abbr' => 'HOU',
					'name' => 'Texans'
				),
				array(
					'abbr' => 'IND',
					'name' => 'Colts'
				),
				array(
					'abbr' => 'JAC',
					'name' => 'Jaguars'
				),
				array(
					'abbr' => 'KC',
					'name' => 'Chiefs'
				),
				array(
					'abbr' => 'MIA',
					'name' => 'Dolphins'
				),
				array(
					'abbr' => 'MIN',
					'name' => 'Vikings'
				),
				array(
					'abbr' => 'NE',
					'name' => 'Patriots'
				),
				array(
					'abbr' => 'NO',
					'name' => 'Saints'
				),
				array(
					'abbr' => 'NYG',
					'name' => 'Giants'
				),
				array(
					'abbr' => 'NYJ',
					'name' => 'Jets'
				),
				array(
					'abbr' => 'OAK',
					'name' => 'Raiders'
				),
				array(
					'abbr' => 'PHI',
					'name' => 'Eagles'
				),
				array(
					'abbr' => 'PIT',
					'name' => 'Steelers'
				),
				array(
					'abbr' => 'SD',
					'name' => 'Chargers'
				),
				array(
					'abbr' => 'SEA',
					'name' => 'Seahawks'
				),
				array(
					'abbr' => 'SF',
					'name' => '49ers'
				),
				array(
					'abbr' => 'STL',
					'name' => 'Rams'
				),
				array(
					'abbr' => 'TB',
					'name' => 'Bucs'
				),
				array(
					'abbr' => 'TEN',
					'name' => 'Titans'
				),
				array(
					'abbr' => 'WAS',
					'name' => 'Redskins'
				),
			);
			shuffle($deck);
		}

		$_SESSION['auth']['gamedata']['team_deck'] = $deck;

		return $deck;
	}

	function shuffle_teams() { // shuffle the top half of the deck
		$deck = get_team_deck();
		$deck_parts = array_chunk($deck, 16); // cut the deck
		shuffle($deck_parts[0]);
		$deck = array_merge($deck_parts[0], $deck_parts[1]); // reassemble
		$_SESSION['auth']['gamedata']['team_deck'] = $deck;

		return $deck;
	}

	function draw_team() {
		$deck = get_team_deck();
		$selected_team = array_shift($deck);
		$deck = array_merge($deck, array($selected_team));
		$_SESSION['auth']['gamedata']['team_deck'] = $deck;

		return $selected_team;
	}

	function validate_team($team) {
		// TODO: make this work for leagues that want to include Thursday and Monday games too
		// TODO: make this work if we are running this function on a Sunday (get the following week)
		// find the upcoming sunday games
			$schedule = json_decode(file_get_contents('schedules/nfl_schedule_2013.json'), TRUE);
			foreach ($schedule as $key => $value) {
				if (strtotime($value['game_days'][($key > 14) ? 0 : 1]['date']) > time()) {
					$key_to_use = $key;
					break;
				}
			}

		// are they playing that day?
			$is_found = FALSE;
			foreach ($schedule[$key_to_use]['game_days'][($key > 14) ? 0 : 1]['matches'] as $key => $value) {
				if (strtoupper($value['away']['abbr']) == strtoupper($team['abbr'])) {
					$is_found = TRUE;
					break;
				}
				if (strtoupper($value['home']['abbr']) == strtoupper($team['abbr'])) {
					$is_found = TRUE;
					break;
				}
			}
		return $is_found;
	}

	function build_game($team) { // TODO: complete this stub
		return array(
			'team_abbr' => $team['abbr'],
			'team_name' => $team['name'],
			'team_record' => '(6-0)',
			'is_team_home' => TRUE,
			'opp_name' => 'Texans',
			'opp_record' => '(4-2)',
		);
	}
