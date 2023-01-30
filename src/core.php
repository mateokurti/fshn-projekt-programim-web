<?php
$servername = "db";
$username = "root";
$password = "root";
$database = "demo_fshn";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

function sanitize($connection, $data) {
    return strip_tags(htmlentities(mysqli_real_escape_string($connection, trim($data))));
}

function get_order_count_by_product($connection) {
    $query = "SELECT products.name, SUM(order_items.amount) AS order_count
              FROM products
              JOIN order_items ON products.id = order_items.product_id
              GROUP BY products.name";

    $result = mysqli_query($connection, $query);

    $products = array();

    while ($row = mysqli_fetch_array($result)) {
        $products[] = array(
            "name" => $row["name"],
            "orders" => (int)$row["order_count"]
        );
    }

    return $products;
}

function get_yearly_order_count_by_month($connection, $year) {
    $query = "SELECT DATE_FORMAT(orders.date, '%Y-%m') AS month, COUNT(orders.id) AS order_count
              FROM orders
              WHERE YEAR(orders.date) = $year
              GROUP BY DATE_FORMAT(orders.date, '%Y-%m')
              ORDER BY month ASC";

    $result = mysqli_query($connection, $query);

    $orders = array();
    while ($row = mysqli_fetch_array($result)) {
        $orders[] = array(
            "month" => $row["month"],
            "orders" => (int)$row["order_count"]
        );
    }

    return $orders;
}

?>
