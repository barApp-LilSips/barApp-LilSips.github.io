<?php
// Path to your XML file
$xmlFile = 'orders.xml';

// Load the XML file
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);

    // Arrays to store today's and previous orders
    $todaysOrders = [];
    $previousOrders = [];

    // Get today's date
    $today = date('Y-m-d');

    // Iterate through the orders in the XML
    foreach ($xml->order as $order) {
        $orderDate = date('Y-m-d', strtotime((string) $order->timestamp)); // Extract the date portion

        // Check if the order is from today
        $orderArray = [
            'name' => (string) $order->name,
            'drink' => (string) $order->drink,
            'quantity' => (int) $order->quantity,
            'timestamp' => (string) $order->timestamp
        ];

        if ($orderDate === $today) {
            $todaysOrders[] = $orderArray; // Add to today's orders
        } else {
            $previousOrders[] = $orderArray; // Add to previous orders
        }
    }

    // Sort today's orders by timestamp (most recent first)
    usort($todaysOrders, function ($a, $b) {
        return strtotime($b['timestamp']) - strtotime($a['timestamp']);
    });

    // Display today's orders
    echo '<h2>Today\'s Orders:</h2>';
    if (count($todaysOrders) > 0) {
        foreach ($todaysOrders as $order) {
            echo '<p>';
            echo 'Name: ' . $order['name'] . '<br>';
            echo 'Drink: ' . $order['drink'] . '<br>';
            echo 'Quantity: ' . $order['quantity'] . '<br>';
            echo 'Timestamp: ' . $order['timestamp'];
            echo '</p>';
        }
    } else {
        echo '<p>No orders for today!</p>';
    }

    // Display previous orders
    echo '<h2>Previous Orders:</h2>';
    if (count($previousOrders) > 0) {
        foreach ($previousOrders as $order) {
            echo '<p>';
            echo 'Name: ' . $order['name'] . '<br>';
            echo 'Drink: ' . $order['drink'] . '<br>';
            echo 'Quantity: ' . $order['quantity'] . '<br>';
            echo 'Timestamp: ' . $order['timestamp'];
            echo '</p>';
        }
    } else {
        echo '<p>No previous orders!</p>';
    }
} else {
    echo '<p>No orders file found!</p>';
}
?>