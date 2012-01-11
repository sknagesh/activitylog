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

$query="SELECT Remarks, Start_Date_Time, End_Date_Time, timediff(End_date_Time,Start_Date_Time) as timediff from PowerFailure "; 
$query.="WHERE Start_Date_Time>='$StartDate' and End_Date_Time<='$EndDate' ORDER by Start_Date_Time desc;";
//print("<br>Query is '$query'");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
if(mysql_num_rows($res)==0)

{
	print("No Records for The Selected Date Range");
	bottomlink();
	break;
}
	
	print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
	printf('<tr><th>Start Date & Time</th><th>End Date & Time</th><th>Duration</th><th>Remarks</th>');
	print("<h2>Power Failure Report Between '$StartDate' and '$EndDate' </h2>");
	while ($row = mysql_fetch_assoc($res))
		{
	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td>',$row['Start_Date_Time'], $row['End_Date_Time'],$row['timediff'],$row['Remarks']);
		}
	printf('</table>');
	
bottomlink();

?>