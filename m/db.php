<?php
//функция для подключения соеденения  с базой данных , для постоянного подключения используем СТАТИК для пременной $db
function db_connect()
{
	static $db;

	if ($db === null) {
		$db = new PDO('mysql:host=localhost;dbname=brainforce', 'root', '');
		$db->exec('SET NAMES UTF8');
	}
	return $db;
}

//проверка запроса на ошибки в теле запроса, используем константу безошибочности PDO::ERR_NONE, которая равна 00000, и будет сравниваться с массивом по разбору возможных ошибок. константу вместо её значения 00000 используем потому, что с обновлением версии PHP её значение может измениться на другое.
function db_check_error($query)
{
	$info = $query->errorInfo();
	//если данные из массива возможных ошибок не равны константе PDO::ERR_NONE, то есть при наличии ошибки скрипт прекращает свою работу
	if ($info[0] != PDO::ERR_NONE) {
		exit($info[2]);
	}
}

//функция работы с запросом, в параметре передается тело запроса и параметры для подстановки в тело запроса в виде массива(по умолчанию пустой, и поэтому не всегда указывается )
function db_query($sql, $params = [])
{
	//создаем объект для подключения к базе данных  с помощью функции db_connect
	$db = db_connect();
	//подготовка запроса
	$query = $db->prepare($sql);
	//готовый выполненный запрос с параметрами , который можно впоследствии выводить для SELECT с помощью fetch , fetchAll
	$query->execute($params);
	//проверка тела запроса на ошибки с помощью функции db_check_error
	db_check_error($query);
	return $query;
}

//функция для выборки данных из ОДНОЙ  таблицы 
function select_table($parametrs, $table, $other = "")
{

	$sql = sprintf('SELECT  %s  FROM %s %s', $parametrs, $table, $other);
	$query = db_query($sql);
	// $query = db_query("SELECT $parametrs  FROM $table  $other ;");
	return $query;
}
//функция среднего значения колонки таблицы 
function select_avg($parametrs, $table, $other = "")
{
	$query = db_query("SELECT AVG($parametrs) FROM $table  $other ;");
	return $query;
}
//функция среднего значения колонки таблицы 
function select_sum($parametrs, $table, $other = "")
{
	$query = db_query("SELECT SUM($parametrs) FROM $table  $other ;");
	return $query;
}

//функция минимального значения колонки таблицы 
function select_min($parametrs, $table, $other = "")
{
	// $query = db_query("SELECT MIN(if($parametrs = 0, NULL, $parametrs)) FROM $table  $other ;");
	$query = db_query("SELECT MIN($parametrs) FROM $table   $other ;");
	return $query;
}

//функция максимального значения колонки таблицы 
function select_max($parametrs, $table, $other = "")
{
	$query = db_query("SELECT MAX($parametrs) FROM $table  $other ;");
	return $query;
}
