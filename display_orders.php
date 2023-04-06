<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Orders History</h1>
        <nav>
            <ul>
                <li><a href="restaurant.html" class="home-button">Back to Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php
            $date = $_POST["date"];
            echo "<h2>Orders on " . $date . ":</h2>";
            echo "<ol>";
            include 'connectdb.php';

            $query = "
            SELECT c.Fname, c.Lname, f.Foodname, o.TotalPrice, o.Tip, e.Fname AS deF, e.Lname AS deL 
            FROM OnlineOrder o 
            JOIN CustomerAcct c ON o.OrderId = c.OrderId 
            JOIN Contain ct ON o.OrderId = ct.OrderId 
            JOIN Food f ON ct.Foodname = f.Foodname 
            JOIN DeliveryEmployee de ON o.OrderId = de.OrderId 
            JOIN Employee e ON de.ID = e.EmployeeID 
            JOIN Payment p ON c.EmailAddress = p.CustomerE 
            WHERE p.Day = '$date'";

            if ($result = $connection->query($query)) {
                if ($result->rowCount() == 0) {
                    echo "No orders found on this date.";
                } else {
                 while ($row = $result->fetch()) {
                    echo "<li>Customer Name: " . $row["Fname"] . " " . $row["Lname"] . ", Item Ordered: " . $row["Foodname"] . ", Total Amount: $" . $row["TotalPrice"] . ", Tip: $" . $row["Tip"] . ", Delivered by: " . $row["deF"] . " " . $row["deL"] . "</li>";
                    }
                }
            } else {
                echo "Error: " . $connection->errorInfo()[2];
            }

            $connection = NULL;
            ?>
        </section>
    </main>
</body>
</html>
