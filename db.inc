<?php
	session_start();

	function q($qry) {
		$con = mysqli_connect("localhost","root","root","mm_football");
		
		// Check connection
			if (mysqli_connect_errno()) {
	  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  		}

		$result = mysqli_query($con, $qry);

		$data = array();
		while($row = mysqli_fetch_assoc($result)) {
	  		$data[] = $row;
	  	}

		mysqli_close($con);
		return $data;
	}

	function get_salt() {
		// TODO: dynamically generate the salt as the user_id of the oldest user in the system
		// TODO: use memcache to get/set the system salt.

		return md5('testing by christian manalansan');
	}

	function show_status() {
		$out = '';
		if (count($_SESSION['mmf_success']) > 0) {
			$out .= '<div class="status success">';
			foreach($_SESSION['mmf_success'] as $value) {
				$out .= '<p>' . $value . '</p>';
			}
			$out .= '</div>';
		}
		if (count($_SESSION['mmf_error']) > 0) {
			$out .= '<div class="status error">';
			foreach($_SESSION['mmf_error'] as $value) {
				$out .= '<p>' . $value . '</p>';
			}
			$out .= '</div>';
		}
		
		$_SESSION['mmf_success'] = array();
		$_SESSION['mmf_error'] = array();

		return $out;
	}

	function mmf_goto($page = '') {
		$host = $_SERVER['HTTP_HOST'];
		header("Location: http://" . $host . "/" . $page);
		exit();
	}

	function check_auth() {
		if (!isset($_SESSION['auth'])) {
			$_SESSION['mmf_error'][] = 'Cannot detect who is logged in, sending user back to home page.';
			mmf_goto();
		}
	}

	function ordinal($number) {
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if (($number %100) >= 11 && ($number%100) <= 13)
		   $abbreviation = $number. 'th';
		else
		   $abbreviation = $number. $ends[$number % 10];

		return $abbreviation;
	}