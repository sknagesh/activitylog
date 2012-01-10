<?php
include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$Machine_ID=$_POST['Machine_ID'];
$Activity_ID=$_POST['Activity_ID'];

if($Activity_ID==1)
{


	$Drawing_NO=$_POST['Drawing_NO'];
	$cStart_Date=$_POST['StartDate'];
	$cStart_Time=strtoupper($_POST['StartTime']);
	$cEnd_Date=$_POST['EndDate'];
	$cEnd_Time=strtoupper($_POST['EndTime']);
	$Operation_NO=$_POST['Operation_NO'];
	$Operator_ID=$_POST['Operator_ID'];
	$Program_NO=$_POST['Program_NO'];
	$Quantity=$_POST['ProductionQty'];
	$Remarks=$_POST['Remarks'];
	$Prod_Type=$_POST['prodtype'];
	$Start_Date=change_date_format_for_db($cStart_Date);
	$End_Date=change_date_format_for_db($cEnd_Date);
	$Start_Time=time_convert($cStart_Time);
	$End_Time=time_convert($cEnd_Time);
	$Start_Date_Time=$Start_Date.' '.$Start_Time;
	$End_Date_Time=$End_Date.' '.$End_Time;
$query="INSERT INTO production ";
$query.="(Machine_ID, Drawing_ID, Start_Date_Time, End_Date_Time, Operation_NO, Operator_ID, Program_NO, Quantity, Remarks, Prod_Type) ";
$query.=" VALUES('$Machine_ID','$Drawing_NO','$Start_Date_Time','$End_Date_Time','$Operation_NO','$Operator_ID','$Program_NO','$Quantity','$Remarks','$Prod_Type');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d and Record No is : %d\n", mysql_affected_rows(),mysql_insert_id());
bottomlink();

}

else if($Activity_ID==3) //tool change
{
	$Drawing_NO=$_POST['Drawing_NO'];
	$cStart_Date=$_POST['StartDate'];
	$cStart_Time=strtoupper($_POST['StartTime']);
	$Operation_NO=$_POST['Operation_NO'];
	$Operator_ID=$_POST['Operator_ID'];
	$Tool_Name=$_POST['Tool_Name'];
	$Tool_Dia=$_POST['Tool_Dia'];
	$Remarks=$_POST['Remarks'];
	$newtool=$_POST['newtool'];
	$Tool_Type_ID=$_POST['ToolType'];
	$Start_Date=change_date_format_for_db($cStart_Date);
	$Start_Time=time_convert($cStart_Time);
	$Change_Date_Time=$Start_Date.' '.$Start_Time;
$query="INSERT INTO ToolLog ";
$query.="(Machine_ID, Operator_ID,Drawing_ID,Change_Date_Time, Operation_NO, Tool_Name,Tool_Dia,New_Tool, Remarks,Tool_Type_ID) ";
$query.=" VALUES('$Machine_ID','$Operator_ID','$Drawing_NO','$Change_Date_Time','$Operation_NO','$Tool_Name','$Tool_Dia','$newtool','$Remarks','$Tool_Type_ID');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d and Record No is : %d\n", mysql_affected_rows(),mysql_insert_id());
bottomlink();
}

else if($Activity_ID==4) #Maintenance
{
	$cStart_Date=$_POST['StartDate'];
	$cStart_Time=$_POST['StartTime'];
	$cEnd_Date=$_POST['EndDate'];
	$cEnd_Time=$_POST['EndTime'];	
	$Operator_ID=$_POST['Operator_ID'];
	$MakEngr=$_POST['MakEngr'];	
	$TypeMaint=$_POST['maintype'];
	$Remarks=$_POST['Remarks'];
	$Start_Date=change_date_format_for_db($cStart_Date);
	$Start_Time=time_convert($cStart_Time);
	$End_Date=change_date_format_for_db($cEnd_Date);
	$End_Time=time_convert($cEnd_Time);
	$Start_Date_Time=$Start_Date.' '.$Start_Time;
	$End_Date_Time=$End_Date.' '.$End_Time;
$query="INSERT INTO Maintenance ";
$query.="(Machine_ID, Operator_ID,Start_Date_Time, End_Date_Time,MakinoEngr,Maintenance_Type, Remarks) ";
$query.=" VALUES('$Machine_ID','$Operator_ID','$Start_Date_Time','$End_Date_Time','$MakEngr','$TypeMaint','$Remarks');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d and Record No is : %d\n", mysql_affected_rows(),mysql_insert_id());
bottomlink();
}

else if($Activity_ID==5) //rejection report
{
	$Drawing_NO=$_POST['Drawing_NO'];
	$cStart_Date=$_POST['StartDate'];
	$cStart_Time=strtoupper($_POST['StartTime']);
	$Operation_NO=$_POST['Operation_NO'];
	$Operator_ID=$_POST['Operator_ID'];
	$Remarks=$_POST['Remarks'];
	$Start_Date=change_date_format_for_db($cStart_Date);
	$Start_Time=time_convert($cStart_Time);
	$Start_Date_Time=$Start_Date.' '.$Start_Time;
$query="INSERT INTO Rejection ";
$query.="(Machine_ID, Operator_ID,Drawing_ID,Start_Date_Time, Operation_NO, Remarks) ";
$query.=" VALUES('$Machine_ID','$Operator_ID','$Drawing_NO','$Start_Date_Time','$Operation_NO','$Remarks');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d and Record No is : %d\n", mysql_affected_rows(),mysql_insert_id());
bottomlink();
}

else if($Activity_ID==6)///power failure
{
	$cStart_Date=$_POST['StartDate'];
	$cStart_Time=strtoupper($_POST['StartTime']);
	$cEnd_Date=$_POST['EndDate'];
	$cEnd_Time=strtoupper($_POST['EndTime']);
	$Operator_ID=$_POST['Operator_ID'];
	$Remarks=$_POST['Remarks'];
	$Start_Date=change_date_format_for_db($cStart_Date);
	$Start_Time=time_convert($cStart_Time);
	$End_Date=change_date_format_for_db($cEnd_Date);
	$End_Time=time_convert($cEnd_Time);
	$Start_Date_Time=$Start_Date.' '.$Start_Time;
	$End_Date_Time=$End_Date.' '.$End_Time;
$query="INSERT INTO PowerFailure ";
$query.="(Machine_ID, Operator_ID,Start_Date_Time, End_Date_Time,Remarks) ";
$query.=" VALUES('$Machine_ID','$Operator_ID','$Start_Date_Time','$End_Date_Time','$Remarks');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d and Record No is : %d\n", mysql_affected_rows(),mysql_insert_id());
bottomlink();
}

else if($Activity_ID==7)//fai, fixtures etc
{
	$Drawing_NO=$_POST['Drawing_NO'];
	$cStart_Date=$_POST['StartDate'];
	$cStart_Time=strtoupper($_POST['StartTime']);
	$cEnd_Date=$_POST['EndDate'];
	$cEnd_Time=strtoupper($_POST['EndTime']);
	$Operation_NO=$_POST['operationdesc'];
	$Operator_ID=$_POST['Operator_ID'];
	$Program_NO=$_POST['Program_NO'];
	$Quantity=$_POST['ProductionQty'];
	$Remarks=$_POST['Remarks'];
	$worktype=$_POST['worktype'];
	$Start_Date=change_date_format_for_db($cStart_Date);
	$End_Date=change_date_format_for_db($cEnd_Date);
	$Start_Time=time_convert($cStart_Time);
	$End_Time=time_convert($cEnd_Time);
	$Start_Date_Time=$Start_Date.' '.$Start_Time;
	$End_Date_Time=$End_Date.' '.$End_Time;

$query="INSERT INTO OneOfJob ";
$query.="(Machine_ID, Drawing_NO, Start_Date_Time, End_Date_Time, Operation_NO, Operator_ID, Program_NO, Quantity, TypeOfWork,Remarks) ";
$query.=" VALUES('$Machine_ID','$Drawing_NO','$Start_Date_Time','$End_Date_Time','$Operation_NO','$Operator_ID','$Program_NO','$Quantity','$worktype','$Remarks');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d and Record No is : %d\n", mysql_affected_rows(),mysql_insert_id());
bottomlink();
}
else if($Activity_ID==11)//add new part
{
	$Drawing_NO=$_POST['Drawing_NO'];
	$Component_Name=$_POST['Component_Name'];
	$Customer_ID=$_POST['Customer_ID'];
$query="INSERT INTO Component ";
$query.="(Customer_ID, Drawing_NO, Component_Name) ";
$query.=" VALUES('$Customer_ID','$Drawing_NO','$Component_Name');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d\n", mysql_affected_rows());
bottomlink();
}
else if($Activity_ID==12)//add new operation to part
{
	$Drawing_NO=$_POST['Drawing_NO'];
	$Operation_Desc=$_POST['Operation_Desc'];
	$query="INSERT INTO Operation ";
$query.="(Drawing_ID, Operation_Desc) ";
$query.=" VALUES('$Drawing_NO','$Operation_Desc');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d and Record No is : %d\n", mysql_affected_rows(),mysql_insert_id());
bottomlink();
}

else

{
print("Undefined Activity");

}




?>