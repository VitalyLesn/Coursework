<?
require_once("XML/RPC.php");
//-----------------------------------------------------------------
if(isset($_POST["Insert"]))
{
    $client1 = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
    $params1 = Array(
		new XML_RPC_Value((string)$_POST["NameProj"], "string"),
		new XML_RPC_Value((string)$_POST["AbbrevProj"], "string"),
		new XML_RPC_Value((string)$_POST["DefenProj"], "string")
	);
$msg1 = new XML_RPC_Message("Project.Insert",$params1);
$result1 = $client1->send($msg1);
if($result1->faultCode()){
    print "Ошибка\n";
}
$tab1=XML_RPC_decode($result1->value());
}
//-----------------------------------------------------------------
if(isset($_POST["Upd"]))
{
    $client2 = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
    $params2 = Array(
		new XML_RPC_Value((int)$_POST["ID_Upd"], "int"),
		new XML_RPC_Value((string)$_POST["NewNameProj"], "string"),
		new XML_RPC_Value((string)$_POST["NewAbbrevProj"], "string"),
		new XML_RPC_Value((string)$_POST["NewDefenProj"], "string")
	);
$msg2 = new XML_RPC_Message("Project.Update",$params2);
$result2 = $client2->send($msg2);
if($result2->faultCode()){
    print "Ошибка\n";
}
$tab2=XML_RPC_decode($result2->value());
}
//-----------------------------------------------------------------
elseif(isset($_POST["Del"]))
{
    $client = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
    $params= Array(new XML_RPC_Value((int)$_POST["ID_Del"], "int"));
$msg = new XML_RPC_Message("Project.Delete",$params);
$result = $client->send($msg);
if($result->faultCode()){
    print "Ошибка\n";
}
$tab3=XML_RPC_decode($result->value());
};
//-----------------------------------------------------------------
$client = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
$msg = new XML_RPC_Message("Project.Select");
$result = $client->send($msg);
if($result->faultCode()){
	print "Ошибка\n";
}
$tab=XML_RPC_decode($result->value());




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
					<? foreach ( $tab as $row )  {?>
					<tr>
						<td>
							<?=$row["IDProj"]?>
						</td>
						<td>
							<?=$row["NameProj"]?>
						</td>
						<td>
							<?=$row["AbbrevProj"]?>
						</td>
						<td>
							<?=$row["DefenProj"]?>
						</td>
					</tr>
					<?}?>
				</tbody>
		</table>
</form>
</body>
</html>