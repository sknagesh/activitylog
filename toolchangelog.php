<?php
include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());

//print_r($_POST);

$reptype=$_POST['reptype'];

if($reptype=="drgno")
{
$Drawing_ID=$_POST['Drawing_NO'];
$Operation_NO=$_POST['Operation_NO'];
$query="SELECT Machine_Name, comp.Drawing_NO,Component_Name,Operation_Desc, Tool_Name, Tool_Dia, Change_Date_Time, Remarks from Machine as ma "; 
$query.="INNER JOIN ToolLog as tl ON ma.Machine_ID=tl.Machine_ID ";
$query.="INNER JOIN Component as comp ON comp.Drawing_ID=tl.Drawing_ID ";
$query.="INNER JOIN Operation as op ON op.Operation_NO=tl.Operation_NO ";
$query.="WHERE tl.Drawing_ID='$Drawing_ID' and tl.Operation_NO='$Operation_NO' ORDER by Change_Date_Time desc;";
//print("<br>Query is '$query'");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
if(mysql_num_rows($res)==0)

{
	print("No Records for The Drawing No and Operation Combination");
	bottomlink();
	exit;
}
	
	print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
	printf('<tr><th>Machine</th><th>Drawing No</th><th>Component Name</th><th>Operation Desc</th>');
	printf('<th>Tool Disc</th><th>Tool Dia</th><th>Change Date & Time</th><th>Remarks</th></tr><tbody>');
	while ($row = mysql_fetch_assoc($res))
		{
	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><tr>',	$row['Machine_Name'], $row['Drawing_NO'], $row['Component_Name'], $row['Operation_Desc'],$row['Tool_Name'],$row['Tool_Dia'],$row['Change_Date_Time'],$row['Remarks']);
		}
	printf('</table>');
	bottomlink();
}

else if($reptype=="emtype")
{
$ToolType=$_POST['ToolType'];

$query="SELECT Machine_Name, comp.Drawing_NO,Component_Name,Operation_Desc, Tool_Name, Tool_Dia,Change_Date_Time, Remarks from Machine as ma "; 
$query.="INNER JOIN ToolLog as tl ON ma.Machine_ID=tl.Machine_ID ";
$query.="INNER JOIN Component as comp ON comp.Drawing_ID=tl.Drawing_ID ";
$query.="INNER JOIN Operation as op ON op.Operation_NO=tl.Operation_NO ";
$query.="WHERE tl.Tool_Type_ID='$ToolType' ORDER by Change_Date_Time desc;";
//print("<br>Query is '$query'");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
if(mysql_num_rows($res)==0)

{
	print("No Records for The Selected tool Type");
	bottomlink();
	exit;
}
	
	print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
	printf('<tr><th>Machine</th><th>Drawing No</th><th>Component Name</th><th>Operation Desc</th>');
	printf('<th>Tool Disc</th><th>Tool Dia</th><th>Change Date & Time</th><th>Remarks</th></tr><tbody>');
	while ($row = mysql_fetch_assoc($res))
		{
	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><tr>',	$row['Machine_Name'], $row['Drawing_NO'], $row['Component_Name'], $row['Operation_Desc'],$row['Tool_Name'],$row['Tool_Dia'],$row['Change_Date_Time'],$row['Remarks']);
		}
	printf('</table>');
	bottomlink();
}

else if($reptype=="tdia")
{
	$ToolDia=$_POST['ToolDia'];

	$query="SELECT Machine_Name, comp.Drawing_NO,Component_Name,Operation_Desc, Tool_Name, Tool_Dia,Change_Date_Time, Remarks from Machine as ma "; 
	$query.="INNER JOIN ToolLog as tl ON ma.Machine_ID=tl.Machine_ID ";
	$query.="INNER JOIN Component as comp ON comp.Drawing_ID=tl.Drawing_ID ";
	$query.="INNER JOIN Operation as op ON op.Operation_NO=tl.Operation_NO ";
	$query.="WHERE tl.Tool_Dia=$ToolDia ORDER by Change_Date_Time desc;";
	//print("<br>Query is '$query'");
	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	if(mysql_num_rows($res)==0)

	{
		print("No Records for The Selected Tool Diameter");
		bottomlink();
		exit;
	}
	
	print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
	printf('<tr><th>Machine</th><th>Drawing No</th><th>Component Name</th><th>Operation Desc</th>');
	printf('<th>Tool Disc</th><th>Tool Dia</th><th>Change Date & Time</th><th>Remarks</th></tr><tbody>');
	while ($row = mysql_fetch_assoc($res))
		{
	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><tr>',	$row['Machine_Name'], $row['Drawing_NO'], $row['Component_Name'], $row['Operation_Desc'],$row['Tool_Name'],$row['Tool_Dia'],$row['Change_Date_Time'],$row['Remarks']);
		}
	printf('</table>');
	bottomlink();
}

else if($reptype=="dates")
{
$cStartDate=$_POST['StartDate'];
$cEndDate=$_POST['EndDate'];

$StartDate=change_date_format_for_db($cStartDate);
$EndDate=change_date_format_for_db($cEndDate);

$query="SELECT Machine_Name, comp.Drawing_NO,Component_Name,Operation_Desc, Tool_Name, Tool_Dia,Change_Date_Time, Remarks from Machine as ma "; 
$query.="INNER JOIN ToolLog as tl ON ma.Machine_ID=tl.Machine_ID ";
$query.="INNER JOIN Component as comp ON comp.Drawing_ID=tl.Drawing_ID ";
$query.="INNER JOIN Operation as op ON op.Operation_NO=tl.Operation_NO ";
$query.="WHERE tl.Change_Date_Time>='$StartDate' and tl.Change_Date_Time<='$EndDate' ORDER by Change_Date_Time desc;";
//print("<br>Query is '$query'");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
if(mysql_num_rows($res)==0)

{
	print("No Records for The Selected Tool Diameter");
	bottomlink();
	exit;
}
	
	print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
	printf('<tr><th>Machine</th><th>Drawing No</th><th>Component Name</th><th>Operation Desc</th>');
	printf('<th>Tool Disc</th><th>Tool Dia</th><th>Change Date & Time</th><th>Remarks</th></tr><tbody>');
	while ($row = mysql_fetch_assoc($res))
		{
	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><tr>',	$row['Machine_Name'], $row['Drawing_NO'], $row['Component_Name'], $row['Operation_Desc'],$row['Tool_Name'],$row['Tool_Dia'],$row['Change_Date_Time'],$row['Remarks']);
		}
	printf('</table>');
bottomlink();
}


?>