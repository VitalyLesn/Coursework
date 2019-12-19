<?header("Cache-Control no-store, no-cache");
header("Expires: " .date("r"));
ini_set("soap.wsdl_cache_enabled","0");
ini_set("display_errors",1);
error_reporting(E_ALL & ~E_NOTICE);
header("Content-Type: text/html; charset=utf-8");

if(isset($_POST["Insert"]))
{
	try
	{
		$client=new SoapClient(
		"http://localhost:1037/BugTrackerSOAP.svc?singleWsdl",
		array('soap_version'=>SOAP_1_2));
			$args=Array(
			"fio"=>$_POST["p1"],
			"login"=>$_POST["p2"],
			"iddep"=>(int)$_POST["p3"],
			"position"=>$_POST["p4"],
            "phoneempl"=>$_POST["p5"],
            "email"=>$_POST["p6"]
			);
		$ins=$client->InsertEmployees($args)->InsertEmployeesResult;
	}
	catch(SoapFault $e){
		$errmsg=$e->faultstring;
	}
}

if(isset($_POST["Upd"]))
{
	try
	{
		$client=new SoapClient(
		"http://localhost:1037/BugTrackerSOAP.svc?singleWsdl",
		array('soap_version'=>SOAP_1_2));
			$args=Array(
			"id"=>(int)$_POST["ID_Upd"],
			"fio"=>$_POST["NewFIO"],
			"login"=>$_POST["NewLogin"],
			"iddep"=>(int)$_POST["NewIDDep"],
			"position"=>$_POST["NewPosition"],
            "phoneempl"=>$_POST["NewPhoneEmpl"],
            "email"=>$_POST["NewEmail"]
			);
		$ins=$client->UpdateEmployees($args)->UpdateEmployeesResult;
	}
	catch(SoapFault $e){
		$errmsg=$e->faultstring;
	}
}

if(isset($_POST["Del"]))
{
	try
	{
		$client=new SoapClient(
		"http://localhost:1037/BugTrackerSOAP.svc?singleWsdl",
		array('soap_version'=>SOAP_1_2));
			$args=Array("id"=>(int)$_POST["ID_Del"]);
		$ins=$client->DeleteEmployees($args)->DeleteEmployeesResult;
	}
	catch(SoapFault $e){
		$errmsg=$e->faultstring;
	}
}




try
{
	$client=new SoapClient(
	"http://localhost:1037/BugTrackerSOAP.svc?singleWsdl",
	array('soap_version'=>SOAP_1_2));
	$tab=$client->SelectEmployees()->SelectEmployeesResult;
	$row = explode("*", $tab);
}
catch(SoapFault $e)
{
	$errmsg=$e->faultstring;
}

?>
<html>
<head>
    <meta charset="UTF-8"/>
</head>
<body>
    <form action="" method="POST">
<br><br>
<i>Добавление:</i>
<input name="Insert" type="submit" value="Добавить"/>
<input name="p1" type="text" size="10" value=""/>
<input name="p2" type="text" size="10" value=""/>
<input name="p3" type="text" size="10" value=""/>
<input name="p4" type="text" size="10" value=""/>
<input name="p5" type="text" size="10" value=""/>
<input name="p6" type="text" size="10" value=""/>
<br><br>
<i>Редактирование:</i>
<input name="Upd" type="submit" value="Редактировать"/>
<input name="ID_Upd" type="text" size="10" value=""/>
<input name="NewFIO" type="text" size="10" value=""/>
<input name="NewLogin" type="text" size="10" value=""/>
<input name="NewIDDep" type="text" size="10" value=""/>
<input name="NewPosition" type="text" size="10" value=""/>
<input name="NewPhoneEmpl" type="text" size="10" value=""/>
<input name="NewEmail" type="text" size="10" value=""/>
<br><br>
<i>Удаление:</i>
<input name="Del" type="submit" value="Удалить"/>
<input name="ID_Del" type="text" size="10" value=""/>  
<br><br>
		<table width="100%" border="1">
			<tbody>
			<tr>
				<th scope="col">Код</th>
				<th scope="col">ФИО</th>
				<th scope="col">Логин</th>
				<th scope="col">Код Отдела</th>	
				<th scope="col">Должность</th>
				<th scope="col">Телефон</th>
				<th scope="col">E-mail</th>						
			</tr>
            <? foreach ( $row as $cell )  {?>
						<?list($IDEmpl, $FIO, $Login,$IDDep,$Position,$PhoneEmpl,$Email) = explode("|", $cell);?>
					<tr>
						<td>
							<?=$IDEmpl?>
						</td>
						<td>
							<?=$FIO?>
						</td>
						<td>
							<?=$Login?>
						</td>
						<td>
							<?=$IDDep?>
						</td>
						<td>
							<?=$Position?>
						</td>
						<td>
							<?=$PhoneEmpl?>
						</td>
						<td>
							<?=$Email?>
						</td>
					</tr>
					<?}?>
				</tbody>
		</table>
</form>
</body>
</html>