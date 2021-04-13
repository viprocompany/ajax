
$('.filter_2').submit(function (event) {
  event.preventDefault();
  console.log('click');
  $.ajax({
    url: 'ajax.php',
    type: 'POST',
    data: {
      "test__1": document.querySelector('.test__1').value,
      "test__2": document.querySelector('.test__2').value,
    },
    cache: false,
    async: true,
    success: function (data) {
      $(".test").html(data);
    },
    error: function () {
      alert('Error!');
    }
  });
  return false;

});


$('.filter').submit(function (event) {
  event.preventDefault();
  console.log('click');
  $.ajax({
    url: 'ajax_new.php',
    type: 'POST',
    data: {
      "price_select": document.querySelector('.price_select').value,
      "price_min": document.querySelector('.price_min').value,
      "price_max": document.querySelector('.price_max').value,
      "sum_select": document.querySelector('.sum_select').value,
      "limit": document.querySelector('.limit').value
    },
    cache: false,
    async: true,
    success: function (data) {
      $(".ajax").html(data);
    },
    error: function () {
      alert('Error!');
    }
  });
  return false;

});