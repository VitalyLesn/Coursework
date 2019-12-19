<?
if(isset($_POST["Insert"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Project",
	$_POST["NameProj"],
	$_POST["AbbrevProj"],
	$_POST["DefenProj"]
	);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Upd"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Project",
	$_POST["ID_Upd"],
	$_POST["NewNameProj"],
	$_POST["NewAbbrevProj"],
	$_POST["NewDefenProj"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Del"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Project",$_POST["ID_Del"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

$ch =curl_init("http://localhost:28997/BugTrackerREST.svc/Project");
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