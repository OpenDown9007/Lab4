<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Order</title>
</head>
<body>
    <h2>Pizza Order Form</h2>
    <form method="post" action="">
        <label for="size">Select Pizza Size:</label><br>
        <input type="radio" name="size" value="small" checked> Small ($5)<br>
        <input type="radio" name="size" value="medium"> Medium ($7)<br>
        <input type="radio" name="size" value="large"> Large ($9)<br><br>

        <label for="toppings">Select Toppings:</label><br>
        <input type="checkbox" name="toppings[]" value="pepperoni"> Pepperoni ($0.50 / $1 / $1.50)<br>
        <input type="checkbox" name="toppings[]" value="mushrooms"> Mushrooms ($0.50 / $1 / $1.50)<br>
        <input type="checkbox" name="toppings[]" value="onions"> Onions ($0.50 / $1 / $1.50)<br>
        <input type="checkbox" name="toppings[]" value="sausage"> Sausage ($0.50 / $1 / $1.50)<br><br>

        <input type="submit" name="submit" value="Place Order">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Pizza Prices
        $prices = [
            "small" => 5,
            "medium" => 7,
            "large" => 9,
        ];

        // Toppings Prices
        $toppingPrice = [
            "pepperoni" => ["small" => 0.50, "medium" => 1, "large" => 1.50],
            "mushrooms" => ["small" => 0.50, "medium" => 1, "large" => 1.50],
            "onions" => ["small" => 0.50, "medium" => 1, "large" => 1.50],
            "sausage" => ["small" => 0.50, "medium" => 1, "large" => 1.50],
        ];

        // Calculate total cost
        $size = $_POST["size"];
        $toppings = isset($_POST["toppings"]) ? $_POST["toppings"] : [];

        $totalCost = $prices[$size];

        foreach ($toppings as $topping) {
            $totalCost += $toppingPrice[$topping][$size];
        }

        // Display order details
        echo "<h3>Order Details:</h3>";
        echo "Size: $size<br>";
        echo "Toppings: " . implode(", ", $toppings) . "<br>";
        echo "Total Cost: $" . number_format($totalCost, 2);
    }
    ?>
</body>
</html>
