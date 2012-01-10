<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());


    // This is a very simple data provider for the cascading dropdown
    // example. A *real* data provider would most likely connect to
    // a database, use xslt and implement some level of security.

    header("Content-type: text/xml");
    echo "<?xml version='1.0' encoding='ISO-8859-1'?>"; 


    // get query string params
	$filter = $_GET['filter'];

    // build xml content for client JavaScript

	$xml = '';

$qry="SELECT * FROM Component WHERE Customer_ID=$filter;";
//print("<br>filter query is '$qry'");
 
$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		
     		$xml = $xml . '<continent name="Europe">';
     		
while ($row = mysql_fetch_assoc($resa))
        		{
        $xml = $xml . '<drawing id="'.$row['Drawing_ID'].'">'.$row['Drawing_NO'].$row['Component_Name'].'</drawing>';
            }
                 		
        
    	  $xml = $xml . '</continent>';

		
    // send xml to client
	echo( $xml );
?>