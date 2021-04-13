<?php  
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//  include_once('m/validate.php');
 include_once('m/db.php');
//  include_once('m/system.php');
 
//  include_once("test.php");
if($_POST > 0)
{
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
	$query = select_table('name, price_retail,  price, stock_1, stock_2, country, note','pricelist ' , ' WHERE ' . $price_select . ' BETWEEN ' . $price_min . ' AND ' . $price_max . ' AND (stock_1+stock_2) ' . $sum_select . $limit);

	$my_articles = $query->fetchAll();

  ?>
<tr>
  <th>Наименование товара</th>
  <th>Стоимость, руб</th>
  <th>Стоимость опт, руб</th>
  <th>Наличие на складе 1, шт</th>
  <th>Наличие на складе 2, шт</th>
  <th>Страна производства</th>
  <th>Примечание</th>
</tr>
<?php
  foreach ($my_articles as $message) {
    ?>
<!--ряд с ячейками тела таблицы-->
<?php
      if ($message['price'] == $min_price) {
      ?>
<tr class="ajax" style="color: #24A424; font-weight: 900;">
  <?php
      } elseif ($message['price_retail'] == $max_price_retail) {
        ?>
<tr style="color: red; font-weight: 900;">
  <?php
      } else {
        ?>
<tr>
  <?php
      }
        ?>
  <td class="name"><?= $message['name'] ?></td>
  <td class="price_retail"><?= $message['price_retail'] ?></td>
  <td class="price"><?= $message['price'] ?></td>
  <td class="stock_1"><?= $message['stock_1'] ?></td>
  <td class="stock_2"><?= $message['stock_2'] ?></td>
  <td class="country"><?= $message['country'] ?></td>
  <?php
        $count = $message['stock_1'] + $message['stock_2'];
        if ($count < 20) {
        ?>
  <td class="note" style="color: blue; font-weight: 900;">Осталось мало!! Срочно докупите!!!</td>
  <?php
        }
        ?>
  <td class="note"><?= $message['note'] ?></td>
</tr>
<?php }
}
?>