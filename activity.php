<?php    
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());
$Machine_ID=$_POST['machine'];
$Activity_ID=$_POST['activity'];


if($Activity_ID==6 && $Machine_ID!=8)
{
print("Please go back and Select \"All Machines\" to Report Power Failure");
$Activity_ID=20;
}

if($Activity_ID!=6 && $Machine_ID==8)
{
print("Please select All Machines only to report Power Failure, <br> For other reports Please select correct Machine Name");
$Activity_ID=20;
}

$q="SELECT Machine_Name FROM Machine WHERE Machine_ID='$Machine_ID';";

$r = mysql_query($q, $cxn) or die(mysql_error($cxn));
		while ($ro = mysql_fetch_assoc($r))
		{
$Machine_Name=$ro['Machine_Name'];
 		}

		print("<script src=\"AjaxCode.js\"></script>");
#print("Machine selected is '$Machine_ID' and activity is '$Activity_ID'");

if($Activity_ID==1) //production
{
		print("<h2 align=Center>Production Report For $Machine_Name</h2>");
		print("<form name=\"activity\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<td><input type=\"hidden\" name=\"Machine_ID\" value='$Machine_ID'/></td>");		
		print("<td><input type=\"hidden\" name=\"Activity_ID\" value='$Activity_ID'/></td>");
		print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
		print("<tr>");	
		print("<td>Customer</td>");		
		print("<td><select name=\"Customer_ID\" id=\"Customer_ID\"onClick=\"return CustomerListOnChange()\">");
		$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Customer_ID'].">";
		echo "$row[Customer_Name]</option>";
 		}
		print("</select></td>");
		print("<td>");
		print("<td>Drawing No.</td>");
		print("<td><select name=\"Drawing_NO\" id=\"Drawing_NO\"onClick=\"return DrawingListOnChange()\">");
		printf('<option value=""></option>');
		print("</select></td>");
		print("<td>Operation No.</td>");
		print("<td><select name=\"Operation_NO\" id=\"Operation_NO\">");
		printf('<option value=""></option>');
		print("</select></td>");
		print("</tr>");
		print("<tr>");					
		print("<td>");
		print("Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td>");			
		print("<td>");			
		print("Start Time.</td>");
		$stm=date('h:m:A');
		print("<td><input type=\"Text\" name=\"StartTime\" value='$stm'/></td>");
		print("</tr>");
		print("<tr>");					
		print("<td>");	
		print("End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'/></td>");			
		print("<td>");			
		print("End Time.</td>");
		$etm=date('h:m:A');
		print("<td><input type=\"Text\" name=\"EndTime\" value='$etm'/></td>");		
		print("</tr>");
		print("<tr>");	
		print("<td>Operator Name.</td>");
		print("<td><select name=\"Operator_ID\">");
		$querya = "SELECT * FROM Operator;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Operator_ID'].">";
		echo "$row[Operator_Name]</option>";
 		}
		print("</select></td>");
		print("<td>Program No.</td>");
		print("<td><input type=\"Text\" name=\"Program_NO\"/></td>");
		print("<td>Quantity.</td>");
		print("<td><input type=\"Text\" name=\"ProductionQty\"/></td>");
		print("</tr>");	
		print("<tr>");
		print("<td>Remarks</td>");
		print("<td><textarea cols=\"40%\" rows=\"5\" name=\"Remarks\"> </textarea></td>");
		print("<td><input type=\"radio\" name=\"prodtype\" value=\"Production\"checked /> Production</td><td><input type=\"radio\" name=\"prodtype\" value=\"Set Up\" /> Job Set Up</td> ");
		print("</tr>");
		print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
		print("<tr><td align=\"Left\"><a href=\"mainForm.php\">Submit New Report</a> </td><td align=\"Left\"><a href=\"reports.html\">View Reports</a> </td></tr>");
		print("</table>");
		
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['activity']);");
 		print("</script>");



}


else if($Activity_ID==3) //tool change
{
			print("<h2 align=Center>Tool Change Report For $Machine_Name</h2>");			
			print("<form name=\"activity\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
			print("<td><input type=\"hidden\" name=\"Machine_ID\" value='$Machine_ID'/></td>");		
			print("<td><input type=\"hidden\" name=\"Activity_ID\" value='$Activity_ID'/></td>");
			print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
			print("<tr>");	
			print("<td>Customer</td>");		
			print("<td><select name=\"Customer_ID\" id=\"Customer_ID\"onClick=\"return CustomerListOnChange()\">");
			$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
			$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
			echo "<option value=".$row['Customer_ID'].">";
			echo "$row[Customer_Name]</option>";
 			}
			print("</select></td>");
			print("<td>");
			print("<td>Drawing No.</td>");
			print("<td><select name=\"Drawing_NO\" id=\"Drawing_NO\"onClick=\"return DrawingListOnChange()\">");
			printf('<option value=""></option>');
			print("</select></td>");
			print("<td>Operation No.</td>");
			print("<td><select name=\"Operation_NO\" id=\"Operation_NO\">");
			printf('<option value=""></option>');
			print("</select></td>");
			print("</tr>");
			print("<tr>");
			print("<td>");
			print("Date.</td>");
			$sdt=date('d-m-Y');
			print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td></tr>");			
			print("<tr><td>Tool Change Time.</td>");
			$stm=date('h:m:A');
			print("<td><input type=\"Text\" name=\"StartTime\" value='$stm'/></td></tr>");
			print("<tr><td>Operator Name.</td>");
			print("<td><select name=\"Operator_ID\">");

			$querya = "SELECT * FROM Operator;";
			$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
			echo "<option value=".$row['Operator_ID'].">";
			echo "$row[Operator_Name]</option>";
 			}
			print("</select></td>");
			print("</tr>");
			print("<tr>");	
			print("<td>Tool Description.</td>");
			print("<td><input type=\"Text\" name=\"Tool_Name\"/></td></tr>");
			print("<tr><td>Tool Dia.</td>");
			print("<td><input type=\"Text\" name=\"Tool_Dia\"/></td></tr>");
			print("<tr><td>Tool Type</td>");
			print("<td><select name=\"ToolType\">");

			$querya = "SELECT * FROM ToolType;";
			$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
			echo "<option value=".$row['Tool_Type_ID'].">";
			echo "$row[ToolType]</option>";
 			}
			print("</select></td></tr>");
			print("<tr><td>New Tool ?</td>");
			print("<td><input type=\"radio\" name=\"newtool\" value=\"1\"checked /> Yes<input type=\"radio\" name=\"newtool\" value=\"0\" /> No</td> ");			
			print("</tr>");
			print("<tr><td>Remarks</td>");
			print("<td><textarea cols=\"40%\" rows=\"5\" name=\"Remarks\"> </textarea></td></tr>");
			print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
			print("<tr><td align=\"Left\"><a href=\"mainForm.php\">Submit New Report</a> </td><td align=\"Left\"><a href=\"reports.html\">View Reports</a> </td></tr>");
			print("</table>");
			print("</form>");
			print("<script language=\"JavaScript\">");
 			print("new validateForm(document.forms['activity']);");
 			print("</script>");

}

else if($Activity_ID==4) //maintenance
{
		print("<h2 align=Center>Maintenance Report For $Machine_Name</h2>");
		print("<form name=\"activity\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<td><input type=\"hidden\" name=\"Machine_ID\" value='$Machine_ID'/></td>");		
		print("<td><input type=\"hidden\" name=\"Activity_ID\" value='$Activity_ID'/></td>");
		print("<table border=\"0\" width = \"80%\" cellspacing=\"10\" >");		
		print("<tr>");	
		print("<td>");
		print("Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt' size=\"10\"/></td>");			
		print("<td>");			
		print("Start Time.</td>");
		$stm=date('h:m:A');
		print("<td><input type=\"Text\" name=\"StartTime\" value='$stm' size=\"8\"/></td>");
		print("</tr>");		
		print("<tr>");
		print("<td>");		
		print("End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'size=\"10\"/></td>");			
		print("<td>");			
		print("End Time.</td>");
		$etm=date('h:m:A');
		print("<td><input type=\"Text\" name=\"EndTime\" value='$etm' size=\"8\"/></td>");				
		print("</tr>");		
		print("<tr>");
		print("<td>Type of Maintenance</td>");
		print("<td><input type=\"radio\" name=\"maintype\" value=\"Breakdown\"checked /> Break Down Maintenance</td><td><input type=\"radio\" name=\"maintype\" value=\"Preventive\" /> Preventive Maintenance</td><td><input type=\"radio\" name=\"maintype\" value=\"Idle\" /> Machine Idle</td>");
		print("</tr>");		
		print("<tr>");
		print("<td>Operator Name.</td>");
		print("<td><select name=\"Operator_ID\">");

			$querya = "SELECT * FROM Operator;";
			$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
			echo "<option value=".$row['Operator_ID'].">";
			echo "$row[Operator_Name]</option>";
 			}
			print("</select></td>");
		
		print("<td>");
		print("Makino Engineer's Name.</td>");
		print("<td><input type=\"Text\" name=\"MakEngr\" /></td>");
		print("</tr>");
		print("<tr>");
		print("<td>Brief Description of Problem/Maintenance</td>");
		print("<td><textarea cols=\"40%\" rows=\"5\" name=\"Remarks\"> </textarea></td>");
		print("</tr>");
		print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
		print("<tr><td align=\"Left\"><a href=\"mainForm.php\">Submit New Report</a> </td><td align=\"Left\"><a href=\"reports.html\">View Reports</a> </td></tr>");		
		print("</table>");
		
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['activity']);");
 		print("</script>");

}

else if($Activity_ID==5)  //rejection report
{
		print("<h2 align=Center>Rejection Report For $Machine_Name</h2>");
		print("<form name=\"activity\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<td><input type=\"hidden\" name=\"Machine_ID\" value='$Machine_ID'/></td>");		
		print("<td><input type=\"hidden\" name=\"Activity_ID\" value='$Activity_ID'/></td>");
		print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
			print("<tr>");	
			print("<td>Customer</td>");		
			print("<td><select name=\"Customer_ID\" id=\"Customer_ID\"onClick=\"return CustomerListOnChange()\">");
			$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
			$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
			echo "<option value=".$row['Customer_ID'].">";
			echo "$row[Customer_Name]</option>";
 			}
			print("</select></td></tr>");
			print("<tr><td>Drawing No.</td>");
			print("<td><select name=\"Drawing_NO\" id=\"Drawing_NO\"onClick=\"return DrawingListOnChange()\">");
			printf('<option value=""></option>');
			print("</select></td></tr>");
			print("<tr><td>Operation No.</td>");
			print("<td><select name=\"Operation_NO\" id=\"Operation_NO\">");
			printf('<option value=""></option>');
			print("</select></td>");
			print("</tr>");
			print("<tr>");
			print("<td>Date.</td>");
			$sdt=date('d-m-Y');
			print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td>");			
			print("<td></tr>");			
			print("<tr><td>Time.</td>");
			$stm=date('h:m:A');
			print("<td><input type=\"Text\" name=\"StartTime\" value='$stm'/></td>");
		print("</tr>");
			print("<tr><td>Operator Name.</td>");
			print("<td><select name=\"Operator_ID\">");

			$querya = "SELECT * FROM Operator;";
			$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
			echo "<option value=".$row['Operator_ID'].">";
			echo "$row[Operator_Name]</option>";
 			}
			print("</select></td>");
			print("</tr>");	
			print("<tr>");
			print("<td>Remarks</td>");
			print("<td><textarea cols=\"40%\" rows=\"5\" name=\"Remarks\"> </textarea></td>");			
			print("</tr>");
			print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
			print("<tr><td align=\"Left\"><a href=\"mainForm.php\">Submit New Report</a> </td><td align=\"Left\"><a href=\"reports.html\">View Reports</a> </td></tr>");			
			print("</table>");
		
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['activity']);");
 		print("</script>");


}


else if($Activity_ID==6)//power failure
{
			print("<h2 align=Center>Power Failure Report For $Machine_Name</h2>");
			print("<form name=\"activity\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
			print("<td><input type=\"hidden\" name=\"Machine_ID\" value='$Machine_ID'/></td>");		
			print("<td><input type=\"hidden\" name=\"Activity_ID\" value='$Activity_ID'/></td>");
			print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
			print("<tr>");	
			print("<td>");
			print("Date.</td>");
			$sdt=date('d-m-Y');
			print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td>");			
			print("<td>");			
			print("Time.</td>");
			$stm=date('h:m:A');
			print("<td><input type=\"Text\" name=\"StartTime\" value='$stm'/></td>");
			print("</tr>");			
			print("<tr>");
			print("<td>");			
			print("End Date.</td>");
			$edt=date('d-m-Y');
			print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'/></td>");			
			print("<td>");			
			print("End Time.</td>");
			$etm=date('h:m:A');
			print("<td><input type=\"Text\" name=\"EndTime\" value='$etm'/></td>");			
			print("</tr>");
			print("<tr>");	
			print("<tr>");	
			print("<td>Operator Name.</td>");
			print("<td><select name=\"Operator_ID\">");

			$querya = "SELECT * FROM Operator;";
			$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
			echo "<option value=".$row['Operator_ID'].">";
			echo "$row[Operator_Name]</option>";
 			}
			print("</select></td>");
			print("</tr>");	
			print("<tr>");
			print("<td>Remarks</td>");
			print("<td><textarea cols=\"40%\" rows=\"5\" name=\"Remarks\"> </textarea></td>");			
			print("</tr>");
			print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
			print("<tr><td align=\"Left\"><a href=\"mainForm.php\">Submit New Report</a> </td><td align=\"Left\"><a href=\"reports.html\">View Reports</a> </td></tr>");
			print("</table>");
		
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['activity']);");
 		print("</script>");



}


else if($Activity_ID==7) //rework samples one of jobs
{

		print("<h2 align=Center>FAI/Sample/Rework/Fixture Report For $Machine_Name</h2>");
		print("<form name=\"activity\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<td><input type=\"hidden\" name=\"Machine_ID\" value='$Machine_ID'/></td>");		
		print("<td><input type=\"hidden\" name=\"Activity_ID\" value='$Activity_ID'/></td>");
		print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
		print("<tr><td>");
		print("Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td>");			
		print("<td>");			
		print("Start Time.</td>");
		$stm=date('h:m:A');
		print("<td><input type=\"Text\" name=\"StartTime\" value='$stm'/></td></tr>");	
		print("<tr><td>");
		print("End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'/></td><td>");			
		print("End Time.</td>");
		$etm=date('h:m:A');
		print("<td><input type=\"Text\" name=\"EndTime\" value='$etm'/></td></tr>");		
		print("<tr><td>Operation Description</td>");
		print("<td><input type=\"Text\" name=\"operationdesc\"/></td>");
		print("<tr><td>Drawing No/Component Name.</td>");
		print("<td><input type=\"Text\" name=\"Drawing_NO\" /></td></tr>");		
		print("<tr>");	
		print("<td>Operator Name.</td>");
		print("<td><select name=\"Operator_ID\">");

		$querya = "SELECT * FROM Operator;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
			while ($row = mysql_fetch_assoc($resa))
			{
				echo "<option value=".$row['Operator_ID'].">";
				echo "$row[Operator_Name]</option>";
 			}
		print("</select></td></tr>");
		print("<tr><td>Program No.</td>");
		print("<td><input type=\"Text\" name=\"Program_NO\"/></td></tr>");
		print("<tr><td>Quantity.</td>");
		print("<td><input type=\"Text\" name=\"ProductionQty\"/></td>");
		print("</tr>");	
		print("<td>Type of Work</td>");
		print("<td><input type=\"radio\" name=\"worktype\" value=\"FAI\"checked /> FAI<input type=\"radio\" name=\"worktype\" value=\"Rework\" /> Rework<input type=\"radio\" name=\"worktype\" value=\"Oneofjob\" /> One Time Job");
		print("<input type=\"radio\" name=\"worktype\" value=\"Fixture\"/> Fixture work<input type=\"radio\" name=\"worktype\" value=\"Other\" /> Other</td>");		
		print("</tr>");		
		print("<tr>");
		print("<td>Remarks</td>");
		print("<td><textarea cols=\"40%\" rows=\"5\" name=\"Remarks\"> </textarea></td>");
		print("</tr>");
		print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
		print("<tr><td align=\"Left\"><a href=\"mainForm.php\">Submit New Report</a> </td><td align=\"Left\"><a href=\"reports.html\">View Reports</a> </td></tr>");
		print("</table>");
		print("</form>");

print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['activity']);");
 		print("</script>");

}
           


?>