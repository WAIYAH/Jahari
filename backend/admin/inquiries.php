<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_status') {
    $id = intval($_POST['inquiry_id']);
    $new_status = $_POST['status'];
    
    try {
        $stmt = $pdo->prepare("UPDATE inquiries SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $new_status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $msg = "Status updated successfully.";
    } catch (PDOException $e) {
        $error = "Error updating status.";
    }
}

// Fetch all inquiries
try {
    $stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
    $inquiries = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inquiries | Jahari Safaris Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 text-center border-b border-gray-800">
            <h2 class="text-2xl font-bold font-serif text-green-500">Jahari Admin</h2>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="index.php" class="block px-4 py-2 hover:bg-gray-800 rounded text-gray-300 transition"><i class="fa-solid fa-gauge mr-2"></i> Dashboard</a>
            <a href="inquiries.php" class="block px-4 py-2 bg-green-700 rounded text-white transition"><i class="fa-solid fa-envelope mr-2"></i> Inquiries</a>
            <a href="catalog.php" class="block px-4 py-2 hover:bg-gray-800 rounded text-gray-300 transition"><i class="fa-solid fa-list mr-2"></i> Catalog Items</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Inquiries & Leads</h1>

        <?php if(isset($msg)) echo "<div class='bg-green-100 text-green-800 p-4 rounded mb-6'>$msg</div>"; ?>
        <?php if(isset($error)) echo "<div class='bg-red-100 text-red-800 p-4 rounded mb-6'>$error</div>"; ?>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white uppercase text-sm">
                        <th class="p-4">Date</th>
                        <th class="p-4">Client</th>
                        <th class="p-4">Subject</th>
                        <th class="p-4">Contact</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if(count($inquiries) === 0): ?>
                        <tr><td colspan="6" class="p-4 text-center text-gray-500">No inquiries found.</td></tr>
                    <?php endif; ?>
                    
                    <?php foreach($inquiries as $row): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm text-gray-600"><?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></td>
                        <td class="p-4 font-semibold text-gray-800"><?php echo htmlspecialchars($row['client_name']); ?></td>
                        <td class="p-4 text-sm text-gray-600"><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td class="p-4 text-sm text-gray-600">
                            <i class="fa-solid fa-phone text-xs text-green-600 mr-1"></i> <?php echo htmlspecialchars($row['client_phone']); ?><br>
                            <?php if($row['client_email']): ?>
                                <i class="fa-solid fa-envelope text-xs text-blue-600 mr-1"></i> <?php echo htmlspecialchars($row['client_email']); ?>
                            <?php endif; ?>
                        </td>
                        <td class="p-4">
                            <?php 
                                $color = 'bg-gray-200 text-gray-800';
                                if($row['status'] == 'pending') $color = 'bg-orange-100 text-orange-800';
                                if($row['status'] == 'contacted') $color = 'bg-blue-100 text-blue-800';
                                if($row['status'] == 'booked') $color = 'bg-green-100 text-green-800';
                            ?>
                            <span class="px-2 py-1 text-xs font-bold rounded-full <?php echo $color; ?>">
                                <?php echo strtoupper($row['status']); ?>
                            </span>
                        </td>
                        <td class="p-4">
                            <form method="POST" action="inquiries.php" class="flex items-center gap-2">
                                <input type="hidden" name="action" value="update_status">
                                <input type="hidden" name="inquiry_id" value="<?php echo $row['id']; ?>">
                                <select name="status" class="border text-sm p-1 rounded focus:outline-none focus:border-green-500">
                                    <option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>Pending</option>
                                    <option value="contacted" <?php if($row['status']=='contacted') echo 'selected'; ?>>Contacted</option>
                                    <option value="booked" <?php if($row['status']=='booked') echo 'selected'; ?>>Booked</option>
                                    <option value="closed" <?php if($row['status']=='closed') echo 'selected'; ?>>Closed</option>
                                </select>
                                <button type="submit" class="bg-gray-800 hover:bg-black text-white text-xs px-2 py-1 rounded">Update</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
