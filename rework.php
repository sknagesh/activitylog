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


$query="SELECT Machine_Name, Drawing_NO, Operation_NO, Operator_Name, Start_Date_Time, End_Date_Time, Quantity, TypeOfWork, Remarks,TIMEDIFF(End_Date_Time,Start_Date_Time) as totaltime FROM ";
$query.=" OneOfJob as ooj INNER JOIN Machine as ma on ma.Machine_ID=ooj.Machine_ID ";
$query.=" INNER JOIN Operator as op on op.Operator_ID=ooj.Operator_ID ";
$query.=" WHERE Start_Date_Time>='$StartDate' AND Start_Date_Time<='$EndDate';";

print("<h1>Re Work, Fixture, One Of Job Report Between $StartDate and $EndDate");
//print("<br>Query is '$query'");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
if(mysql_num_rows($res)==0)

{
	print("No Reports In Selected Time Period");
	bottomlink();
	break;
}
	
	print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
	printf('<tr><th>Machine</th><th>Type Of Work</th><th>Start Date & Time</th><th>Total Time</th><th>Drawing No</th><th>Operation NO</th><th>Operator Name</th><th>Quantity</th><th>Remarks</th>');
	while ($row = mysql_fetch_assoc($res))
		{
	print("<tr><td>$row[Machine_Name]</td><td>$row[TypeOfWork]</td><td>$row[Start_Date_Time]</td><td>$row[totaltime]</td><td>$row[Drawing_NO]</td><td>$row[Operation_NO]</td><td>$row[Operator_Name]</td><td>$row[Quantity]</td><td>$row[Remarks]</td>");
		}
	printf('</table>');
	
bottomlink();

?>