<?php
include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());

print("<h1>Machine Utilization Report</h1>");

$cStartDate=$_POST['StartDate'];
$cEndDate=$_POST['EndDate'];

$StartDate=change_date_format_for_db($cStartDate);
$EndDate=change_date_format_for_db($cEndDate);


$mcno=1;
$prodTime=0;
$setupTime=0;
$ptil=0;
$stil=0;
$pcim=0;
$scim=0;
$idleTime=0;
$reworkTime=0;
$maintenanceTime=0;
$preventiveTime=0;

$lptime= array();
$lstime= array();
$lptimetil= array();
$lstimetil= array();
$lptimecim= array();
$lstimecim= array();
$litime= array();
$lmtime= array();
$lpretime=array();






while($mcno<=7)
{
$ptime=time_bw_dates_and_prod_type($StartDate,$EndDate,"Production",$mcno,$cxn);
$lptime[$mcno]=$ptime;
$ptime=time_bw_dates_and_prod_type($StartDate,$EndDate,"Set Up",$mcno,$cxn);
$lstime[$mcno]=$ptime;
$ptime=time_bw_dates_and_prod_type_and_cust($StartDate,$EndDate,"Production",$mcno,"3",$cxn);
$lptimetil[$mcno]=$ptime;
$ptime=time_bw_dates_and_prod_type_and_cust($StartDate,$EndDate,"Set Up",$mcno,"3",$cxn);
$lstimetil[$mcno]=$ptime;
$ptime=time_bw_dates_and_prod_type_and_cust($StartDate,$EndDate,"Production",$mcno,"5",$cxn);
$lptimecim[$mcno]=$ptime;
$ptime=time_bw_dates_and_prod_type_and_cust($StartDate,$EndDate,"Set Up",$mcno,"5",$cxn);
$lstimecim[$mcno]=$ptime;
$ptime=time_bw_dates_and_maint_type($StartDate,$EndDate,"Breakdown",$mcno,$cxn);
$lmtime[$mcno]=$ptime;
$ptime=time_bw_dates_and_maint_type($StartDate,$EndDate,"Idle",$mcno,$cxn);
$litime[$mcno]=$ptime;
$ptime=time_bw_dates_and_maint_type($StartDate,$EndDate,"Preventive",$mcno,$cxn);
$lpretime[$mcno]=$ptime;
$mcno++;
}  



print("<br><h2>Production and Set Up Time Report between '$StartDate' and '$EndDate'</h2>");
print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
printf('<tr><th>Machine Name</th><th>Production Time</th><th>Set Up Time</th><th>Br. Maintenance Time</th><th>Pre. Maintenance Time</th><th>Idle Time</th></tr>');
$i=1;
	while ($i<=7)
		{
	$query="SELECT Machine_Name FROM Machine WHERE MAchine_Id='$i';";
	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	$row = mysql_fetch_assoc($res);
	printf('<tr><td>%s</td><td>%s, TIL=%s, CIM=%s</td><td>%s, TIL=%s, CIM=%s</td><td>%s</td><td>%s</td><td>%s</td>',$row['Machine_Name'], $lptime[$i],$lptimetil[$i],$lptimecim[$i],$lstime[$i],$lstimetil[$i],$lstimecim[$i],$lmtime[$i],$lpretime[$i],$litime[$i]);
	$prodTime+=$lptime[$i];
	$setupTime+=$lstime[$i];
	$idleTime+=$litime[$i];
	$maintenanceTime+=$lmtime[$i];
	$preventiveTime+=$lpretime[$i];
	$ptil+=$lptimetil[$i];
	$stil+=$lstimetil[$i];
	$pcim+=$lptimecim[$i];
	$scim+=$lstimecim[$i];
	
	$i++;
		}
printf('<tr><td>Total Time</td><td>%s</td><td>%s</td><td>%s</td>',$prodTime,$setupTime,$maintenanceTime,$preventiveTime,$idleTime);


print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
printf('<tr><th>Machine Name</th><th>Maintenance Type</th><th>Time</th><th>Remarks</th></tr>');
$query="SELECT Machine_Name,Maintenance_Type, Start_Date_Time,End_Date_Time,Remarks, TIMEDIFF(End_Date_Time,Start_Date_Time) as totaltime FROM ";
$query.="Maintenance as ma ";
$query.="INNER JOIN Machine as mach ON mach.Machine_ID=ma.Machine_ID ";
$query.="WHERE Start_Date_Time>='$StartDate' AND End_Date_Time<='$EndDate' ORDER BY ma.Machine_ID;";
print("<br><h2> Machine Maintenance Records between '$StartDate' and '$EndDate'</h2>");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	while ($row=mysql_fetch_assoc($res))
		{
	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td>',$row['Machine_Name'], $row['Maintenance_Type'],$row['totaltime'],$row['Remarks']);
		}

print("<table  border=\"1\" width = \"100%\" cellspacing=\"1\">");
printf('<tr><th>Start Date and Time</th><th>End Date and Time</th><th>Total Time</th><th>Remarks</th></tr>');
$query="SELECT Start_Date_Time,End_Date_Time,Remarks, TIMEDIFF(End_Date_Time,Start_Date_Time) as totaltime FROM ";
$query.="PowerFailure ";
$query.="WHERE Start_Date_Time>='$StartDate' AND End_Date_Time<='$EndDate' ORDER BY Start_Date_time;";
print("<br><h2> Power Failure between '$StartDate' and '$EndDate'</h2>");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	while ($row=mysql_fetch_assoc($res))
		{
	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td>',$row['Start_Date_Time'], $row['End_Date_Time'],$row['totaltime'],$row['Remarks']);
		}


bottomlink();

?>