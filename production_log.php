<?php


include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());



	$mcno = $_GET['filter'];
	$xml='';
if($mcno==0)
{
$query="SELECT Machine_Name, Drawing_NO, Prod_Type, Operation_Desc, Start_Date_Time, End_Date_Time, TIMEDIFF(End_Date_Time,Start_Date_Time) as totaltime, Operator_Name, Program_NO, Quantity, Remarks ";
$query.="FROM Machine as ma ";
$query.="INNER JOIN production as prod ON prod.Machine_ID=ma.Machine_ID "; 
$query.="INNER JOIN Operator as ope ON ope.Operator_ID=prod.Operator_ID ";
$query.="INNER JOIN Operation as opn ON opn.Operation_NO=prod.Operation_NO ";
$query.="INNER JOIN Component as comp ON comp.Drawing_ID=prod.Drawing_ID WHERE ";
$query.="prod.Start_Date_Time >=DATE_SUB(CURDATE(), INTERVAL 7 DAY);";
	
	
}else{
$query="SELECT Machine_Name, Drawing_NO, Prod_Type, Operation_Desc, Start_Date_Time, End_Date_Time, TIMEDIFF(End_Date_Time,Start_Date_Time) as totaltime, Operator_Name, Program_NO, Quantity, Remarks ";
$query.="FROM Machine as ma ";
$query.="INNER JOIN production as prod ON prod.Machine_ID=ma.Machine_ID "; 
$query.="INNER JOIN Operator as ope ON ope.Operator_ID=prod.Operator_ID ";
$query.="INNER JOIN Operation as opn ON opn.Operation_NO=prod.Operation_NO ";
$query.="INNER JOIN Component as comp ON comp.Drawing_ID=prod.Drawing_ID WHERE ";
$query.="prod.Start_Date_Time >=DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND prod.Machine_ID=$mcno;";

}


//	print("<br>Query in function is <br>'$query'");
	
	$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
	$logcount=mysql_num_rows($res);
	
	//print("log count '$logcount'");
		Header("Content-type: text/xml");
      	echo "<?xml version='1.0' encoding='ISO-8859-1'?>";
	
	
	     	$xml = $xml . '<prodlog><logcount>'.$logcount.'</logcount>';
     		while ($row = mysql_fetch_assoc($res))
        		{
        $xml = $xml . '<machinename>'.$row['Machine_Name'].'</machinename><drawingno>'.$row['Drawing_NO'].'</drawingno>';
		$xml.='<prodtype>'.$row['Prod_Type'].'</prodtype><operationdesc>'.$row['Operation_Desc'].'</operationdesc><startdatetime>'.$row['Start_Date_Time'].'</startdatetime>';
		$xml.='<enddatetime>'.$row['End_Date_Time'].'</enddatetime><totaltime>'.$row['totaltime'].'</totaltime><operatorname>'.$row['Operator_Name'].'</operatorname>';
		$xml.='<programno>'.$row['Program_NO'].'</programno><quantity>'.$row['Quantity'].'</quantity><remarks>'.$row['Remarks'].'</remarks>';
		
            }
        
    	  $xml = $xml . '</prodlog>';

		
    // send xml to client
	echo( $xml );
	

?>