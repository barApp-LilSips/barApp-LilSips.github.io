<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mangojito</title>
    <link rel="icon" type="image/png" href="../pics/logo_white.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&family=Moirai+One&family=Poiret+One&family=Sarala:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
  <a href="../home.html">
    <div id="topNav">
        <img id="logo" src="../pics/logo.png" />
      <h1 class="title">Lil' Sips Cocktail Bar</h1>
    </div>
</a>
    <h3 id="par">Broken Negroni Cocktail</h3>
    <svg width="100%" height="50">
      <path
        d="M0 25 Q 50 0, 100 25 T 200 25 T 300 25 T 400 25 T 500 25 T 600 25 T 700 25 T 800 25 T 900 25 T 1000 25 T 1100 25 T 1200 25 T 1300 25 T 1400 25 T 1500 25 T 1600 25 T 1700 25 T 1800 25 T 1900 25 T 2000 25"
        stroke="#ff6f61"
        fill="transparent"
        stroke-width="4"
      />
    </svg>
    <div class="imgCont">
      <img id="drinkPicRec" src="../pics/negroniRec.jpeg" />
      <form method="post" name="">
        <input type="submit" name="mangojito" class="circle-button" value="ORDER">
      </form>
      <?php 
     
      if (isset($_POST["mangojito"])) {
        echo "
        <form method='post' name='orderForm' class='form'>
        <h3>Enter Your Name: </h3>
        <input type='text' name='name' required='true'>
        <h3>Drink: </h3>
        <select id='drink' name='drink'>
          <option name='drink' value='Mangojito'>Mangojito</option>
          <option value='Grapefruit Spritz'>Grapefruit Spritz</option>
          <option value='Berry Gin Fizz'>Berry Gin Fizz</option>
          <option value='Cocorita'>Cocorita</option>
          <option value='Espresso Martini'>Espresso Martini </option>
          <option value='Negroni' selected>Negroni</option>
        </select>
        <h3>Quantity: </h3>
        <input name='quantity' type='number' value='1' step='1' min='1'><br>
        <input type='submit' name='submitOrder' class='submit-button' value='SEND ORDER'>
        </form>
        
        ";
      }
      
     

// Adding an order with detailed information

// XML file path
$xmlFile = 'orders.xml';

// Create the XML file if it doesn't exist
if (!file_exists($xmlFile)) {
    $newXml = new SimpleXMLElement('<orders></orders>');
    $newXml->asXML($xmlFile);
}

// Adding an order to the XML file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['drink'], $_POST['quantity'])) {
  echo "<div id='sent'>
  <h3>Order Sent, Coming Right Up!</h3>
  </div>" ;
  
  // Load the existing XML file
    $xml = simplexml_load_file($xmlFile);

    // Add new order to the XML
    $order = $xml->addChild('order');
    $order->addChild('name', htmlspecialchars($_POST['name']));
    $order->addChild('drink', htmlspecialchars($_POST['drink']));
    $order->addChild('quantity', (int)$_POST['quantity']);
    $order->addChild('timestamp', date('Y-m-d H:i:s')); // Add the current date and time

    // Save the updated XML back to the file
    $xml->asXML($xmlFile);
    header('Refresh: 2; URL=../home.html');
exit(); 
}


?>

    <h3 class="desOrngRec">Broken Negroni Recipe - 1 Serving</h3>
    <ul class="recipe">
      <li>1.5oz Sweet Vermouth</li>
      <li>1.5oz Campari</li>
      <li>1.5oz Prosecco</li>
    </ul>
    <p class="description">
      A reimagined, blubby verion of a classic negroni. The broken negroni
      replaces the gin with prosecco!
    </p>
  </body>
</html>
