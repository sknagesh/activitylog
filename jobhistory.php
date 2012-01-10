<?php
include('dewdb.inc');
include('phpfunctions.php');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());
$drg_ope = explode("-",$_GET['filter']);
$xml='';
$Drawing_ID=$drg_ope[1];
$Operation_NO=$drg_ope[0];;

$query="SELECT Machine_Name, comp.Drawing_NO,Component_Name,Operation_Desc, Start_Date_Time, End_Date_Time, Program_NO,  Remarks from Machine as ma "; 
$query.="INNER JOIN production as prod ON ma.Machine_ID=prod.Machine_ID ";
$query.="INNER JOIN Component as comp ON comp.Drawing_ID=prod.Drawing_ID ";
$query.="INNER JOIN Operation as op ON op.Operation_NO=prod.Operation_NO ";
$query.="WHERE prod.Drawing_ID='$Drawing_ID' and prod.Operation_NO='$Operation_NO' ORDER by Start_Date_Time desc;";

$res = mysql_query($query, $cxn) or die(mysql_error($cxn));

if(mysql_num_rows($res)==0)

{
		Header("Content-type: text/xml");
      	echo "<?xml version='1.0' encoding='ISO-8859-1'?>";
		echo( $xml );
		exit;
}else{



		Header("Content-type: text/xml");
      	echo "<?xml version='1.0' encoding='ISO-8859-1'?>";
	
	
	     	$xml = $xml . '<jobhistory>';
     		while ($row = mysql_fetch_assoc($res))
        		{
        $xml = $xml . '<machinename>'.$row['Machine_Name'].'</machinename><drawingno>'.$row['Drawing_NO'].'</drawingno>';
		$xml.='<componentname>'.$row['Component_Name'].'</componentname><operationdesc>'.$row['Operation_Desc'].'</operationdesc><startdatetime>'.$row['Start_Date_Time'].'</startdatetime>';
		$xml.='<enddatetime>'.$row['End_Date_Time'].'</enddatetime>';
		$xml.='<programno>'.$row['Program_NO'].'</programno><remarks>'.$row['Remarks'].'</remarks>';
		
            }
        
    	  $xml = $xml . '</jobhistory>';

		
	echo( $xml );

}

?>
