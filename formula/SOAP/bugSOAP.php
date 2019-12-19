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
			"idproj"=>(int)$_POST["IDProj"],
			"infobug"=>$_POST["InfoBug"],
			"priority"=>$_POST["Priority"],
			"idempl"=>(int)$_POST["IDEmpl"],
			"status"=>$_POST["Status"]
			);
		$ins=$client->InsertBugs($args)->InsertBugsResult;
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
			"idbug"=>(int)$_POST["ID_Upd"],
			"idproj"=>(int)$_POST["NewIDProj"],
			"infobug"=>$_POST["NewInfoBug"],
			"priority"=>$_POST["NewPriority"],
			"idempl"=>(int)$_POST["NewIDEmpl"],
			"status"=>$_POST["NewStatus"]
			);
		$ins=$client->UpdateBugs($args)->UpdateBugsResult;
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
		$ins=$client->DeleteBugs($args)->DeleteBugsResult;
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
	$tab=$client->SelectBugs()->SelectBugsResult;
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
<input name="IDProj" type="text" size="10" value=""/>
<input name="InfoBug" type="text" size="10" value=""/>
<input name="Priority" type="text" size="10" value=""/>
<input name="IDEmpl" type="text" size="10" value=""/>
<input name="Status" type="text" size="10" value=""/>
<br><br>
<i>Редактирование:</i>
<input name="Upd" type="submit" value="Редактировать"/>
<input name="ID_Upd" type="text" size="10" value=""/>
<input name="NewIDProj" type="text" size="10" value=""/>
<input name="NewInfoBug" type="text" size="10" value=""/>
<input name="NewPriority" type="text" size="10" value=""/>
<input name="NewIDEmpl" type="text" size="10" value=""/>
<input name="NewStatus" type="text" size="10" value=""/>
<br><br>
<i>Удаление:</i>
<input name="Del" type="submit" value="Удалить"/>
<input name="ID_Del" type="text" size="10" value=""/>  
<br><br>
		<table width="100%" border="1">
			<tbody>
			<tr>
				<th scope="col">Код</th>
				<th scope="col">Код проекта</th>
				<th scope="col">Краткая информация</th>
				<th scope="col">Приоритет</th>		
				<th scope="col">Сотрудник</th>				
				<th scope="col">Статус</th>				
			</tr>
					<? foreach ( $row as $cell )  {?>
						<?list($IDBug, $IDProj, $InfoBug,$Priority,$IDEmpl,$Status) = explode("|", $cell);?>
					<tr>
					<td>
							<?=$IDBug?>
						</td>
						<td>
							<?=$IDProj?>
						</td>
						<td>
							<?=$InfoBug?>
						</td>
						<td>
							<?=$Priority?>
						</td>						
						<td>
							<?=$IDEmpl?>
						</td>						
						<td>
							<?=$Status?>
						</td>
					</tr>
					<?}?>
				</tbody>
		</table>
</form>
</body>
</html>