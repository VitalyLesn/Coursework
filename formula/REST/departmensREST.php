<?
if(isset($_POST["Insert"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Departments",$_POST["NameDep"],$_POST["PhoneDep"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Upd"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Departments",
	$_POST["ID_Upd"],	
	$_POST["NewNameDep"],
		$_POST["NewPhoneDep"]
		);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Del"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Departments",$_POST["ID_Del"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

$ch =curl_init("http://localhost:28997/BugTrackerREST.svc/Departments");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$tab=curl_exec($ch);
$row = explode("*", $tab);
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