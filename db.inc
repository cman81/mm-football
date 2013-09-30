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
		// TODO: dynamically generate the salt as the user_id of the oldest user in the system
		// TODO: use memcache to get/set the system salt.

		return md5('testing by christian manalansan');
	}