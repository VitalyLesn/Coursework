<?if(isset($_POST["Insert"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Employees",
	$_POST["p1"],
			$_POST["p2"],
			$_POST["p3"],
			$_POST["p4"],
            $_POST["p5"],
            $_POST["p6"]
	);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Upd"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Employees",
	$_POST["ID_Upd"],
	$_POST["NewFIO"],
			$_POST["NewLogin"],
			$_POST["NewIDDep"],
			$_POST["NewPosition"],
            $_POST["NewPhoneEmpl"],
            $_POST["NewEmail"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

if(isset($_POST["Del"]))
{
	$array=Array("http://localhost:28997/BugTrackerREST.svc/Employees",$_POST["ID_Del"]);
		$separated = implode(",", $array);
	$ch =curl_init($separated);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$tab=curl_exec($ch);
}

$ch =curl_init("http://localhost:28997/BugTrackerREST.svc/Employees");
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