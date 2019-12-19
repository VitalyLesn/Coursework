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
			"nameproj"=>$_POST["NameProj"],
			"abbrevproj"=>$_POST["AbbrevProj"],
			"defenproj"=>$_POST["DefenProj"]
			);
		$ins=$client->InsertProject($args)->InsertProjectResult;
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
			"nameproj"=>$_POST["NewNameProj"],
			"abbrevproj"=>$_POST["NewAbbrevProj"],
			"defenproj"=>$_POST["NewDefenProj"]
			);
		$ins=$client->UpdateProject($args)->UpdateProjectResult;
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
		$ins=$client->DeleteProject($args)->DeleteProjectResult;
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
	$tab=$client->SelectProject()->SelectProjectResult;
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
<input name="NameProj" type="text" size="10" value=""/>
<input name="AbbrevProj" type="text" size="10" value=""/>
<input name="DefenProj" type="text" size="10" value=""/>
<br><br>
<i>Редактирование:</i>
<input name="Upd" type="submit" value="Редактировать"/>
<input name="ID_Upd" type="text" size="10" value=""/>
<input name="NewNameProj" type="text" size="10" value=""/>
<input name="NewAbbrevProj" type="text" size="10" value=""/>
<input name="NewDefenProj" type="text" size="10" value=""/>
<br><br>
<i>Удаление:</i>
<input name="Del" type="submit" value="Удалить"/>
<input name="ID_Del" type="text" size="10" value=""/>  
<br><br>
		<table width="100%" border="1">
			<tbody>
			<tr>
				<th scope="col">Код</th>
				<th scope="col">Название</th>
				<th scope="col">Аббревиатура</th>
				<th scope="col">Описание проекта</th>						
			</tr>
			<? foreach ( $row as $cell )  {?>
						<?list($IDProj, $NameProj, $AbbrevProj,$DefenProj) = explode("|", $cell);?>
					<tr>
						<td>
							<?=$IDProj?>
						</td>
						<td>
							<?=$NameProj?>
						</td>
						<td>
							<?=$AbbrevProj?>
						</td>
						<td>
							<?=$DefenProj?>
						</td>
					</tr>
					<?}?>
				</tbody>
		</table>
</form>
</body>
</html>