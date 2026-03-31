<?php
// 1. ភ្ជាប់ទៅកាន់ Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "restaurant_db";

$conn = new mysqli($host, $user, $pass, $db);

// ពិនិត្យការតភ្ជាប់
if ($conn->connect_error) {
    die("ការតភ្ជាប់បរាជ័យ: " . $conn->connect_error);
}

// 2. សរសេរ Query ដើម្បីទាញទិន្នន័យ
$sql = "SELECT id, table_number, total, status, order_date FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>របាយការណ៍ការកម្ម៉ង់ (Order Report)</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-family: 'Khmer OS Battambang', sans-serif; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .header { text-align: center; }
    </style>
</head>
<body>

<div class="header">
    <h2>របាយការណ៍ការកម្ម៉ង់អាហារ</h2>
    <p>កាលបរិច្ឆេទបង្ហាញ៖ <?php echo date('d-m-Y H:i:s'); ?></p>
</div>

<table>
    <thead>
        <tr>
            <th>លេខរៀង (ID)</th>
            <th>លេខតុ (Table No.)</th>
            <th>សរុបទឹកប្រាក់ ($)</th>
            <th>ស្ថានភាព (Status)</th>
            <th>ថ្ងៃខែឆ្នាំកម្ម៉ង់</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // បង្ហាញទិន្នន័យតាមរយៈ Loop
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["table_number"] . "</td>";
                echo "<td>" . number_format($row["total_amount"] ?? 0, 2) . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["order_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>មិនមានទិន្នន័យឡើយ</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>