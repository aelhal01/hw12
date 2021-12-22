<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Jade Delight Pt.2</title>
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
    form {
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
        font-size: 25px;
    }
    input[type=text] {
      font-size: 20px;
      padding:5px;
      border:2px solid #ccc;
      -webkit-border-radius: 5px;
      border-radius: 5px;
    }
    select[type=text] {
      font-size: 100%;
      padding:5px;
      border:2px solid #ccc;
      -webkit-border-radius: 5px;
      border-radius: 5px;
    }
  </style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>

<script language="javascript">

      function PorD_Check() {
        if (document.getElementById('delivery').checked) {
          document.getElementById('reveal-if-active').style.visibility = 'visible';
        }
        else { document.getElementById('reveal-if-active').style.visibility = 'hidden';
        }
      }

      function calc_tax(subtotal) {
        tax = (subtotal * .0625).toFixed(2);
        document.getElementById("tax").value = tax;
        return tax;
      }

      function calc_total(subtotal, tax) {
        total = ((1 * subtotal) + (1 * tax)).toFixed(2);
        document.getElementById("total").value = total;
      }

      $(document).ready(function(){
        $("select").change(function() { //if one of the selects are changed
          quan = this.selectedIndex;  //gets selected quantity
          rowIndex = this.name.substring(8); // gets index of menu item (1-5)
          if (rowIndex == 1) {
            var priceIndex = document.getElementById('CostEach1').getAttribute('data-value');
            document.getElementById("cost1").value = (quan * priceIndex).toFixed(2);
          }
          else if (rowIndex == 2) {
            var priceIndex = document.getElementById('CostEach2').getAttribute('data-value');
            document.getElementById("cost2").value = (quan * priceIndex).toFixed(2);
          }
          else if (rowIndex ==3) {
            var priceIndex = document.getElementById('CostEach3').getAttribute('data-value');
            document.getElementById("cost3").value = (quan * priceIndex).toFixed(2);
          }
          else if (rowIndex == 4) {
            var priceIndex = document.getElementById('CostEach4').getAttribute('data-value');
            document.getElementById("cost4").value = (quan * priceIndex).toFixed(2);
          }
          else if (rowIndex == 5) {
            var priceIndex = document.getElementById('CostEach5').getAttribute('data-value');
            document.getElementById("cost5").value = (quan * priceIndex).toFixed(2);
          }
          updateTotal();
        })
        function updateTotal(){
          cost1 = 1 * document.getElementById("cost1").value;
          cost2 = 1 * document.getElementById("cost2").value;
          cost3 = 1 * document.getElementById("cost3").value;
          cost4 = 1 * document.getElementById("cost4").value;
          cost5 = 1 * document.getElementById("cost5").value;
          subtotal = 0;
          subtotal = cost1 + cost2 + cost3 + cost4 + cost5;
          document.getElementById("subtotal").value = (subtotal * 1).toFixed(2);
          tax = calc_tax(subtotal);
          calc_total(subtotal, tax);
        }
      })

      function validphonenum() {
        var phone = document.getElementById("phone").value;
        var phoneRegex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

        if (phoneRegex.test(phone)) {
          return true;
        }
        else {
          return false;
        }
      }

      function addMinutes(date, minutes) {
        return new Date(date.getTime() + minutes*60000);
      }

      function validateForm() {
        var formisvalid = false;
        let lastname = document.getElementById("lname").value;
        let subtotal = document.getElementById("subtotal").value;
        let street = document.getElementById("street").value;
        let city = document.getElementById("city").value;
        var today = new Date();

        if (lastname == "") {
          alert("Last name must be filled out");
          return formisvalid;
        }
        else if (!validphonenum()) {
          alert("Phone number must be valid ten-digit number");
          return formisvalid;
        }
        else if (subtotal == 0) {
          alert("Must order at least one item");
          return formisvalid;
        }
        else if (document.getElementById('delivery').checked) {
          if (street == "") {
            alert("Street must be filled out");
            return formisvalid;
          }
          else if (city == "") {
            alert("City must be filled out");
            return formisvalid;
          }
          formisvalid = true;
          var temp_today = addMinutes(today, 30);
          var temp_minutes = temp_today.getMinutes();
          if (temp_minutes < 10) {
            temp_minutes = "0" + temp_minutes;
          }
          var pickup_time = temp_today.getHours() + ":" + temp_minutes;
          document.getElementById("order_ready_time").value = pickup_time;
          return formisvalid;
        }
        else {
          formisvalid = true;
          var temp_today = addMinutes(today, 15);
          var temp_minutes = temp_today.getMinutes();
          if (temp_minutes < 10) {
            temp_minutes = "0" + temp_minutes;
          }
          var pickup_time = temp_today.getHours() + ":" + temp_minutes;
          document.getElementById("order_ready_time").value = pickup_time;
        }
        return formisvalid;
      }

</script>

<div style="background: url(dumplings.jpg)" class="jumbotron bg-cover text-white">
    <div class="container py-5 text-center">
        <h1 class="display-4 font-weight-bold">Jade Delight Pt.2</h1>
    </div>
</div>

<form id="order_form" action ='order_request.php' onSubmit="return validateForm()" method='post'>

    <p>First Name: <input type="text"  id='fname' name='fname' /></p>
    <p>Last Name*:  <input type="text" id="lname"  name='lname' /></p>

    <div id="reveal-if-active" style="visibility: hidden">
        <p>Street: <input id="street" type="text"  name='street' /></p>
        <p>City: <input id="city" type="text"  name='city' /></p>
    </div>

    <p>Phone*: <input type="text" id="phone" name='phone' /></p>
    <p>
        <input id="pickup" type="radio"  onclick=PorD_Check() name="p_or_d" value = "pickup" checked="checked"/>Pickup
        <input id="delivery" type="radio"  onclick=PorD_Check() name='p_or_d' value = 'delivery'/>
        Delivery
    </p>

  <?php
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
//   echo "Connected successfully<br>";

  //select the database
  $conn->select_db($db);

  //run a query
  $sql = "SELECT * FROM products";
  $result = $conn->query($sql);


echo "<div class='form_table'>";

echo "<h3>Select Item</h3>";
echo "<h3>Item Name</h3>";
echo "<h3>Cost Each</h3>";
echo "<h3>Total Cost</h3>";
/////////////////////////////////////////////////////////////////////////////////////////
echo "<select name ='NumItems1'>";
$range = range(0, 10);
foreach ($range as $num) {
    echo "<option value='$num'>$num</option>";
}
echo "</select> ";
$row = $result->fetch_array();
$ItemName1 = $row['ItemName'];
echo "<div id='ItemName1' class='costDiv' data-value='$ItemName1'>$ItemName1 </div>";
$CostEach1 = $row['CostEach'];
echo "<div id='CostEach1' class='costDiv' data-value='$CostEach1'>$CostEach1 </div>";
echo "<input type='text' id='cost1' name='cost1'/>";
//////////////////////////////////////////////////////////////////////////////////////////
echo "<select name ='NumItems2'>";
$range = range(0, 10);
foreach ($range as $num) {
    echo "<option value='$num'>$num</option>";
}
echo "</select> ";
$row = $result->fetch_array();
$ItemName2 = $row['ItemName'];
echo "<div id='ItemName2' class='costDiv' data-value='$ItemName2'>$ItemName2 </div>";
$CostEach2 = $row['CostEach'];
echo "<div id='CostEach2' class='costDiv' data-value='$CostEach2'>$CostEach2 </div>";
echo "<input type='text' id='cost2' name='cost2'/>";
//////////////////////////////////////////////////////////////////////////////////////////
echo "<select name ='NumItems3'>";
$range = range(0, 10);
foreach ($range as $num) {
    echo "<option value='$num'>$num</option>";
}
echo "</select> ";
$row = $result->fetch_array();
$ItemName3 = $row['ItemName'];
echo "<div id='ItemName3' class='costDiv' data-value='$ItemName3'>$ItemName3 </div>";
$CostEach3 = $row['CostEach'];
echo "<div id='CostEach3' class='costDiv' data-value='$CostEach3'>$CostEach3 </div>";
echo "<input type='text' id='cost3' name='cost3'/>";
//////////////////////////////////////////////////////////////////////////////////////////
echo "<select name ='NumItems4'>";
$range = range(0, 10);
foreach ($range as $num) {
    echo "<option value='$num'>$num</option>";
}
echo "</select> ";
$row = $result->fetch_array();
$ItemName4 = $row['ItemName'];
echo "<div id='ItemName4' class='costDiv' data-value='$ItemName4'>$ItemName4 </div>";
$CostEach4 = $row['CostEach'];
echo "<div id='CostEach4' class='costDiv' data-value='$CostEach4'>$CostEach4 </div>";
echo "<input type='text' id='cost4' name='cost4'/>";
//////////////////////////////////////////////////////////////////////////////////////////
echo "<select name ='NumItems5'>";
$range = range(0, 10);
foreach ($range as $num) {
    echo "<option value='$num'>$num</option>";
}
echo "</select> ";
$row = $result->fetch_array();
$ItemName5 = $row['ItemName'];
echo "<div id='ItemName5' class='costDiv' data-value='$ItemName5'>$ItemName5 </div>";
$CostEach5 = $row['CostEach'];
echo "<div class='costDiv' id='CostEach5' data-value='$CostEach5'>$CostEach5 </div>";
echo "<input type='text' id='cost5' name='cost5'/>";
//////////////////////////////////////////////////////////////////////////////////////////

echo "</div>";
  // free results set
  $result->free();
  //close the connection
  $conn->close();

  ?>

    <p>Subtotal: $<input type="text"  name='subtotal' id="subtotal" /></p>
    <p>Mass tax 6.25%: $ <input type="text"  name='tax' id="tax" /></p>
    <p>Total: $ <input type="text"  name='total' id="total" /></p>

    <input type = "submit" id="submit_button" value = "Submit Order" class='submit'/>

    <input type="text"  name='order_ready_time' id="order_ready_time" style="visibility: hidden" />

</form>

</body>
</html>
