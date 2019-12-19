<?
require_once("XML/RPC.php");
//-----------------------------------------------------------------
if(isset($_POST["Insert"]))
{
	$client1 = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
    $params1 = Array(
		new XML_RPC_Value((string)$_POST["p1"], "string"),
		new XML_RPC_Value((string)$_POST["p2"], "string"),
		new XML_RPC_Value((int)$_POST["p3"], "int"),
		new XML_RPC_Value((string)$_POST["p4"], "string"),
		new XML_RPC_Value((string)$_POST["p5"], "string"),
		new XML_RPC_Value((string)$_POST["p6"], "string")
	);
$msg1 = new XML_RPC_Message("Employees.Insert",$params1);
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
		new XML_RPC_Value((string)$_POST["NewFIO"], "string"),
		new XML_RPC_Value((string)$_POST["NewLogin"], "string"),
		new XML_RPC_Value((int)$_POST["NewIDDep"], "int"),
		new XML_RPC_Value((string)$_POST["NewPosition"], "string"),
		new XML_RPC_Value((string)$_POST["NewPhoneEmpl"], "string"),
		new XML_RPC_Value((string)$_POST["NewEmail"], "string")
	);
$msg2 = new XML_RPC_Message("Employees.Update",$params2);
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
$msg = new XML_RPC_Message("Employees.Delete",$params);
$result = $client->send($msg);
if($result->faultCode()){
    print "Ошибка\n";
}
$tab3=XML_RPC_decode($result->value());
};
//-----------------------------------------------------------------
$client = new XML_RPC_Client('/BugTrackerXLMRPS.ashx','localhost:1037');
$msg = new XML_RPC_Message("Employees.Select");
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
					<? foreach ( $tab as $row )  {?>
					<tr>
						<td>
							<?=$row["IDEmpl"]?>
						</td>
						<td>
							<?=$row["FIO"]?>
						</td>
						<td>
							<?=$row["Login"]?>
						</td>
						<td>
							<?=$row["IDDep"]?>
						</td>
						<td>
							<?=$row["Position"]?>
						</td>
						<td>
							<?=$row["PhoneEmpl"]?>
						</td>
						<td>
							<?=$row["E_mail"]?>
						</td>
					</tr>
					<?}?>
				</tbody>
		</table>
</form>
</body>
</html>