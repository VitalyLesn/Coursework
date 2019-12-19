<?
require_once("XML/RPC.php");
//-----------------------------------------------------------------
if(isset($_POST["Insert"]))
{
    $client1 = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
    $params1 = Array( 
		new XML_RPC_Value((int)$_POST["IDProj"], "int"),
		new XML_RPC_Value((string)$_POST["InfoBug"], "string"), 
		new XML_RPC_Value((string)$_POST["Priority"], "string"),
		new XML_RPC_Value((int)$_POST["IDEmpl"], "int"),
		new XML_RPC_Value((string)$_POST["Status"], "string")
	);
$msg1 = new XML_RPC_Message("Bugs.Insert",$params1);
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
		new XML_RPC_Value((int)$_POST["NewIDProj"], "int"),
		new XML_RPC_Value((string)$_POST["NewInfoBug"], "string"), 
		new XML_RPC_Value((string)$_POST["NewPriority"], "string"),
		new XML_RPC_Value((int)$_POST["NewIDEmpl"], "int"),
		new XML_RPC_Value((string)$_POST["NewStatus"], "string")
	);
$msg2 = new XML_RPC_Message("Bugs.Update",$params2);
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
$msg = new XML_RPC_Message("Bugs.Delete",$params);
$result = $client->send($msg);
if($result->faultCode()){
    print "Ошибка\n";
}
$tab3=XML_RPC_decode($result->value());
};
//-----------------------------------------------------------------
$client = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
$msg = new XML_RPC_Message("Bugs.Select");
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
					<? foreach ( $tab as $row )  {?>
					<tr>
						<td>
							<?=$row["IDBug"]?>
						</td>
						<td>
							<?=$row["IDProj"]?>
						</td>
						<td>
							<?=$row["InfoBug"]?>
						</td>
						<td>
							<?=$row["Priority"]?>
						</td>						
						<td>
							<?=$row["IDEmpl"]?>
						</td>						
						<td>
							<?=$row["Status"]?>
						</td>
					</tr>
					<?}?>
				</tbody>
		</table>
</form>
</body>
</html>