<?php
function time_bw_dates_and_prod_type($sdate,$edate,$ptype,$mcno,$cxn)
{
	
	$query="SELECT SEC_TO_TIME(SUM(totalprodtime)) as phours FROM (SELECT Machine_Name, Prod_Type,Start_Date_time, End_Date_Time, ";
	$query.="Time_TO_SEC(TIMEDIFF(End_Date_Time,Start_Date_Time)) as totalprodtime ";
	$query.="FROM Machine as ma INNER JOIN production as prod ON prod.Machine_ID=ma.Machine_ID ";
	$query.="WHERE prod.Start_Date_Time >='$sdate' AND prod.Start_Date_Time<='$edate' AND prod.Prod_Type='$ptype' AND prod.Machine_ID='$mcno') as phours;";
	
//	print("<br>Query in function is <br>'$query'");
	
	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	
	while ($row = mysql_fetch_assoc($res))
		{
		$lptime=$row['phours'];
		}

	return $lptime;
	
	
}

function time_bw_dates_and_prod_type_and_cust($sdate,$edate,$ptype,$mcno,$cust,$cxn)
{
	
	$query="SELECT SEC_TO_TIME(SUM(totalprodtime)) as phours FROM (SELECT Machine_Name, Prod_Type,Start_Date_time, End_Date_Time, ";
	$query.="Time_TO_SEC(TIMEDIFF(End_Date_Time,Start_Date_Time)) as totalprodtime , cust.Customer_ID, comp.Drawing_ID ";
	$query.="FROM Machine as ma INNER JOIN production as prod ON prod.Machine_ID=ma.Machine_ID ";
	$query.="INNER JOIN Component as comp ON comp.Drawing_ID=prod.Drawing_ID ";
	$query.="INNER JOIN Customer as cust ON cust.Customer_ID=comp.Customer_ID ";
	$query.="WHERE prod.Start_Date_Time >='$sdate' AND prod.Start_Date_Time<='$edate' AND prod.Prod_Type='$ptype' AND prod.Machine_ID='$mcno' AND cust.Customer_ID='$cust') as phours;";
	
//	print("<br>Query in function is <br>'$query'");
	
	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	
	while ($row = mysql_fetch_assoc($res))
		{
		$lptime=$row['phours'];
		}
	return $lptime;
	
	
}



function time_bw_dates_and_maint_type($sdate,$edate,$mtype,$mcno,$cxn)
{
	
	$query="SELECT SEC_TO_TIME(SUM(totalprodtime)) as phours FROM (SELECT Machine_Name, Maintenance_Type,Start_Date_time, End_Date_Time, ";
	$query.="Time_TO_SEC(TIMEDIFF(End_Date_Time,Start_Date_Time)) as totalprodtime FROM Machine as ma ";
	$query.="INNER JOIN Maintenance as maint ON maint.Machine_ID=ma.Machine_ID ";
	$query.="WHERE maint.Start_Date_Time >='$sdate' AND maint.Start_Date_Time<='$edate' AND maint.Maintenance_Type='$mtype' AND maint.Machine_ID='$mcno' ) as phours;";

//	print("<br>Query in function is <br>'$query'");
	
	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	
	while ($row = mysql_fetch_assoc($res))
		{
		$lptime=$row['phours'];
		}
	return $lptime;
	
	
}


function bottomlink()
{
print("<table border=\"1\" width = \"80%\" cellspacing=\"10\">");
print("<tr><td align=\"Center\"><a href=\"mainForm.php\">Submit New Reports</a> </td><td align=\"Center\"><a href=\"reports.html\">View Reports</a> </td><td align=\"Center\"><a href=\"AddPart.php\">Add New Part</a> </td><td align=\"Center\"><a href=\"AddOperation.php\">Add Operations to Part</a> </td></tr>");
print("</table>");
}



?>