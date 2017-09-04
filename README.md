# How to insert data into MySQL and show it with PHP 
### Best Practices with PHP and MySQL 
We are going to create 5 files:

index: It has the html code

action: It has the function to insert the data

connection: It has the code to access the databases

queries: It has the functions to insert and show the data

validation: It has the functions to validate the values

index.php:

```html

<html>
<head>
	<title>Homework</title>
    <meta name="author" content="Jeisson Rueda">
</head>
<body>
	
<h4>Welcome to the homework</h4>
<form action="action.php" method="POST">
<input type="text" name="cadena" placeholder="name"></input>
<input type="submit" name="submit" value="submit">
</form>
</body>
<?php

require "queries.php";
//show names through the table
$name=showName();

$rows=$name->num_rows;
for($i=0 ; $i<$rows ; ++$i){
	$row=$name->fetch_array(MYSQLI_ASSOC);
?>
	<table><tr>
		   <td>name:</td>
	       <td><?php echo $row['name']; ?></td>
	       </tr>
	</table>

<?php
}

?>
</html>
```

action.php:

```
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
```
connection.php

```
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
```
queries.php

```
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
```

validation.php

```
<?php

function cleanInput($input) {
   $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Remove javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Remove HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Remove css tags
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Remove multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }
 
 function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}
```
