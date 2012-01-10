function showMachineActivitySelect () {


	<?php    
	print("<form action=\"mainForm.php\" method=\"post\" enctype = \"multipart/form-data\">\n");

	print("<table>");
	print("<br><br>");

	print("<td>Machine</td>");
	print("<td><select name=\"Machine_ID\">");


	$query = "SELECT * FROM Machine;";


	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));


	while ($row = mysql_fetch_assoc($res))
		{
			echo "<option value=".$row[Machine_ID].">";
			echo "$row[Machine_Name]</option>";
 		}

	print("<td>Activity</td>");
	print("<td><select name=\"Activity_ID\">");

	$query = "SELECT * FROM Activity;";
	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	while ($row = mysql_fetch_assoc($res))
		{
			echo "<option value=".$row[Activity_ID].">";
			echo "$row[Activity_Name]</option>";
 		}
	print("</select></td>");
	print("</table>");
	print("<input type=\"submit\" name=\"submit\" value=\"Submit\"/>");
	print("</form>");
  	?>
}



