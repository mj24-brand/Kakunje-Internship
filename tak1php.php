<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $x = 5;
    echo $x++;
    echo "<br>"
        ?>

    <?php
    $x = 5;
    echo ++$x;
    ?>

    <?php
    echo "<br>";
    $a = 10;
    $b = "10";
    var_dump($a == $b);
    var_dump($a === $b);
    ?>

    <?php
    echo "<br>";
    $x = 0;
    if ($x) {
        echo "True";
    } else {
        echo "False";
    }
    ?>

    <?php
    echo "<br>";
    $x = "20abc";
    echo $x + 10;
    ?>

    <?php
    echo "<br>";
    for ($i = 1; $i <= 3; $i++) {
        echo $i;
    }
    ?>

    <?php
    echo "<br>";
    $i = 1;
    while ($i <= 3) {
        echo $i;
        $i++;
    }
    ?>

    <?php
    echo "<br>";
    $colors = ["Red", "Blue"];
    echo count($colors);
    ?>
</body>

</html>