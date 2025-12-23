<?php
// Sidebar Component
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<div class="w-64 bg-blue-800 text-white min-h-screen hidden md:flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-blue-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-graduation-cap text-blue-800 text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <p class="text-blue-200 text-xs">Sistem Alumni</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-2">
        <!-- Dashboard -->
        <a href="index.php" class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'index.php' ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700'; ?>">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
            </svg>
            <span class="text-white">Dashboard</span>
        </a>
    
        <!-- Urus Kursus -->
        <a href="manage_course.php" class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'manage_course.php' ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700'; ?>">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
            </svg>
            <span class="text-white">Urus Kursus</span>
        </a>
    
        <!-- Urus Alumni -->
        <a href="manage_alumni.php" class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'manage_alumni.php' ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700'; ?>">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <span class="text-white">Urus Alumni</span>
        </a>
    
        <!-- Admin -->
        <a href="manage_admin.php" class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'manage_admin.php' ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700'; ?>">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
            </svg>
            <span class="text-white">Admin</span>
        </a>
    </nav>


    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-blue-700">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium">Administrator</p>
                <p class="text-xs text-blue-300">admin@college.edu</p>
            </div>
        </div>
        <form action="<?php echo $location_index?>/backend/admin.php" method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <button type="submit" name="signout_admin" class="w-full bg-red-600 flex items-center space-x-3 p-3 rounded-lg text-blue-200 hover:bg-red-500 transition duration-200">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span class="text-white">Log Keluar</span>
            </button>

        </form>
    </div>
</div>