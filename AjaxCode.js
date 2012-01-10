var XmlHttpObj;
function CreateXmlHttpObj() {
	try {
		XmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			XmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (oc) {
			XmlHttpObj = null;
		}
	}
	if (!XmlHttpObj && typeof XMLHttpRequest != "undefined") {
		XmlHttpObj = new XMLHttpRequest();
	}
}
function DrawingListOnChange() {
	var DrawingList = document.getElementById("Drawing_NO");
	var selectedDrawing = DrawingList.options[DrawingList.selectedIndex].value;
	var requestUrl;
	requestUrl = "xml_data_provider.php" + "?filter="
			+ encodeURIComponent(selectedDrawing);
	CreateXmlHttpObj();
	if (XmlHttpObj) {
		XmlHttpObj.onreadystatechange = StateChangeHandler;
		XmlHttpObj.open("GET", requestUrl, true);
		XmlHttpObj.send(null);
	}
}
function CustomerListOnChange() {
	var CustomerList = document.getElementById("Customer_ID");
	var selectedCustomer = CustomerList.options[CustomerList.selectedIndex].value;
	var requestUrl;
	requestUrl = "xml_data_provider_cust.php" + "?filter="
			+ encodeURIComponent(selectedCustomer);
	CreateXmlHttpObj();
	if (XmlHttpObj) {
		XmlHttpObj.onreadystatechange = CustStateChangeHandler;
		XmlHttpObj.open("GET", requestUrl, true);
		XmlHttpObj.send(null);
	}
}
function StateChangeHandler() {
	if (XmlHttpObj.readyState == 4) {
		if (XmlHttpObj.status == 200) {
			PopulateOperationList(XmlHttpObj.responseXML.documentElement);
		} else {
			alert("problem retrieving data from the server, status code: "
					+ XmlHttpObj.status);
		}
	}
}
function CustStateChangeHandler() {
	if (XmlHttpObj.readyState == 4) {
		if (XmlHttpObj.status == 200) {
			PopulateDrawingList(XmlHttpObj.responseXML.documentElement);
		} else {
			alert("problem retrieving data from the server, status code: "
					+ XmlHttpObj.status);
		}
	}
}
function PopulateOperationList(OperationNode) {
	var OperationList = document.getElementById("Operation_NO");
	for ( var count = OperationList.options.length - 1; count > -1; count--) {
		OperationList.options[count] = null;
	}

	var OperationNodes = OperationNode.getElementsByTagName('operation');
	var idValue;
	var textValue;
	var optionItem;

		optionItem = new Option("none", "0", false, false);
		OperationList.options[0] = optionItem;


	for ( var count = 0; count < OperationNodes.length; count++) {
		textValue = GetInnerText(OperationNodes[count]);
		idValue = OperationNodes[count].getAttribute("id");
		optionItem = new Option(textValue, idValue, false, false);
		OperationList.options[OperationList.length] = optionItem;
	}
}
function PopulateDrawingList(countryNode) {
	var countryList = document.getElementById("Drawing_NO");
	for ( var count = countryList.options.length - 1; count > -1; count--) {
		countryList.options[count] = null;
	}

	var countryNodes = countryNode.getElementsByTagName('drawing');
	var idValue;
	var textValue;
	var optionItem;
	for ( var count = 0; count < countryNodes.length; count++) {
		textValue = GetInnerText(countryNodes[count]);
		idValue = countryNodes[count].getAttribute("id");
		optionItem = new Option(textValue, idValue, false, false);
		countryList.options[countryList.length] = optionItem;
	}
}
function GetInnerText(node) {
	return (node.textContent || node.innerText || node.text);
}

function validateForm(oForm) {

	oForm.onsubmit = function() // attach the function to onsubmit event
	{
		redate = /^\d{1,2}\-\d{1,2}\-\d{4}$/;
		retime = /^(\d{1,2}):(\d{2})(:)(\s?(AM|am|PM|pm))$/;
		if (oForm.StartDate) {
			if (oForm.StartDate.value != ''
					&& !oForm.StartDate.value.match(redate)) {
				alert("Invalid date format: " + oForm.StartDate.value);
				oForm.StartDate.focus();
				return false;
			}
			var matchArray = oForm.StartDate.value.split("-");
			day = matchArray[0];
			month = matchArray[1];
			year = matchArray[2];
			if (day >= 32) {
				alert("please enter correct date");
				return false;
			}
			if (month >= 13) {
				alert("please enter correct month");
				return false;
			}

		}
		if (oForm.EndDate) {
			if (oForm.EndDate.value != '' && !oForm.EndDate.value.match(redate)) {
				alert("Invalid End date format: " + oForm.EndDate.value);
				oForm.EndDate.focus();
				return false;
			}
			var matchArray = oForm.EndDate.value.split("-");
			day = matchArray[0];
			month = matchArray[1];
			year = matchArray[2];
			if (day >= 32) {
				alert("please enter correct date");
				return false;
			}
			if (month >= 13) {
				alert("please enter correct month");
				return false;
			}

		}
		if (oForm.StartTime) {
			if (!IsValidTime(oForm.StartTime.value)) {
				return false;
			}
		}
		if (oForm.EndTime) {

			if (!IsValidTime(oForm.EndTime.value)) {
				return false;
			}
		}

		if (oForm.StartDate != ''){
			 if(oForm.EndDate != ''){
				if(oForm.Starttime != '' && oForm.EndTime != '') {

			var matchArray = oForm.StartDate.value.split("-");
			sday = matchArray[0];
			smonth = matchArray[1];
			syear = matchArray[2];

			var matchArray = oForm.EndDate.value.split("-");
			eday = matchArray[0];
			emonth = matchArray[1];
			eyear = matchArray[2];

			var timepart = /^(\d{1,2}):(\d{2})(:)(\s?(AM|am|PM|pm|Pm|pM|Am|aM))$/;
			var ampmmatch=/(pm|PM|pM|Pm)/;
			var matchArray = oForm.StartTime.value.match(timepart);
			shour = matchArray[1];
			sminute = matchArray[2];
			scolon = matchArray[4];
			sampm = matchArray[5];
			if (sampm.match(ampmmatch))
			{
				var t=parseInt(shour,10); 
				if(t<=11)
				{
				shour=t+12;
				}
			}

			var matchArray = oForm.EndTime.value.match(timepart);
			ehour = matchArray[1];
			eminute = matchArray[2];
			ecolon = matchArray[4];
			eampm = matchArray[5];
//alert("before ampm hour="+ehour);
			if (eampm.match(ampmmatch))
			{var t=parseInt(ehour,10);
			 if(t<=11){ehour=t+12;}}
//alert("after ampm hour="+ehour);
			var sdate=new Date(syear,smonth,sday,shour,sminute,0,0);
			var edate=new Date(eyear,emonth,eday,ehour,eminute,0,0);
//			alert("Start date time="+sdate+" and end Time is "+edate);
			if(sdate>=edate){alert("invalid start and end time"); return false;}
	}
		}
			}

		if (oForm.Program_NO) {
			if (oForm.elements['Program_NO'].value.length < 1) {
				alert("Please enter Program Number");
				return false;
			}
		}
		if (oForm.Customer_Id) {
			if (oForm.elements['Customer_ID'].value== 1) {
				alert("Please Select Customer, Drawing and Operation");
				return false;
			}
		}
		if (oForm.Operation_Desc) {

			if (oForm.elements['Operation_Desc'].value.length < 1) {
				alert("Please enter Operation Description");
				return false;
			}

			if (oForm.elements['Operation_Desc'].value != "") {
				var atpos = oForm.elements['Operation_Desc'].value.indexOf("&");

				if (atpos > 0) {
					alert("Please enter only letter and numeric characters");
					oForm.elements['Operation_Desc'].focus();
					return (false);
				}
			}

		}

		if (oForm.Remarks) {

			if (oForm.elements['Remarks'].value != "") {
				var atpos = oForm.elements['Remarks'].value.indexOf("&");

				if (atpos > 0) {
					alert("Please enter only letter and numeric characters in Remarks");
					oForm.elements['Remarks'].focus();
					return (false);
				}
			}

		}


		if (oForm.Drawing_NO) {
			if (oForm.elements['Drawing_NO'].value.length < 1) {
				alert("Please enter Drawing Number");
				return false;
			}
		}

		if (oForm.operationdesc) {
			if (oForm.elements['operationdesc'].value.length < 1) {
				alert("Please enter Brief Operation Description");
				return false;
			}
		}

		if (oForm.Operation_NO) {

			if (oForm.elements['Operation_NO'].value=="0") {
				alert("Please Select Operation No");
				return false;
			}
		}

		if (oForm.ProductionQty) {
			if (oForm.elements['ProductionQty'].value.length < 1) {
				alert("Please enter Production Quantity");
				return false;
			}
			if (isNaN(oForm.elements['ProductionQty'].value)) {
				alert("Please enter Correct Production Quantity");
				return false;
			}
		}

		if (oForm.Tool_Name) {
			if (oForm.elements['Tool_Name'].value.length < 1) {
				alert("Please enter Tool Description");
				return false;
			}
		}
		if (oForm.Tool_Dia) {
			if (oForm.elements['Tool_Dia'].value.length < 1) {
				alert("Please enter Tool Diameter");
				return false;
			}
			if (isNaN(oForm.elements['Tool_Dia'].value)) {
				alert("Please enter Correct Tool Diameter");
				return false;
			}
		}
		return true;
	}
}

function IsValidTime(timeStr) {

	var timepart = /^(\d{1,2}):(\d{2})(:)(\s?(AM|am|PM|pm|Pm|pM|Am|aM))$/;

	var matchArray = timeStr.match(timepart);
	if (matchArray == null) {
		alert("Time is not in a valid format.");
		return false;
	}
	hour = matchArray[1];
	minute = matchArray[2];
	colon = matchArray[4];
	ampm = matchArray[5];

	if (colon == "") {
		alert("please enter colon :");
	}
	if (ampm == "") {
		alert("Please enter AM/PM");
	}

	if (hour < 0 || hour > 12) {
		alert("Hour must be between 1 and 12");
		return false;
	}

	if (minute < 0 || minute > 59) {
		alert("Minute must be between 0 and 59.");
		return false;
	}
	return true;
}

function toolreptype(oForm) {
	if (oForm.reptype[0].checked) {
		oForm.Customer_ID.disabled = false;
		oForm.ToolType.disabled = true;
		oForm.ToolDia.disabled = true;
		oForm.StartDate.disabled = true;
		oForm.EndDate.disabled = true;
	}

	if (oForm.reptype[1].checked) {
		oForm.Customer_ID.disabled = true;
		oForm.ToolType.disabled = false;
		oForm.ToolDia.disabled = true;
		oForm.StartDate.disabled = true;
		oForm.EndDate.disabled = true;
	}
	if (oForm.reptype[2].checked) {
		oForm.Customer_ID.disabled = true;
		oForm.ToolType.disabled = true;
		oForm.ToolDia.disabled = false;
		oForm.StartDate.disabled = true;
		oForm.EndDate.disabled = true;
	}
	if (oForm.reptype[3].checked) {
		oForm.Customer_ID.disabled = true;
		oForm.ToolType.disabled = true;
		oForm.ToolDia.disabled = true;
		oForm.StartDate.disabled = false;
		oForm.EndDate.disabled = false;

	}

}



function prodreptype(oForm) {

	if (oForm.prod[1].checked) {var mcno=1;}
	else if(oForm.prod[2].checked) {var mcno=2;}
	else if(oForm.prod[3].checked) {var mcno=3;}
	else if(oForm.prod[4].checked) {var mcno=4;}
	else if(oForm.prod[5].checked) {var mcno=5;}
	else if(oForm.prod[6].checked) {var mcno=6;}
	else if(oForm.prod[7].checked) {var mcno=7;}
	else if(oForm.prod[0].checked) {var mcno=0;}
	
	var requestUrl;
	requestUrl = "production_log.php" + "?filter="
			+ encodeURIComponent(mcno);
	CreateXmlHttpObj();
	if (XmlHttpObj) {
		XmlHttpObj.onreadystatechange = machineChangeHandler;
		XmlHttpObj.open("GET", requestUrl, true);
		XmlHttpObj.send(null);
					}
}


function machineChangeHandler() {
	if (XmlHttpObj.readyState == 4) {
		if (XmlHttpObj.status == 200) {
			PopulateProductionLog(XmlHttpObj.responseXML.documentElement);
		} else {
			alert("problem retrieving data from the server, status code: "
					+ XmlHttpObj.status);
		}
	}
}


function PopulateProductionLog(OperationNode) {
	var Machine_Name = OperationNode.getElementsByTagName('machinename');	
	var Drawing_NO = OperationNode.getElementsByTagName('drawingno');
	var Operation_Desc = OperationNode.getElementsByTagName('operationdesc');
	var Start_Date_Time = OperationNode.getElementsByTagName('startdatetime');
	var End_Date_Time = OperationNode.getElementsByTagName('enddatetime');
	var totaltime = OperationNode.getElementsByTagName('totaltime');
	var Operator_Name = OperationNode.getElementsByTagName('operatorname');
	var Prod_Type = OperationNode.getElementsByTagName('prodtype');
	var Program_NO = OperationNode.getElementsByTagName('programno');
	var Quantity = OperationNode.getElementsByTagName('quantity');
	var Remarks = OperationNode.getElementsByTagName('remarks');
	var logcount = OperationNode.getElementsByTagName('logcount');
	document.write("<h1> Production Report For Last 14 Days</h1>");
	document.write("<script src=\"AjaxCode.js\"></script>");
	document.write("<form name=\"preport\"\n");
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"0\" name=\"prod\" value=\"0\" /> All Machines</td>");
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"1\" name=\"prod\" value=\"1\" /> S56-1</td>");
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"2\" name=\"prod\" value=\"2\" /> S56-2</td>");
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"3\" name=\"prod\" value=\"3\" /> S33</td>");
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"4\" name=\"prod\" value=\"4\" /> S56-3</td>");
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"5\" name=\"prod\" value=\"5\" /> F5</td>");	
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"6\" name=\"prod\" value=\"6\" /> F3</td>");
 	document.write("<td><input type=\"radio\" onClick=\"return prodreptype(document.forms['preport'])\" ID=\"7\" name=\"prod\" value=\"7\" /> Slim-3</td>");
	document.write("<table  border=1 width = 100% cellspacing=1>");
	document.write("<tr><th>Machine</th><th>Drawing No</th><th>Type</th><th>Operation</th>");
	document.write("<th>Start Date & Time</th><th>End Date& Time</th><th>Total Time</th>");
	document.write("<th>Operator</th><th>Program NO</th><th>Quantity</th><th>Remarks</th></tr><tbody>");
	for ( var count = 0; count < Machine_Name.length; count++) {
document.write("<tr><td>"+GetInnerText(Machine_Name[count])+"</td><td>"+GetInnerText(Drawing_NO[count])+"</td><td>"+GetInnerText(Prod_Type[count])+"</td><td>"+GetInnerText(Operation_Desc[count])+"</td>");
document.write("<td>"+GetInnerText(Start_Date_Time[count])+"</td><td>"+GetInnerText(End_Date_Time[count])+"</td><td>"+GetInnerText(totaltime[count])+"</td><td>"+GetInnerText(Operator_Name[count])+"</td>");
document.write("<td>"+GetInnerText(Program_NO[count])+"</td><td>"+GetInnerText(Quantity[count])+"</td>");
	if(GetInnerText(Remarks[count])=="")
	{
		document.write("<td></td><tr>");
	}else
	{
	document.write("<td>"+GetInnerText(Remarks[count])+"</td><tr>");
	}
	}
document.write("</table>");
document.write("<table border=\"1\" width = \"80%\" cellspacing=\"10\">");
document.write("<tr><td align=\"Center\"><a href=\"mainForm.php\">Submit New Reports</a> </td><td align=\"Center\"><a href=\"reports.html\">View Reports</a> </td><td align=\"Center\"><a href=\"AddPart.php\">Add New Part</a> </td><td align=\"Center\"><a href=\"AddOperation.php\">Add Operations to Part</a> </td></tr>");
document.write("</table>");


	document.close();
}



function OperationListOnChange() {
	var OperationList = document.getElementById("Operation_NO");
	var DrawingList = document.getElementById("Drawing_NO");
	var selectedDrawing_Operation = OperationList.options[OperationList.selectedIndex].value+"-"+DrawingList.options[DrawingList.selectedIndex].value;
	var requestUrl;
	requestUrl = "jobhistory.php" + "?filter="
			+ encodeURIComponent(selectedDrawing_Operation);
	CreateXmlHttpObj();
	if (XmlHttpObj) {
		XmlHttpObj.onreadystatechange = Drawing_Operation_ChangeHandler;
		XmlHttpObj.open("GET", requestUrl, true);
		XmlHttpObj.send(null);
	}
}

function Drawing_Operation_ChangeHandler() {
	if (XmlHttpObj.readyState == 4) {
		if (XmlHttpObj.status == 200) {
			PopulateJobHistory(XmlHttpObj.responseXML.documentElement);
		} else {
			alert("problem retrieving data from the server, status code: "
					+ XmlHttpObj.status);
		}
	}
}


function PopulateJobHistory(OperationNode) {
	var Machine_Name = OperationNode.getElementsByTagName('machinename');	
	var Drawing_NO = OperationNode.getElementsByTagName('drawingno');
	var Component_Name = OperationNode.getElementsByTagName('componentname');
	var Operation_Desc = OperationNode.getElementsByTagName('operationdesc');
	var Start_Date_Time = OperationNode.getElementsByTagName('startdatetime');
	var End_Date_Time = OperationNode.getElementsByTagName('enddatetime');
	var Program_NO = OperationNode.getElementsByTagName('programno');
	var Remarks = OperationNode.getElementsByTagName('remarks');
	document.open("text/html","replace");
	document.write("<script src=\"AjaxCode.js\"></script>");
	document.write("<table>");
	document.write("<td>Customer</td>");
	document.write("<td><select name=\"Customer_ID\" id=\"Customer_ID\"onClick=\"return CustomerListOnChange()\">");
	document.write('<option value=""></option>');
	document.write("</select></td>");
	document.write("<td>Drawing No.</td>");
	document.write("<td><select name=\"Drawing_NO\" id=\"Drawing_NO\"onClick=\"return DrawingListOnChange()\">");
	document.write('<option value=""></option>');
	document.write("</select></td>");
	document.write("<td>Operation No.</td>");
	document.write("<td><select name=\"Operation_NO\" id=\"Operation_NO\"onChange=\"return OperationListOnChange()\" >");
	document.write('<option value="none"></option>');
	document.write("</select></td>");
	document.write("<td><input type=\"button\" name=\"refresh\" value=\"refresh\" onClick=\"customerlist()\"/></td>");
	document.write("</tr>");
	document.write("</table>");
	document.write("<table  border=1 width = 100% cellspacing=1>");
	document.write("<tr><th>Machine</th><th>Drawing No</th><th>Name</th><th>Operation</th>");
	document.write("<th>Start Date & Time</th><th>End Date& Time</th><th>Program NO.</th>");
	document.write("<th>Remarks</th></tr><tbody>");
	for ( var count = 0; count < Machine_Name.length; count++) {
	document.write("<tr><td>"+GetInnerText(Machine_Name[count])+"</td><td>"+GetInnerText(Drawing_NO[count])+"</td><td>"+GetInnerText(Component_Name[count])+"</td><td>"+GetInnerText(Operation_Desc[count])+"</td>");
	document.write("<td>"+GetInnerText(Start_Date_Time[count])+"</td><td>"+GetInnerText(End_Date_Time[count])+"</td>");
	document.write("<td>"+GetInnerText(Program_NO[count])+"</td><td>"+GetInnerText(Remarks[count])+"</td><tr>");	
	}
	document.write("</table>");
	document.write("<table border=\"1\" width = \"80%\" cellspacing=\"10\">");
	document.write("<tr><td align=\"Center\"><a href=\"mainForm.php\">Submit New Reports</a> </td><td align=\"Center\"><a href=\"reports.html\">View Reports</a> </td><td align=\"Center\"><a href=\"AddPart.php\">Add New Part</a> </td><td align=\"Center\"><a href=\"AddOperation.php\">Add Operations to Part</a> </td></tr>");
	document.write("</table>");
	document.close();
}



function customerlist()
{
	
	requestUrl = "customerlist.php";
	CreateXmlHttpObj();
	if (XmlHttpObj) {
		XmlHttpObj.onreadystatechange = customerlist_ChangeHandler;
		XmlHttpObj.open("GET", requestUrl, true);
		XmlHttpObj.send(null);
	}

}

function customerlist_ChangeHandler() {
	if (XmlHttpObj.readyState == 4) {
		if (XmlHttpObj.status == 200) {
			Populatecustomerlist(XmlHttpObj.responseXML.documentElement);
		} else {
			alert("problem retrieving data from the server, status code: "
					+ XmlHttpObj.status);
		}
	}
}


function Populatecustomerlist(OperationNode) {
	var customerList = document.getElementById("Customer_ID");
	var OperationNodes = OperationNode.getElementsByTagName('customer');
	var idValue;
	var textValue;
	var optionItem;

	for ( var count = 0; count < OperationNodes.length; count++) {

		textValue = GetInnerText(OperationNodes[count]);
		idValue = OperationNodes[count].getAttribute("id");
		optionItem = new Option(textValue, idValue, false, false);
		customerList.options[customerList.length] = optionItem;
	}
}





	

