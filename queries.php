<?php
require "connection.php";

//Insert in database
function insertName($name){
                            $con=Connect();
                			if(!$con){
							        	die("can not connect ".mysql_error());
								     }
							$sql="INSERT INTO homework_table (name) VALUES('$name')";
							mysqli_query($con,$sql);
							mysqli_close($con);
							}
//query in database
function showName(){
					$con2=Connect();
					if(!$con2){
						        die("can not connect ".mysql_error());
						      }

					$sql2="SELECT name FROM homework_table";
					$query_name=mysqli_query($con2,$sql2);
					mysqli_close($con2);
					return $query_name;
                   }
?>