# best-practices
Best Practices with PHP and MySQL
'''html

<html>
<head>
	<title>Homework</title>
    <meta name="author" content="Jeisson Rueda">
</head>
<body>
	<h2>PlusThis</h2>
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
'''
