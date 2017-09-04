<?php

require "validation.php";
require "queries.php";
//submit validation 
if(isset($_POST['submit'])){
	                     ?>
	                      <script>
	                              //redirect to the index
	                              alert("Thank you, your name has sent");
                                  window.location.href="index.php";
                          </script>';
						
						<?php
						    //cleaning the POST	
							$input=filter_input(INPUT_POST, 'cadena', FILTER_SANITIZE_STRING);
						    $name = sanitize($input); /*$_POST['cadena']*/
						    
						    //Once we have the variable cleaned we can insert in database
						    insertName($name);
							}
	
	
?>