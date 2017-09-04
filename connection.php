<?php
//connect with database
function Connect(){
	
					$server="localhost";
					$user="root";
					$pass="";
					$base="homework_table";
					
					$mysqli = new mysqli("$server", "$user", "$pass", "$base");
					if(!$mysqli){
					 			echo "can not connect ".mysql_error();
					            }
					return $mysqli;
}