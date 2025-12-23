<?php
// Sidebar Component for Alumni
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<div class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white min-h-screen flex-col hidden md:flex">
    <!-- Logo & Profile -->
    <div class="p-6 border-b border-blue-700">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                <!-- <img src="<?php echo !empty($alumni['pfp_user']) ? $location_index .'/uploads/profiles/'.$alumni['pfp_user'] : 'https://avatar.iran.liara.run/username?username=' . $alumni['nama_alumni'] ; ?>" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-primary-200"> -->
            </div>
            <div>
                <h1 class="text-lg font-bold">Panel Alumni</h1>
                <p class="text-blue-200 text-xs">Sistem Alumni KVKS</p>
            </div>
        </div>
        <div class="bg-blue-700 rounded-lg p-3">
            <p class="text-sm font-medium"><?php echo htmlspecialchars($alumni['nama_alumni'])?></p>
            <p class="text-xs text-blue-200">Sains Komputer - CS001</p>
            <p class="text-xs text-blue-200 mt-1">
                <i class="fas fa-circle text-green-400 mr-1"></i>Status: Bekerja
            </p>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-1">
        <!-- Dashboard -->
        <a href="index.php" class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'index.php' ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-200 hover:bg-blue-700 hover:text-white'; ?>">
            <!-- <i class="fas fa-tachometer-alt w-5 text-center"></i> -->
            <span>Dashboard</span>
        </a>

        <!-- Pencapaian -->
        <a href="manage_achievements.php" class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'manage_achievements.php' ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-200 hover:bg-blue-700 hover:text-white'; ?>">
            <!-- <i class="fas fa-trophy w-5 text-center"></i> -->
            <span>Pencapaian Saya</span>
        </a>

        <!-- Profil Saya -->
        <a href="profile.php" class="flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'profile.php' ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-200 hover:bg-blue-700 hover:text-white'; ?>">
            <!-- <i class="fas fa-user-edit w-5 text-center"></i> -->
            <span>Profil Saya</span>
        </a>
        <form action="<?php echo $location_index?>/backend/alumni.php" method="post">

            <input type="hidden" name="token" value="<?php echo $token?>">
            <!-- <i class="fas fa-trophy w-5 text-center"></i> -->
            <input name="signout_alumni" type="submit" class="text-left w-full flex items-center space-x-3 p-3 rounded-lg transition duration-200 <?php echo $current_page == 'keluar.php' ? 'bg-blue-700 text-white shadow-lg' : 'text-blue-200 hover:bg-blue-700 hover:text-white'; ?>" value="Log Keluar">
        </a>

        </form>
    </nav>

    <!-- Footer Section -->
    <div class="p-4 border-t border-blue-700">
        <!-- <div class="text-center mb-3">
            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-2">
                <i class="fas fa-medal text-white"></i>
            </div>
            <p class="text-xs text-blue-200">Tahap Alumni: <span class="font-bold text-white">Emas</span></p>
        </div> -->
    </div>
</div>