<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Add a New Customer</h1>
        <nav>
            <ul>
                <li><a href="restaurant.html" class="home-button">Back to Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php
            // Get the form data
            $email = $_POST['email'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $cellnum = $_POST['cellnum'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $pc = $_POST['pc'];
            // $5.00 credit
            $credit_amount = 5; 

            include 'connectdb.php';

            // Check if the customer already exists Email Prim
            $query = "
            SELECT * FROM CustomerAcct 
            WHERE EmailAddress = '$email'
            ";
            $result = $connection->query($query);

            if ($result->rowCount() > 0) {
                echo "Customer already exists in the database!";
            } else {
                // Add the new customer to the database
                $query = "INSERT INTO CustomerAcct (EmailAddress, Fname, Lname, CellNum, Street, city, PC, CreditAmount) 
                VALUES ('$email', '$fname', '$lname', '$cellnum', '$street', '$city', '$pc', '$credit_amount')";
                $result = $connection->exec($query);
                if ($result) {
                    echo "New customer added successfully!";
            } else {
                    echo "Error: Could not add the new customer.";
                }
            }

            $connection = null;
            ?>
        </section>
    </main>
</body>
</html>

