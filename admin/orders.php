<?php
include("header.php");
// Pagination logic
$limit = 5; // Number of entries to show in a page.
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
;
$start_from = ($page - 1) * $limit;

// Fetch orders from database
$sql = "SELECT * FROM orders LIMIT $start_from, $limit";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'links.php'; ?>
    <title>Home</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                <?php include "sidemenu.php"; ?>
            </div>
            <div class="col-9">
                <h2>Orders</h2>
                <table class="table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>User ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>{$row['order_id']}</td>
                                <td>{$row['order_status']}</td>
                                <td>{$row['user_id']}</td>
                                <td>
                                    <a href='update_order.php?id={$row['order_id']}' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='delete_order.php?id={$row['order_id']}' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                              </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No orders found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                // Pagination buttons
                $sql = "SELECT COUNT(order_id) FROM orders";
                $result = $conn->query($sql);
                $row = $result->fetch_row();
                $total_records = $row[0];
                $total_pages = ceil($total_records / $limit);
                $pagLink = "<nav><ul class='pagination'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=" . $i . "'>" . $i . "</a></li>";
                }
                echo $pagLink . "</ul></nav>";
                $conn->close();
                ?>
            </div>

        </div>
    </div>
</body>

</html>