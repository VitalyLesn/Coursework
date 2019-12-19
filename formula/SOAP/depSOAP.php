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
			"name"=>$_POST["NameDep"],
			"phone"=>(int)$_POST["PhoneDep"]
			);
		$ins=$client->InsertDepartmens($args)->InsertDepartmensResult;
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
			"name"=>$_POST["NewNameDep"],
			"phone"=>(int)$_POST["NewPhoneDep"]
			);
		$ins=$client->UpdateDepartmens($args)->UpdateDepartmensResult;
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
		$ins=$client->DeleteDepartmens($args)->DeleteDepartmensResult;
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
	$tab=$client->SelectDepartments()->SelectDepartmentsResult;
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
    <title>XML_RPC Client on PHP</title>
</head>
<body>
    <form action="" method="POST">
<br><br>
<i>Добавление:</i>
<input name="Insert" type="submit" value="Добавить"/>
<input name="NameDep" type="text" size="10" value=""/>
<input name="PhoneDep" type="text" size="10" value=""/>
<br><br>
<i>Редактирование:</i>
<input name="Upd" type="submit" value="Редактировать"/>
<input name="ID_Upd" type="text" size="10" value=""/>
<input name="NewNameDep" type="text" size="10" value=""/>
<input name="NewPhoneDep" type="text" size="10" value=""/>
<br><br>
<i>Удаление:</i>
<input name="Del" type="submit" value="Удалить"/>
<input name="ID_Del" type="text" size="10" value=""/>  
<br><br>
		<table width="100%" border="1">
			<tbody>
			<tr>
				<th scope="col">Код</th>
				<th scope="col">Название отдела</th>
				<th scope="col">Телефон</th>
			</tr>
            <? foreach ( $row as $cell )  {?>
						<?list($IDDep, $NameDep, $PhoneDep) = explode("|", $cell);?>
					<tr>
						<td>
							<?=$IDDep?>
						</td>
						<td>
							<?=$NameDep?>
						</td>
						<td>
							<?=$PhoneDep?>
						</td>

					</tr>
					<?}?>
				</tbody>
		</table>
</form>
</body>
</html>