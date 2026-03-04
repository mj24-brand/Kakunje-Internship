<?php
$name=$email=$age=$gender="";
$nameErr=$emailErr=$ageErr=$genderErr="";

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

   if(empty($_POST['age'])){
        $ageErr="age is required";
    }else{
        $age=$_POST["age"];
        if (!is_numeric($age)){
            $ageErr="Age must be in numericals";
        }elseif ($age<=17){
            $ageErr="Age should be greater than 17";

        }
    }

    if(empty($_POST["gender"])){
        $genderErr="gender is required";
    }else{
        $gender=$_POST["gender"];
    }

    $course=$_POST['course'];
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
    <h2>Student Registration Form</h2>
    <form action="" method="POST">
        Name:
        <input type="text" name="name">
        <span style="color:red;"><?php echo $nameErr;?></span>
        <br>
        <br>
        Email:
        <input type="email" name="email">
        <span style="color:red;"><?php echo $emailErr;?></span>
        <br>
        <br>
        Age:
        <input type="text" name="age">
        <span style="color:red;"><?php echo $ageErr;?></span>
        <br>
        <br>
        Gender:
        <input type="radio" name="gender" value="Male">Male
        <input type="radio" name="gender" value="Female">Female
        <span style="color:red;"><?php echo $genderErr;?></span>
        <br>
        <br>
        Course:
        <select name="course">
        <option value="CSE">CSE</option>
        <option value="EC">EC</option>
        <option value="Mech">Mechanics</option>
        <option value="Civil">Civil</option>
        </select>
        <br>
        <br>
        <input type="submit" value="submit">
    </form>
<?php
if($name && $email && $age && $gender && $course){
    echo "<h3>Registration Successful</h3>";
    echo "Name: $name <br>";
    echo "Email: $email <br>";
    echo "Age: $age <br>";
    echo "Gender: $gender <br>";
     echo "Course: $course <br>";
}
?>
</body>
</html>