<HTML>
<TITLE>Daily Activity Report</TITLE>
<HEAD>

</HEAD>    	      
<h1>Select Machine and Type of Report</h1>   
<BODY>
<form action="activity.php" method="post">
<table border="1" width = "80%" cellspacing="10">
	<tr><td width=50%><input type="radio" name="machine" value="1" checked/> S56-1</td><td><input type="radio" name="activity" value="1" checked /> Production</td></tr>
	<tr><td width=50%><input type="radio" name="machine" value="2" /> S56-2</td><td><input type="radio" name="activity" value="3" /> Tool Change</td></tr>	
	<tr><td width=50%><input type="radio" name="machine" value="3" /> S33</td><td><input type="radio" name="activity" value="4" /> Machine Maintenance/Idle</td></tr>
	<tr><td width=50%><input type="radio" name="machine" value="4" /> S56-3</td><td><input type="radio" name="activity" value="5" /> Rejection Report</td></tr>	
	<tr><td width=50%><input type="radio" name="machine" value="5" /> F5</td><td><input type="radio" name="activity" value="6" /> Power Failure</td></tr>	
	<tr><td width=50%><input type="radio" name="machine" value="6" /> F3</td><td><input type="radio" name="activity" value="7" /> Fixture Work/One Of Job/Other Work</td></tr>
	<tr><td width=50%><input type="radio" name="machine" value="7" /> Slim</td>
	<tr><td width=50%><input type="radio" name="machine" value="8" /> All Machines</td></tr>
	<tr><td colspan=2 align="center"><input type="submit" name="Submit" value="Submit" /></td></tr>
</table>

<table border="1" width = "80%" cellspacing="10">
	<tr><td align="Center"><a href="reports.html">View Reports</a> </td><td align="Center"><a href="AddPart.php">Add New Part</a> </td><td align="Center"><a href="AddOperation.php">Add Operations to Part</a> </td></tr>
</table>



</form> 
     
    
</BODY>



</HTML>
