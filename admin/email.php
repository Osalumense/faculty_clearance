<?php
if(isset($_POST['submit'])){
$name = $_POST['name'];
$to = $_POST['email'];
$msg = "Thank you for registering";
$subject = "Thanks";
$header = "New mail";
$success=mail($to,$subject,$msg,$header);
if($success==true){
    echo "Email sent successfully";    
} else{
    echo "Error sending";
}
}
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Send email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form name="sendemail" method="post" action="">
        Name: <input type="text" name="name"></input><p>
        Email: <input type="email" name="email"><p>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>