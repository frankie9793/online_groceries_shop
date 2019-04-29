<?php

// read the username
$username = $_POST["username"];


// read the quantity of the fruits ordered
$apple_quantity = $_POST["no_of_apple"];
$orange_quantity = $_POST["no_of_orange"];
$banana_quantity = $_POST["no_of_banana"];

// read the payment mode of the user
$payment_mode = $_POST["payment"];

// total amount paid
$total_received = $_POST["total_amount"];

$filename = "order.txt";

// reads the inputs into the file called order.text
// handes case for first time input
if(!file_exists($filename)) {

  $writeable = "Total number of apples:".$apple_quantity."\r\nTotal number of oranges:".$orange_quantity."\r\nTotal number of bananas:".$banana_quantity."\r\n";
  $dummy = file_put_contents($filename,$writeable);

}
else{

  $file = fopen($filename, 'r+') or exit ("unable to open file ($filename)");
  $lines = [];
  while(!feof($file)){
    array_push($lines,fgets($file));
  }

  $apple_old = explode(":",$lines[0]);
  $apple_new = (int)$apple_old[1] + $apple_quantity;
  $writeable1 = rtrim($apple_old[0])." : ".$apple_new."\r\n";

  $orange_old = explode(":",$lines[1]);
  $orange_new = (int)$orange_old[1] + $orange_quantity;
  $writeable2 = rtrim($orange_old[0])." : ".$orange_new."\r\n";

  $banana_old = explode(":",$lines[2]);
  $banana_new = (int)$banana_old[1] + $banana_quantity;
  $writeable3 = rtrim($banana_old[0])." : ".$banana_new."\r\n";

  $writeable = $writeable1.$writeable2.$writeable3;
  file_put_contents($filename,$writeable);

  fclose($file);
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title></title>
   </head>
   <body>

     <header>
       <div class="receiptheader">
         <h1> Thank you for your purchase!</h1>
       </div>
     </header>

     <section>
       <table class="receipt table" >
         <th> Order Receipt </th>
         <tr>
           <td> Username: </td>
           <td> <?php print ("$username"); ?> </td>
         </tr>

         <tr>
           <td> Apple: </td>
           <td> <?php  print ("$apple_quantity"); ?> </td>
         </tr>

         <tr>
           <td> Oranges: </td>
           <td> <?php  print ("$orange_quantity"); ?> </td>
         </tr>

         <tr>
           <td> Bananas: </td>
           <td> <?php  print ("$banana_quantity"); ?> </td>
         </tr>

         <tr>
           <td> Payment via: </td>
           <td> <?php  print ("$payment_mode"); ?> </td>
         </tr>

         <tr>
           <td> Total cost: </td>
           <td> <?php  print ("$total_received"); ?> </td>
         </tr>

       </table>
     </section>

   </body>
 </html>

 <style>
 table{
      font-family: 'Times New Roman Georgia';
      border: 1px solid black;
 }
 th{
   font-size:18pt;
   font-family:'Lato';
 }
 td{
     font-family: 'Lato';
     font-size: 12pt;
     padding: 15px;
     color: black;
     border: 1px solid black;
     text-align: center;
 }
 </style>
