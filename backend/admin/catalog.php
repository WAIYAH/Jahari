<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Handle Add/Edit/Delete actions here if necessary
// (Omitted for brevity - but this is where you'd process POST requests to insert into catalog_items)

// Fetch all catalog items
try {
    $stmt = $pdo->query("SELECT * FROM catalog_items ORDER BY type, created_at DESC");
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalog Manager | Jahari Safaris Admin</title>
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
            <a href="inquiries.php" class="block px-4 py-2 hover:bg-gray-800 rounded text-gray-300 transition"><i class="fa-solid fa-envelope mr-2"></i> Inquiries</a>
            <a href="catalog.php" class="block px-4 py-2 bg-green-700 rounded text-white transition"><i class="fa-solid fa-list mr-2"></i> Catalog Items</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Catalog Manager</h1>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition"><i class="fa-solid fa-plus mr-2"></i> Add New Item</button>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-800 text-white uppercase text-sm">
                        <th class="p-4">Type</th>
                        <th class="p-4">Title / Name</th>
                        <th class="p-4">Location</th>
                        <th class="p-4">Price (USD)</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if(count($items) === 0): ?>
                        <tr><td colspan="6" class="p-4 text-center text-gray-500">No items in catalog.</td></tr>
                    <?php endif; ?>
                    
                    <?php foreach($items as $row): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">
                            <?php 
                                $icon = 'fa-tag';
                                if($row['type'] == 'vehicle') $icon = 'fa-car text-blue-500';
                                if($row['type'] == 'lodge') $icon = 'fa-bed text-purple-500';
                                if($row['type'] == 'campsite') $icon = 'fa-campground text-green-500';
                                if($row['type'] == 'tent') $icon = 'fa-tent text-orange-500';
                            ?>
                            <span class="inline-flex items-center gap-2 font-semibold text-gray-700"><i class="fa-solid <?php echo $icon; ?>"></i> <?php echo ucfirst($row['type']); ?></span>
                        </td>
                        <td class="p-4 font-bold text-gray-800"><?php echo htmlspecialchars($row['title']); ?></td>
                        <td class="p-4 text-sm text-gray-600"><?php echo htmlspecialchars($row['location']); ?></td>
                        <td class="p-4 font-bold text-green-700">$<?php echo number_format($row['price_usd'], 2); ?></td>
                        <td class="p-4">
                            <?php if($row['is_active']): ?>
                                <span class="bg-green-100 text-green-800 px-2 py-1 text-xs font-bold rounded-full">ACTIVE</span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-800 px-2 py-1 text-xs font-bold rounded-full">INACTIVE</span>
                            <?php endif; ?>
                        </td>
                        <td class="p-4">
                            <button class="text-blue-600 hover:text-blue-800 mr-3" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="text-red-600 hover:text-red-800" title="Disable/Delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
