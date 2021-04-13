<?php   
if($_POST > 0)
{
  // var_dump($_POST);
  $request__1 = $_POST["test__1"];
  $request__2 = $_POST["test__2"]; 
  $sum = $request__1 + $request__2;
  $umno = $request__2 * $request__1;
}
?>

<span>сумма: <div name="sum"><?= $sum;?></div></span>
<span>произведение: <div name="umno"><?= $umno;?></div></span>