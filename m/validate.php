<?php
//функция для передачи последней ошибки
function errors($msg = null)
{
	//делаем статику, что бы ошибка могла сохраниться и её описание могло передаться по запросу в место вызова
	static $last_erorr = '';
	if($msg !== null)
	{
		$last_erorr = $msg;
	}	
	else
	{
		return $last_erorr;
	}
}

function correct_input($content){
	if(mb_strlen($content)<1 || (!preg_match('/^[0-9]*[.,]?[0-9]+$/', $content)))
	{
		errors('Поля не могут быть пустыми и заполняются только цифрами, можно использовать точку!');
					
		return false;
	}
	return true;
}

