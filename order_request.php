<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jade Delight Pt.2 Order Summary</title>
    <link href="style.css" rel="stylesheet" />
    <style type='text/css'>
        body {font-size: 25px;}
        /* .costDiv {display: inline;} */
        .bg-cover {
            /* background-size: cover !important; */
            height: 380px;
        }
        .bg-cover h1 {
        position:absolute;
        text-align:right;

        font-size:100px;
        color:#FFF;
        left:550px;
        top:80px;
        }
        body {
        padding:0;
        margin:0;
        }
        .summary {
        padding: 10px;
        margin: 20px;
        }
        .form_table {
        display: grid;
        /* grid-template-columns: 1fr 1fr 1fr 1fr ; */
        grid-template-columns: 300px 300px 300px 300px;
        grid-gap: 20px;
        }
        .submit {
            background-color:rgb(238, 105, 16);
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>

    <div style="background: url(dumplings.jpg)" class="jumbotron bg-cover text-white">
        <div class="container py-5 text-center">
            <h1 class="display-4 font-weight-bold">Jade Delight Pt.2</h1>
        </div>
    </div>

    <div class="summary">
    <h2>Order Summary</h2>

    <?php
    $fname = $_REQUEST["fname"];
    $lname = $_REQUEST["lname"];
    $street = $_REQUEST["street"];
    $city = $_REQUEST["city"];
    $phone = $_REQUEST["phone"];
    $NumItems1 = $_REQUEST["NumItems1"];
    $NumItems2 = $_REQUEST["NumItems2"];
    $NumItems3 = $_REQUEST["NumItems3"];
    $NumItems4 = $_REQUEST["NumItems4"];
    $NumItems5 = $_REQUEST["NumItems5"];
    $cost1 = $_REQUEST["cost1"];
    $cost2 = $_REQUEST["cost2"];
    $cost3 = $_REQUEST["cost3"];
    $cost4 = $_REQUEST["cost4"];
    $cost5 = $_REQUEST["cost5"];
    $subtotal = $_REQUEST["subtotal"];
    $tax = $_REQUEST["tax"];
    $total = $_REQUEST["total"];
    $order_ready_time = $_REQUEST["order_ready_time"];



    echo "Order For: ";
    echo $_POST["fname"];
    echo " ";
    echo $_POST["lname"];
    echo "<br>";

    //establish connection info
    $server = "sql311.epizy.com";
    $userid = "epiz_30316465";
    $pw = "5JjJCsrFsT";
    $db= "epiz_30316465_jade_delight_pt2";

    // Create connection
    $conn = new mysqli($server, $userid, $pw );

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully<br>";

    //select the database
    $conn->select_db($db);

    //run a query
    $sql = "SELECT * FROM products";
    //   echo "<br />The query is: " . $sql ."<br />";
    $result = $conn->query($sql);

    echo "<div class='form_table'>";

    echo "<h3>Item Quantity</h3>";
    echo "<h3>Item Name</h3>";
    echo "<h3>Cost Each</h3>";
    echo "<h3>Total Cost</h3>";
    //////////////////////////////////////////////////
    $row = $result->fetch_array();
    if ($NumItems1 > 0) {
        echo "<p>$NumItems1</p>";
        $type = $row['ItemName'];
        echo "<p>$type</p>";
        $type = $row['CostEach'];
        echo " <p>$type</p>";
        echo "<p>$cost1</p>";
    }
    //////////////////////////////////////////////////
    $row = $result->fetch_array();
    if ($NumItems2 > 0) {
        echo "<p>$NumItems2</p>";
        $type = $row['ItemName'];
        echo "<p>$type</p>";
        $type = $row['CostEach'];
        echo " <p>$type</p>";
        echo "<p>$cost2</p>";
    }
    //////////////////////////////////////////////////
    $row = $result->fetch_array();
    if ($NumItems3 > 0) {
        echo "<p>$NumItems3</p>";
        $type = $row['ItemName'];
        echo "<p>$type</p>";
        $type = $row['CostEach'];
        echo " <p>$type</p>";
        echo "<p>$cost3</p>";
    }
    //////////////////////////////////////////////////
    $row = $result->fetch_array();
    if ($NumItems4 > 0) {
        echo "<p>$NumItems4</p>";
        $type = $row['ItemName'];
        echo "<p>$type</p>";
        $type = $row['CostEach'];
        echo " <p>$type</p>";
        echo "<p>$cost4</p>";
    }
    //////////////////////////////////////////////////
    $row = $result->fetch_array();
    $quantity = $row["NumItems"];
    if ($NumItems5 > 0) {
        echo "<p>$NumItems5</p>";
        $type = $row['ItemName'];
        echo "<p>$type</p>";
        $type = $row['CostEach'];
        echo " <p>$type</p>";
        echo "<p>$cost5</p>";
    }
    //////////////////////////////////////////////////
    echo "</div>";

    // free results set
    $result->free();
    //close the connection
    $conn->close();

    echo "<br><br>";
    echo "Subtotal: ";
    echo $_POST["subtotal"];
    echo "<br>Tax: ";
    echo $_POST["tax"];
    echo "<br> Total: ";
    echo $_POST["total"];
    echo "<br>";
    echo "<br>";
    echo "Order Ready Time: ";
    echo "$order_ready_time<br>";

    $message = "Thank you for your order! Your order total is ";
    $message .= $total;
    $message .= ". Your order will be ready at ";
    $message .= $order_ready_time;

    if (!is_null($street)) {
        $message .= " for delivery. It will be delivered to ";
        $message .= $street;
        $message .= " ";
        $message .= $city;
        $message .= ".";
    }
    else {
        $message .= " for pickup";
    }
    mail("asma.halwany@yahoo.com", "Your Jade Delight Order Summary", $message);

    ?>
    </div>
</body>
</html>
