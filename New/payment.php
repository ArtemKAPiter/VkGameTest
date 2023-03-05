<?php
header("Content-Type: application/json; encoding=utf-8");

$secret_key = 'aKGMho0308pu9Xul29UL'; // Защищённый ключ приложения
               

$input = $_POST;

// Проверка подписи
$sig = $input['sig'];
unset($input['sig']);
ksort($input);
$str = '';
foreach ($input as $k => $v) {
  $str .= $k.'='.$v;
}

if ($sig != md5($str.$secret_key)) {
  $response['error'] = array(
    'error_code' => 10,
    'error_msg' => 'Несовпадение вычисленной и переданной подписи запроса.',
    'critical' => true
  );
} else {
  // Подпись правильная
  switch ($input['notification_type']) {
    case 'get_item':
      // Получение информации о товаре
      $item = $input['item']; // наименование товара

      if ($item == 'zuzi_sale_item_5') {
        $response['response'] = array(
          'item_id' => 5,
          'title' => '500 монеток',
          'photo_url' => '',
          'price' => 5
        );
      }
	  if ($item == 'zuzi_sale_item_10') {
        $response['response'] = array(
          'item_id' => 10,
          'title' => '1500 монеток',
          'photo_url' => '',
          'price' => 10
        );
      } 
	  if ($item == 'zuzi_sale_item_20') {
        $response['response'] = array(
          'item_id' => 20,
          'title' => '5000 монеток',
          'photo_url' => '',
          'price' => 20
        );
      } 
	  if ($item == 'zuzi_sale_item_50') {
        $response['response'] = array(
          'item_id' => 50,
          'title' => '15000 монеток',
          'photo_url' => '',
          'price' => 50
        );
      } 
      if ($item == 'zuzi_sale_item_100') {
        $response['response'] = array(
          'item_id' => 50,
          'title' => '15000 монеток',
          'photo_url' => '',
          'price' => 100
        );
      } 

     if ($item == 'zuzi_sale_item_15_butterfly') {
        $response['response'] = array(
          'item_id' => 5,
          'title' => '50 конфеток',
          'photo_url' => '',
          'price' => 19
        );
      } 
	  if ($item == 'zuzi_sale_item_30_butterfly') {
        $response['response'] = array(
          'item_id' => 30,
          'title' => '150 конфеток',
          'photo_url' => '',
          'price' => 49
        );
      }
      if ($item == 'zuzi_sale_item_50_butterfly') {
        $response['response'] = array(
          'item_id' => 50,
          'title' => '500 конфеток',
          'photo_url' => '',
          'price' => 99
        );
      }
      
	   
      break;

    case 'get_item_test':
      // Получение информации о товаре в тестовом режиме
      $item = $input['item']; // наименование товара

      if ($item == 'zuzi_sale_item_5') {
        $response['response'] = array(
          'item_id' => 5,
          'title' => '500 монеток',
          'photo_url' => '',
          'price' => 5
        );
      }
	  if ($item == 'zuzi_sale_item_10') {
        $response['response'] = array(
          'item_id' => 10,
          'title' => '1500 монеток',
          'photo_url' => '',
          'price' => 10
        );
      } 
	  if ($item == 'zuzi_sale_item_20') {
        $response['response'] = array(
          'item_id' => 20,
          'title' => '5000 монеток',
          'photo_url' => '',
          'price' => 20
        );
      } 
	  if ($item == 'zuzi_sale_item_50') {
        $response['response'] = array(
          'item_id' => 50,
          'title' => '15000 монеток',
          'photo_url' => '',
          'price' => 50
        );
      } 
      if ($item == 'zuzi_sale_item_100') {
        $response['response'] = array(
          'item_id' => 50,
          'title' => '15000 монеток',
          'photo_url' => '',
          'price' => 100
        );
      } 

     if ($item == 'zuzi_sale_item_15_butterfly') {
        $response['response'] = array(
          'item_id' => 5,
          'title' => '50 конфеток',
          'photo_url' => '',
          'price' => 19
        );
      } 
	  if ($item == 'zuzi_sale_item_30_butterfly') {
        $response['response'] = array(
          'item_id' => 30,
          'title' => '150 конфеток',
          'photo_url' => '',
          'price' => 49
        );
      }
      if ($item == 'zuzi_sale_item_50_butterfly') {
        $response['response'] = array(
          'item_id' => 50,
          'title' => '500 конфеток',
          'photo_url' => '',
          'price' => 99
        );
      }
      
	   
      break;

    case 'order_status_change':
      // Изменение статуса заказа
      if ($input['status'] == 'chargeable') {
        $order_id = intval($input['order_id']);

        // Код проверки товара, включая его стоимость
        $app_order_id = 1; // Получающийся у вас идентификатор заказа.

        $response['response'] = array(
          'order_id' => $order_id,
          'app_order_id' => $app_order_id,
        );
      } else {
        $response['error'] = array(
          'error_code' => 100,
          'error_msg' => 'Передано непонятно что вместо chargeable.',
          'critical' => true
        );
      }
      break;

    case 'order_status_change_test':
      // Изменение статуса заказа в тестовом режиме
      if ($input['status'] == 'chargeable') {
        $order_id = intval($input['order_id']);

        $app_order_id = 1; // Тут фактического заказа может не быть — тестовый режим.

        $response['response'] = array(
          'order_id' => $order_id,
          'app_order_id' => $app_order_id,
        );
      } else {
        $response['error'] = array(
          'error_code' => 100,
          'error_msg' => 'Передано непонятно что вместо chargeable.',
          'critical' => true
        );
      }
      break;
  }
}

echo json_encode($response);
?>