<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>AJAX test</title>
</head>

<body>
  <div class="container">

    <div class="row ">
      <div class="col-12 border border rounded" id="hello">
        <h1 style="font-weight:900;">Прайс-лист продукции.</h1>
      </div>
    </div>
    <!-- <div class="test"></div> -->
    <!--БЛОК КОНТЕНТ-->
    <div class="row " id="content">
      <div class="col-12  border-info border  rounded" id="center">
        <!--кнопки-->
        <div class="row border-success d-block" id="downald">
          <form class="filter" id="form" method="post">
            <span>Показать товары, у которых </span>
            <select name="price_select" class="price_select">
              <option value="price_retail">Розничная цена</option>
              <option value="price">Оптовая цена</option>
            </select>
            <span>от</span>
            <input type="text" name="price_min" class="price_min" value="1000">
            <span>до</span>
            <input type="text" name="price_max" class="price_max" value="3000" required pattern="[0-9]*[.,]?[0-9]">
            <span>рублей и на складе</span>
            <select name="sum_select" class="sum_select">
              <option value="count_min">Менее</option>
              <option value="count_max">Более</option>
            </select>
            <input type="text" name="limit" class="limit" value="20" required pattern="[0-9]*[.,]?[0-9]">
            <span>штук</span>
            <input type="submit" value="показать товары" class="btn btn-outline-dark test">
          </form>
          <div class="errors_name" style="text-align: center; font-size: 18px;"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="table">

    <div class="test"></div>
    <div class="wrapper">
      <table class="ajax">
        <!--ряд с ячейками заголовков-->
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
       
        include_once('m/validate.php');
        include_once('m/db.php');
        include_once('m/system.php');
        
        include_once("test.php");
     
        //подключаемся к базе данных и предаем составляющие тело запроса в параметре, которое будет проверяться на ошибку с помощью этой же функции
        $query = select_table('name, price_retail,  price, stock_1, stock_2, country, note','pricelist ');
        //создаем массив 
        $my_articles = $query->fetchAll();
        foreach ($my_articles as $message) {
			?>
        <!--ряд с ячейками тела таблицы-->
        <?php
				if ($message['price'] == $min_price) {
				?>
        <tr style="color: #24A424; font-weight: 900;">
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
        <?php } ?>
      </table>
    </div>
  </div>

  <form action="" class="filter_2" method="POST">
    <input type="text" class="test__1" value="1" name="test__1">
    <input type="text" class="test__2" value="1" name="test__2">
    <input type="submit" value="submit">


  </form>
  <div class="test">
    <span>сумма:<div name="sum">2</div></span>
    <span>произведение:<div name="umno">1</div></span>
  </div>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
  </script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
  </script>
  <script src="script.js"></script>
</body>

</html>