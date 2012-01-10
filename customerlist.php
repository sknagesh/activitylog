<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());
    header("Content-type: text/xml");
    echo "<?xml version='1.0' encoding='ISO-8859-1'?>"; 
	$xml = '';
$qry="SELECT * FROM Customer ORDER BY Customer_ID;";
 
$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		
     		$xml = $xml . '<continent>';
     		
while ($row = mysql_fetch_assoc($resa))
        		{
        $xml = $xml . '<customer id="'.$row['Customer_ID'].'">'.$row['Customer_Name'].'</customer>';
            }
                 		
        
    	  $xml = $xml . '</continent>';
	echo( $xml );
?>