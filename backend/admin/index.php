<?php
session_start();
require_once '../config.php';

// Authentication Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Fetch basic stats
try {
    $inq_count = $pdo->query("SELECT count(*) FROM inquiries")->fetchColumn();
    $pending_count = $pdo->query("SELECT count(*) FROM inquiries WHERE status = 'pending'")->fetchColumn();
    $cat_count = $pdo->query("SELECT count(*) FROM catalog_items WHERE is_active = 1")->fetchColumn();
} catch (PDOException $e) {
    die("Error fetching stats.");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Jahari Safaris Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white min-h-screen flex flex-col">
        <div class="p-6 text-center border-b border-gray-800">
            <h2 class="text-2xl font-bold font-serif text-green-500">Jahari Admin</h2>
            <p class="text-xs text-gray-400 mt-1">Logged in as <?php echo htmlspecialchars($_SESSION['admin_username']); ?></p>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="index.php" class="block px-4 py-2 bg-green-700 rounded text-white"><i class="fa-solid fa-gauge mr-2"></i> Dashboard</a>
            <a href="inquiries.php" class="block px-4 py-2 hover:bg-gray-800 rounded text-gray-300 transition"><i class="fa-solid fa-envelope mr-2"></i> Inquiries 
                <?php if($pending_count > 0): ?><span class="bg-orange-500 text-white text-xs px-2 py-1 rounded-full float-right"><?php echo $pending_count; ?></span><?php endif; ?>
            </a>
            <a href="catalog.php" class="block px-4 py-2 hover:bg-gray-800 rounded text-gray-300 transition"><i class="fa-solid fa-list mr-2"></i> Catalog Items</a>
        </nav>
        <div class="p-4 border-t border-gray-800">
            <a href="logout.php" class="block w-full text-center px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white transition"><i class="fa-solid fa-right-from-bracket mr-2"></i> Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Overview</h1>
            <a href="../../index.html" target="_blank" class="text-gray-500 hover:text-green-600 transition"><i class="fa-solid fa-external-link-alt mr-1"></i> View Live Site</a>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Inquiries</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?php echo $inq_count; ?></p>
                    </div>
                    <i class="fa-solid fa-users text-4xl text-gray-300"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-orange-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Pending Action</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?php echo $pending_count; ?></p>
                    </div>
                    <i class="fa-solid fa-bell text-4xl text-gray-300"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Active Catalog Items</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?php echo $cat_count; ?></p>
                    </div>
                    <i class="fa-solid fa-car text-4xl text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
            <div class="flex gap-4">
                <a href="inquiries.php" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition">Review New Inquiries</a>
                <a href="catalog.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">Manage Vehicles/Lodges</a>
            </div>
        </div>
    </main>

</body>
</html>
