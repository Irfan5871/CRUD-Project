<?php 

$bakso_medan = [
    
    ["Bakso Mercon", "Bakso Kecil", " Bakso Besar", 
            "20.000", "Pedas"],
    
    ["Bakso Biasa", "Bakso Kecil", " Bakso Besar", 
            "10.000", "Hangat"]
        
     ];


?>

<!DOCTYPE html> 
<html> 
<head> 

<title> Bakso loh we</title>


</head>
<body> 

<h1> Bakso </h1>
<?php foreach( $bakso_medan as $bs) ?>

<li> <?php echo $bakso_medan[0] [0]; ?> </li>
<li> <?php echo $bs[1] [1]; ?> </li>
<li> <?php echo $bs[2] [2]; ?> </li>
<li> <?php echo $bs[3] [3]; ?> </li>
<li> <?php echo $bs[4] [4]; ?> </li>


</body>
</html>