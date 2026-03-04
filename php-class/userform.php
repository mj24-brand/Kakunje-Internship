<?php
$name=$email=$website=$gender="";
$nameErr=$emailErr=$websiteErr=$genderErr="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST['name'])){
        $nameErr="Name is required";
    }else{
        $name=$_POST["name"];
    }
    if(empty($_POST['email'])){
        $emailErr="email is required";
    }else{
       $email=$_POST['email'];
       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       echo "invalid email";
}
    }

    if(!empty($_POST["website"])){
        $website=$_POST["website"];
        if(!filter_var($website,FILTER_VALIDATE_URL)){
        echo "invalid url";
}
    }

    if(empty($_POST["gender"])){
        $genderErr="gender is required";
    }else{
        $gender=$_POST["gender"];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Student Form</h2>
    <form action="" method="POST">
        Name:
        <input type="text" name="name">
        <span style="color:red;"><?php echo $nameErr;?></span>
        <br>
        <br>
        Email:
        <input type="text" name="email">
        <span style="color:red;"><?php echo $emailErr;?></span>
        <br>
        <br>
        Website:
        <input type="text" name="website">
        <span style="color:red;"><?php echo $websiteErr;?></span>
        <br>
        <br>
        Gender:
        <input type="radio" name="gender" value="Male">Male
        <input type="radio" name="gender" value="Female">Female
        <span style="color:red;"><?php echo $genderErr;?></span>
        <br>
        <br>
        <input type="submit" value="submit">
    </form>
<?php
if($name && $email && $gender){
    echo "<h3>Form Data:</h3>";
    echo "Name: $name <br>";
    echo "Email: $email <br>";
    echo "Website: $website <br>";
    echo "Gender: $gender <br>";
}
?>
</body>
</html>