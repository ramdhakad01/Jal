<?php
session_start();
include("confige.php"); // This should contain your DB connection as $conn

// Fetch orders by joining transaction_data and registration_user
// $sql = "SELECT t.transaction_id, t.amount, t.product_ids, t.username, t.created_at, r.phone, r.name 
//         FROM transaction_data t
//         JOIN registration_user r ON t.username = r.email
//         ORDER BY t.created_at DESC";
        

// $result = $conn->query($sql);
// $orders = [];

// if ($result && $result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $orders[] = [
//             'id' => $row['transaction_id'],
//             'customer' => $row['name'],
//             'amount' =>  '₹' . $row['amount'],
//             'date' => $row['created_at'],
//             'phone' => $row['phone']
//         ];
//     }
// }

// $page = isset($_GET['page']) ? $_GET['page'] : 'home';
//   $totalOrders = 0;
$countQuery = "SELECT COUNT(*) as total FROM transaction_data";
$countResult = $conn->query($countQuery);
if ($countResult && $row = $countResult->fetch_assoc()) {
    $totalOrders = $row['total'];
}

// Orders Table
$sql = "SELECT t.transaction_id, t.amount, t.product_ids, t.username, t.created_at, r.phone, r.name 
        FROM transaction_data t
        JOIN registration_user r ON t.username = r.email
        ORDER BY t.created_at DESC";
$result = $conn->query($sql);
$orders = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = [
            'id' => $row['transaction_id'],
            'customer' => $row['name'],
            'amount' => '₹' . $row['amount'],
            'date' => $row['created_at'],
            'phone' => $row['phone']
        ];
    }
}
$page = isset($_GET['page']) ? $_GET['page'] : 'home'; 
// Total Orders
$countQuery = "SELECT COUNT(*) as total FROM transaction_data";
$countResult = $conn->query($countQuery);
$totalOrders = 0;
if ($countResult && $row = $countResult->fetch_assoc()) {
    $totalOrders = $row['total'];
}

// Total Revenue
$revenueQuery = "SELECT SUM(amount) as total_revenue FROM transaction_data";
$revenueResult = $conn->query($revenueQuery);
$totalRevenue = 0;
if ($revenueResult && $row = $revenueResult->fetch_assoc()) {
    $totalRevenue = $row['total_revenue'];
} 
// Total Customers
$customerQuery = "SELECT COUNT(*) as total_customers FROM registration_user";
$customerResult = $conn->query($customerQuery);
$totalCustomers = 0;
if ($customerResult && $row = $customerResult->fetch_assoc()) {
    $totalCustomers = $row['total_customers'];
}
// delete php 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM transaction_data WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?page=orders&status=deleted");
        exit();
    } else {
        header("Location: dashboard.php?page=orders&status=failed");
        exit();
    }
    $stmt->close();
}




?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f6fa;
            color: #333;
        }
        
        /* Dashboard layout */
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            transition: all 0.3s ease;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid #34495e;
        }
        
        .sidebar-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .sidebar-header h2 i {
            margin-right: 10px;
            color: #3498db;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #ecf0f1;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: #34495e;
            border-left: 4px solid #3498db;
        }
        
        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Main content area */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        
        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        
        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .user-name {
            font-weight: 500;
        }
        
        /* Dashboard cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.5rem;
            color: white;
        }
        
        .card-blue { background-color: #3498db; }
        .card-green { background-color: #2ecc71; }
        .card-orange { background-color: #e67e22; }
        .card-red { background-color: #e74c3c; }
        
        .card-title {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 5px;
        }
        
        .card-value {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2c3e50;
        }
        
        /* Table styles */
        .data-table {
            width: 100%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .data-table table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th, .data-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .data-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .data-table tr:hover {
            background-color: #f8f9fa;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-completed {
            background-color: #e6f7ee;
            color: #2ecc71;
        }
        
        .status-processing {
            background-color: #e6f3f8;
            color: #3498db;
        }
        
        .status-pending {
            background-color: #fef5e7;
            color: #e67e22;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                padding: 10px 0;
            }
            
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .data-table {
                overflow-x: auto;
            }
        }
    </style>
    <script>
    // Delete Confirmation
    function confirmDelete(orderId) {
        if (confirm("Are you sure you want to delete this order?")) {
            // window.location.href = "delete_order.php?id=" + orderId;
            window.location.href = "delete_order.php?id=" + orderId;
        }
    }

    // Edit Redirect (you can redirect to an edit page)
    function editOrder(orderId) {
        window.location.href = "edit_order.php?id=" + orderId;
    }
</script>

</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
            </div>
            <div class="sidebar-menu">
                <a href="?page=home" class="menu-item <?php echo $page === 'home' ? 'active' : ''; ?>">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="?page=orders" class="menu-item <?php echo $page === 'orders' ? 'active' : ''; ?>">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
                <a href="coustumer.php" class="menu-item">
                    <i class="fas fa-users"></i> Customers
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-box"></i> Products
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
                <a href="setting.php" class="menu-item">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h1 class="page-title">
                    <?php 
                    if ($page === 'home') echo 'Dashboard Overview';
                    elseif ($page === 'orders') echo 'Orders Management';
                    ?>
                </h1>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo substr($_SESSION['user']['name'], 0, 1); ?>
                    </div>
                    <!-- <div class="user-name">
                        <?php echo $_SESSION['user']['name']; ?>
                    </div> -->
                </div>
            </div>
            
            <!-- Page Content -->
            <?php if ($page === 'home'): ?>
                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <div class="card-icon card-blue">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-title">Total Orders</div>
                        <div class="card-value"><?php echo $totalOrders;  ?></div>
                    </div>
                    
                    <div class="card">
                        <div class="card-icon card-green">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-title">Revenue</div>
                        <div class="card-value">₹<?php echo number_format($totalRevenue); ?></div>

                    </div>
                    
                    <div class="card">
                        <div class="card-icon card-orange">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-title">Customers</div>
                        <div class="card-value"><?php echo $totalCustomers; ?></div>
                    </div>
                    
                    <div class="card">
                        <div class="card-icon card-red">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="card-title">Products</div>
                        <div class="card-value">100</div>
                    </div>
                </div>
                
                <!-- Recent Orders -->
                <h2 style="margin-bottom: 15px; color: #2c3e50;">Recent Orders</h2>
                <div class="data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Date</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($orders, 0, 3) as $order): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo $order['customer']; ?></td>
                                <td><?php echo $order['amount']; ?></td>
                                
                                <td><?php echo $order['date']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            <?php elseif ($page === 'orders'): ?>
                <!-- Orders Page -->
                <div class="data-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Actions</th>
                                <th>Contact Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo $order['customer']; ?></td>
                                <td><?php echo $order['amount']; ?></td>
                               
                                <td><?php echo $order['date']; ?></td>
                                <!-- <td>
                                     <a href="#" style="color: #3498db; margin-right: 10px;"><i class="fas fa-eye"></i></a> 
                                    <a href="#" style="color: #2ecc71; margin-right: 10px;"><i class="fas fa-edit"></i></a>
                                    <a href="#" style="color: #e74c3c;"><i class="fas fa-trash"></i></a>
                                </td>  -->
                                <td>
    <a href="javascript:void(0);" onclick="editOrder('<?php echo $order['id']; ?>')" style="color: #2ecc71; margin-right: 10px;">
        <i class="fas fa-edit"></i>
    </a>
    <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $order['id']; ?>')" style="color: #e74c3c;">
        <i class="fas fa-trash"></i>
    </a>
</td>


                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>