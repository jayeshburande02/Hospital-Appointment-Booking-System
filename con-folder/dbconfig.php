<?php

			$servername="localhost";
			$username="root";
			$password="";
			$dbname="stqa2";


			$conn=mysqli_connect($servername,$username,$password,$dbname);

			if(!$conn)
			{
				die('Failed to Connect Database : '.mysqli_connect_error());
			}
			

?>