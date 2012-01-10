<?php    
include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());
$Report_ID=$_POST['report'];

print("<h1> Production Report For Last 14 Days</h1>");
print("<link href=\"style.css\" type=\"text/css\" rel=\"stylesheet\">");
print("<script src=\"AjaxCode.js\"></script>");
$mcno=0;
if($Report_ID==1)
{
	print("<form name=\"preport\"\n");
	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"0\" name=\"prod\" value=\"0\" /> All Machines</td>");
 	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"1\" name=\"prod\" value=\"1\" /> S56-1</td>");
 	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"2\" name=\"prod\" value=\"2\" /> S56-2</td>");
 	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"3\" name=\"prod\" value=\"3\" /> S33</td>");
 	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"4\" name=\"prod\" value=\"4\" /> S56-3</td>");
 	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"5\" name=\"prod\" value=\"5\" /> F5</td>"); 	
 	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"6\" name=\"prod\" value=\"6\" /> F3</td>");
 	print("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"7\" name=\"prod\" value=\"7\" /> Slim-3</td>");
	bottomlink();
}

else if($Report_ID==2)
{
		print("<form action=\"jobhistory.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<table>");		
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
		print("<td><select name=\"Operation_NO\" id=\"Operation_NO\"onChange=\"return OperationListOnChange()\" >");
		printf('<option value=""></option>');
		print("</select></td>");
		print("</tr>");
		print("</table>");
//		print("<input type=\"submit\" name=\"submit\" value=\"Submit\"/>");
		print("</form>");
		bottomlink();

}


else if($Report_ID==3)
{
		print("<form name=\"treport\" action=\"toolchangelog.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<table>");		
		print("<tr>");	
		
		print("<td><input type=\"radio\" onClick=\"toolreptype(document.forms['treport'])\" ID=\"1\" name=\"reptype\" value=\"drgno\" /> Log based on Drawing No</td>");
		print("</tr>");
		print("<tr>");
		print("<td>Customer</td>");		
		print("<td><select name=\"Customer_ID\" disabled=\"disabled\" id=\"Customer_ID\"onClick=\"return CustomerListOnChange()\">");
		$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Customer_ID'].">";
		echo "$row[Customer_Name]</option>";
 		}
		print("</select></td>");
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
		print("</tr>");
		print("<td><input type=\"radio\" onClick=\"toolreptype(document.forms['treport'])\" ID=\"2\"name=\"reptype\" value=\"emtype\" />Based on Tool Type</td> ");
		print("<tr><td>Tool Type</td>");
		print("<td><select name=\"ToolType\" disabled=\"disabled\" ID=\"ToolType\">");
		$querya = "SELECT * FROM ToolType;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Tool_Type_ID'].">";
		echo "$row[ToolType]</option>";
		}
		print("</select></td></tr>");
		print("<tr>");
		print("</tr>");
		print("<td><input type=\"radio\" onClick=\"toolreptype(document.forms['treport'])\" ID=\"3\"name=\"reptype\" value=\"tdia\" /> Log based on Tool Dia</td>");
		print("<tr><td>Tool Dia.</td>");
		print("<td><input type=\"Text\" name=\"ToolDia\" disabled=\"disabled\" /></td></tr>");
		print("<td><input type=\"radio\" onClick=\"toolreptype(document.forms['treport'])\" ID=\"4\"name=\"reptype\" value=\"dates\" />Between Dates</td> ");
		print("<tr>");
		print("</tr>");
		print("<tr>");					
		print("<td>");
		print("Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" disabled=\"disabled\" value='$sdt'/></td>");			
		print("<td>");	
		print("End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" disabled=\"disabled\" value='$edt'/></td>");			
		print("<td>");			
		print("</tr>");

		print("</table>");
		print("<input type=\"submit\" name=\"submit\" value=\"Submit\"/>");
		print("</form>");
bottomlink();

}



else if($Report_ID==4) //machine utilization
{
		print("<form name=\"mach\" action=\"machineutil.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<table>");			
		print("<tr><td>Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td></tr>");			
		print("<tr><td>End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'/></td></tr>");			
		print("<input type=\"submit\" name=\"submit\" value=\"Submit\"/>");
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['mach']);");
 		print("</script>");

bottomlink();
}




else if($Report_ID==5) //power failure
{
		print("<form name=\"power\" action=\"powerfailure.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<table>");		
		print("<tr>");					
		print("<td>");
		print("Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td>");			
		print("<td>");	
		print("End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'/></td>");			
		print("<td>");			
		print("</tr>");
		print("<input type=\"submit\" name=\"submit\" value=\"Submit\"/>");
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['power']);");
 		print("</script>");
bottomlink();
}

else if($Report_ID==6) //rejection report
{
		print("<form name=\"power\" action=\"rejection.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<table>");		
		print("<tr><td>");
		print("Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td>");			
		print("<td>");	
		print("End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'/></td>");			
		print("</tr>");
		print("<tr><td><input type=\"submit\" name=\"submit\" value=\"Submit\"/></td></tr>");
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['power']);");
 		print("</script>");
bottomlink();
}

else if($Report_ID==7) //rework fixture etc
{
		print("<form name=\"power\" action=\"rework.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<table>");		
		print("<tr><td>");
		print("Start Date.</td>");
		$sdt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"StartDate\" value='$sdt'/></td>");			
		print("<td>");	
		print("End Date.</td>");
		$edt=date('d-m-Y');
		print("<td><input type=\"Text\" name=\"EndDate\" value='$edt'/></td>");			
		print("</tr>");
		print("<tr><td><input type=\"submit\" name=\"submit\" value=\"Submit\"/></td></tr>");
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['power']);");
 		print("</script>");
bottomlink();
}

else
{
print("Undefined report");

bottomlink();
}
           


?>
