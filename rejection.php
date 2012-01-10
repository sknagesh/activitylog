<?php
include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());

//print_r($_POST);

$cStartDate=$_POST['StartDate'];
$cEndDate=$_POST['EndDate'];

$StartDate=change_date_format_for_db($cStartDate);
$EndDate=change_date_format_for_db($cEndDate);


$query="SELECT Machine_Name, comp.Drawing_NO, Operation_Desc, Operator_Name, Start_Date_Time, Remarks FROM ";
$query.=" Rejection as rej INNER JOIN Machine as ma on ma.Machine_ID=rej.Machine_ID ";
$query.=" INNER JOIN Operator as op on op.Operator_ID=rej.Operator_ID ";
$query.=" INNER JOIN Component as comp ON comp.Drawing_ID=rej.Drawing_ID ";
$query.=" INNER JOIN Operation as ope ON ope.Operation_NO=rej.Operation_NO ";
$query.=" WHERE Start_Date_Time>='$StartDate' AND Start_Date_Time<='$EndDate';";

print("<h1>Rejection Report Between $StartDate and $EndDate");
//print("<br>Query is '$query'");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
if(mysql_num_rows($res)==0)

{
	print("No Rejections In Selected Time Period");
	bottomlink();
	break;
}
	
	print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
	printf('<tr><th>Machine</th><th>Date & Time</th><th>Drawing No</th><th>Operation NO</th><th>Operator Name</th><th>Remarks</th>');
	while ($row = mysql_fetch_assoc($res))
		{
	print("<tr><td>$row[Machine_Name]</td><td>$row[Start_Date_Time]</td><td>$row[Drawing_NO]</td><td>$row[Operation_Desc]</td><td>$row[Operator_Name]</td><td>$row[Remarks]</td>");
		}
	printf('</table>');
	
bottomlink();

?>