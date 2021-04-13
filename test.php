<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE);



//выбор опшина из селектора по виду типу цены
$price_select = "";
//нижний предел поиска по цене
$price_min = "";
//верхний предел поиска по цене
$price_max = "";
//выбор опшина из селектора по направлению поиска : ВВЕРХ или ВНИЗ по значениям количества на складах
$sum_select = "";
//искомое количество товара на складе
$limit = "";

$msg = "";

// менять запись isPost()
// if(count($_POST) > 0){
// var_dump(isPost());
if(isPost()){
	$price_select = trim($_POST['price_select']);
	// echo $price_select;

	$price_min = trim($_POST['price_min']);

// echo $price_min;
	$price_max = trim($_POST['price_max']);
// echo $price_max;
	$sum_select = trim($_POST['sum_select']);	

	if($sum_select == 'count_min'){
		$sum_select = '<';
	}
	else{
		$sum_select = '>';
	}
// echo $sum_select;
	$limit = trim($_POST['limit']);
	// echo $limit;

	//проверка корректности данных , вводимых в инпуты
		if(!correct_input($price_min))
	{		
		$msg = errors();
	}	
			elseif(!correct_input($price_max))
	{		
		$msg = errors();
	}
				elseif(!correct_input($limit))
	{		
		$msg = errors();
	}
else{
	$query = select_table('name, price_retail,  price, stock_1, stock_2, country, note','pricelist ' , ' WHERE ' . $price_select . ' BETWEEN ' . $price_min . ' AND ' . $price_max . ' AND (stock_1+stock_2) ' . $sum_select . $limit);

	$my_articles = $query->fetchAll();
}

}