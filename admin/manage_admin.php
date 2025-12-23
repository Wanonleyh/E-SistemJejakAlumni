<?php $location_index = ".."; include("../components/admin/header.php")?>

<body class="bg-gray-50">
    
    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        <?php $location_index = ".."; include("../components/admin/sidebar.php")?>

        <!-- Main Content -->
        <div class="flex-1 w-full">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-4 sm:px-6 py-4">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Urus Admin</h1>
                            <p class="text-sm sm:text-base text-gray-600">Urus data dan maklumat pentadbir sistem</p>
                        </div>
                        <a href="./tambah-admin.php" class="w-full sm:w-auto">
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                                <i class="fas fa-plus mr-2"></i>Tambah Admin
                            </button>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-4 sm:p-6">
                
                <!-- Stats Overview -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php  
                                    $total_admin_sql = $connect->prepare("SELECT * FROM admin WHERE NOT status_admin = 0");
                                    $total_admin_sql->execute(); 
                                    $total_admin = $total_admin_sql->rowCount();
                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Total Admin</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $total_admin ?></p>
                            </div>
                            <i class="fas fa-users-cog text-blue-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php 
                                    $active_admin_sql = $connect->prepare("SELECT * FROM admin WHERE status_admin = 1");
                                    $active_admin_sql->execute(); 
                                    $active_admin = $active_admin_sql->rowCount();
                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Aktif</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $active_admin?></p>
                            </div>
                            <i class="fas fa-user-check text-green-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-red-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php 
                                    $inactive_admin_sql = $connect->prepare("SELECT * FROM admin WHERE status_admin = 0");
                                    $inactive_admin_sql->execute(); 
                                    $inactive_admin = $inactive_admin_sql->rowCount();
                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Tidak Aktif</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $inactive_admin?></p>
                            </div>
                            <i class="fas fa-user-slash text-red-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php 
                                    $today = date("Y-m-d");
                                    $new_admin_sql = $connect->prepare("SELECT * FROM admin WHERE DATE(created_date_admin) = :today AND NOT status_admin = 0");
                                    $new_admin_sql->execute([":today" => $today]); 
                                    $new_admin = $new_admin_sql->rowCount();
                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Baru Hari Ini</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $new_admin?></p>
                            </div>
                            <i class="fas fa-user-plus text-purple-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Admin Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Admin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarikh Daftar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                // Get all admins
                                $query = "SELECT * FROM admin WHERE 1=1 ORDER BY created_date_admin DESC";
                                $stmt = $connect->prepare($query);
                                $stmt->execute();
                                $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (count($admins) > 0) {
                                    foreach ($admins as $admin) {
                                        $status_color = $admin['status_admin'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                        $status_text = $admin['status_admin'] == 1 ? 'Aktif' : 'Tidak Aktif';
                                        $created_date = date("d/m/Y", strtotime($admin['created_date_admin']));
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-user-cog text-gray-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($admin['nama_admin']); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?php echo $admin['id_admin']; ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $status_color; ?>">
                                            <?php echo $status_text; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?php echo $created_date; ?></div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <a href="edit_admin.php?id=<?php echo $admin['id_admin']; ?>" class="text-green-600 hover:text-green-900 mr-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="../backend/admin.php?delete_admin=1&id_admin=<?php echo $admin['id_admin']; ?>&csrf_token=<?php echo generateCSRFToken(); ?>" 
                                           class="text-red-600 hover:text-red-900"
                                           onclick="return confirm('Adakah anda pasti mahu memadam admin ini?')">
                                            <i class="fas fa-trash"></i> Padam
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tiada data admin ditemui.
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="lg:hidden divide-y divide-gray-200">
                        <?php
                        if (count($admins) > 0) {
                            foreach ($admins as $admin) {
                                $status_color = $admin['status_admin'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                $status_text = $admin['status_admin'] == 1 ? 'Aktif' : 'Tidak Aktif';
                                $created_date = date("d/m/Y", strtotime($admin['created_date_admin']));
                        ?>
                        <div class="p-4 hover:bg-gray-50 transition">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center flex-1">
                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user-cog text-gray-600"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-gray-900 truncate"><?php echo htmlspecialchars($admin['nama_admin']); ?></div>
                                        <div class="text-xs text-gray-500 truncate">ID: <?php echo $admin['id_admin']; ?></div>
                                    </div>
                                </div>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $status_color; ?>">
                                    <?php echo $status_text; ?>
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-sm mb-3">
                                <div>
                                    <span class="text-gray-600">Tarikh Daftar:</span>
                                    <div class="font-medium text-gray-900"><?php echo $created_date; ?></div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="edit_admin.php?id=<?php echo $admin['id_admin']; ?>" class="flex-1 px-3 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition text-center">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <a href="../backend/admin.php?delete_admin=1&id_admin=<?php echo $admin['id_admin']; ?>&csrf_token=<?php echo generateCSRFToken(); ?>" 
                                   class="flex-1 px-3 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition text-center"
                                   onclick="return confirm('Adakah anda pasti mahu memadam admin ini?')">
                                    <i class="fas fa-trash mr-1"></i> Padam
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                        ?>
                        <div class="p-4 text-center text-sm text-gray-500">
                            Tiada data admin ditemui.
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>