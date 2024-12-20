<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once "dbconnect.php";

$sql = "select * from menshirts";
try {
    $stmt = $conn->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="viewProducts.css" rel="stylesheet">
    <title>View Product</title>
</head>

<body>
    <main>
        <div>
            <p>
                <?php
                if (isset($_SESSION['insertSuccess'])) {
                    echo "<span class='alert alert-success'>$_SESSION[insertSuccess]</span> ";
                    unset($_SESSION['insertSuccess']);
                }
                if (isset($_SESSION['deleteProductSuccess'])) {
                    echo "<span class='alert alert-success'>$_SESSION[deleteProductSuccess]</span> ";
                    unset($_SESSION['deleteProductSuccess']);
                }
                if (isset($_SESSION['updateSuccess'])) {
                    echo "<span class='alert alert-success'>$_SESSION[updateSuccess]</span> ";
                    unset($_SESSION['updateSuccess']);
                }
                ?>
            </p>
            <input
                type="text"
                id="myInput"
                onkeyup="myFunction()"
                placeholder="Search for category.."
                title="Type in a category" />
            <table id="myTable">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($products)) {
                        foreach ($products as $product) {
                            echo "<tr>";
                            echo "<td data-label='Product ID'>{$product['ID']}</td>";
                            echo "<td data-label='Image'><img src=$product[product_images] style='height:100px;width:75px'></td>";
                            echo "<td data-label='Product Name'>{$product['product_name']}</td>";
                            echo "<td data-label='Price'>{$product['price']}</td>";
                            echo "<td data-label='Description'>{$product['Description']}</td>";

                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </main>
    <Script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
                td = tr[i].getElementsByTagName("td")[3]; // Category column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </Script>
</body>

</html>