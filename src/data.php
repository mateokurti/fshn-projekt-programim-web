<?php
include 'core.php';

if (isset($_GET['query']) && $_GET['query'] == 'orders') {
  
  if (isset($_GET['year'])) {
    $year = sanitize($connection, $_GET['year']);
  } else {
    $year = date('Y');
  }

  $data = get_yearly_order_count_by_month($connection, $year);
} else {
  $data = get_order_count_by_product($connection);
}

echo json_encode($data);

?>
