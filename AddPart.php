<?php    
include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());

		print("<h2 align=Center>Add New Part To Database</h2>");
		print("<form name=\"activity\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<td><input type=\"hidden\" name=\"Activity_ID\" value=\"11\"/></td>");		
		print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
		print("<tr>");	
		print("<td>Customer</td>");		
		print("<td><select name=\"Customer_ID\" id=\"Customer_ID\">");
		$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Customer_ID'].">";
		echo "$row[Customer_Name]</option>";
 		}
		print("</select></td></tr>");
		print("<tr><td>Drawing No.</td>");
		print("<td><input type=\"Text\" name=\"Drawing_NO\" /></td></tr>");			
		print("<tr><td>Component Name</td>");
		print("<td><input type=\"Text\" name=\"Component_Name\" /></td></tr>");						
		print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
		print("<tr><td align=\"Left\"><a href=\"mainForm.php\">Submit New Report</a> </td><td align=\"Left\"><a href=\"reports.html\">View Reports</a> </td></tr>");
		print("</table>");		
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['activity']);");
 		print("</script>");


bottomlink();

?>