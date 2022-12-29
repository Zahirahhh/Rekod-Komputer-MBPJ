<!DOCTYPE html>
<html>
	<head>
		<style>
		table,td
		{
			border: 1px solid black;
			border-collapse: collapse;
		}
		td
		{
			padding: 5px;
		}
		</style>
	</head>
	<body>
		<h1> Submitted Surveys </h1>
		
	<?php
		include "db_connect.php";
		
		//sql command
		$sql = "SELECT *
				FROM users";
		//send sql command to mysql 
		$sendsql = mysqli_query($connect,$sql);
		
		if($sendsql)
		{
			echo "<table>
				<tr>
					<th>Student ID </th>
					<th>Full Name</th>
					<th>Prefered Reference</th>
					<th>Prefered Local Server</th>
				</tr>";
			//looping to get data from each row
			foreach ($sendsql as $row)
			{
				echo "<tr>";
					echo "<td>" . $row["StudId"] . "</td>";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td>" . $row["email"] . "</td>";
					echo "<td>" . $row["phone"] . "</td>";
					echo "<td>" . $row["ref"] . "</td>";
					echo "<td>" . $row["server"] . "</td>";
				echo "</tr>";
			}
			
			echo "</table>";
		}
		else
			echo "Query failed!";
	?>
	</body>
</html>

					
				
		