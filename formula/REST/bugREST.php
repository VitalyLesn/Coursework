<?
if(isset($_POST["Insert"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Bugs",
	$_POST["IDProj"],
	$_POST["InfoBug"],
	$_POST["Priority"],
	$_POST["IDEmpl"],
	$_POST["Status"]
	);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Upd"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Bugs",
	$_POST["ID_Upd"],
	$_POST["NewIDProj"],
	$_POST["NewInfoBug"],
	$_POST["NewPriority"],
	$_POST["NewIDEmpl"],
	$_POST["NewStatus"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Del"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Bugs",$_POST["ID_Del"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

$ch =curl_init("http://localhost:28997/BugTrackerREST.svc/Bugs");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$tab=curl_exec($ch);
$row = explode("*", $tab);
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