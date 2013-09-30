<?php

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
		return md5('testing by christian manalansan');

		// TODO: use memcache to get/set the system salt. Should be different for each installation
/*
		$memcache_obj = new Memcache;
		$memcache_obj->connect('memcache_host', 11211);

		if (!($salt = $memcache_obj->get('system_salt'))) {
			$qry = "
				SELECT id
				FROM users
				ORDER BY date_created ASC
				LIMIT 1
			";
			$data = q($qry);

			if (count($data) != 1) { // no users created, this will be the first!
				$salt = md5('user' . $date_created);
			} else {
				$salt = $data[0]['id'];
			}
			$memcache_obj->set('system_salt', $salt);
		}
		return $salt;
*/
	}