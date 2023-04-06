<!DOCTYPE html>
<html>
<head>
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
            <table>
                <tr>
                <th>Date</th>
                <th>Number of Orders</th>
                </tr>
                <?php
                include 'connectdb.php';

                $query = "
                SELECT p.Day AS OrderDate, COUNT(*) AS NumOrders
                FROM Payment p
                GROUP BY p.Day;
                ";
                $result = $connection->query($query);

                while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row["OrderDate"] . "</td>";
                    echo "<td>" . $row["NumOrders"] . "</td>";
                    echo "</tr>";
                }
                $connection = NULL;
                ?>
            </table>
        </section>
    </main>
</body>
</html>

