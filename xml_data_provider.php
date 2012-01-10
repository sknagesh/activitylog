<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('activityLog',$cxn) or die("error opening db: ".mysql_error());


    // This is a very simple data provider for the cascading dropdown
    // example. A *real* data provider would most likely connect to
    // a database, use xslt and implement some level of security.

    Header("Content-type: text/xml");
      echo "<?xml version='1.0' encoding='ISO-8859-1'?>"; 
    // get query string params
	$filter = $_GET['filter'];

    // build xml content for client JavaScript

	$xml = '';

$qry="SELECT * FROM Operation WHERE Drawing_ID=$filter;";
//print("<br>filter query is '$qry'");
 
$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		
  //    $xml = $xml . '<continent name="Operation_NO">';
		//while ($row = mysql_fetch_assoc($resa))
		//{        
       // $opno=$row['Operation_NO'];
        //$opde=$row['Operation_Desc'];
        //$xml = $xml . '<operation id="1opno">2opde</operation>';
		//}
        //$xml = $xml . '</continent>';
        
     		$xml = $xml . '<continent name="Europe">';
     		while ($row = mysql_fetch_assoc($resa))
        		{
        $xml = $xml . '<operation id="'.$row['Operation_NO'].'">'.$row['Operation_Desc'].'</operation>';
            }
        
    	  $xml = $xml . '</continent>';

		
    // send xml to client
	echo( $xml );
?>