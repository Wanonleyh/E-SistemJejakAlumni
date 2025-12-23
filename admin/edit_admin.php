<?php 
$location_index = ".."; 
include("../components/admin/header.php");

// Check if admin ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: manage_admin.php");
    exit;
}

$admin_id = validateInput($_GET['id']);

// Fetch admin data
try {
    $admin_sql = $connect->prepare("SELECT * FROM admin WHERE id_admin = :id");
    $admin_sql->execute([':id' => $admin_id]);
    $admin = $admin_sql->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        alert_message("error", "Admin tidak ditemui");
        header("Location: manage_admin.php");
        exit;
    }
} catch (PDOException $e) {
    alert_message("error", "Error: " . $e->getMessage());
    header("Location: manage_admin.php");
    exit;
}
?>

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
                            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Kemaskini Admin</h1>
                            <p class="text-sm sm:text-base text-gray-600">Kemaskini maklumat pentadbir sistem</p>
                        </div>
                        <a href="manage_admin.php" class="w-full sm:w-auto">
                            <button class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </button>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-4 sm:p-6">
                <div class="max-w-2xl mx-auto">
                    <!-- Edit Form -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-edit text-white text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-white">Kemaskini Maklumat Admin</h2>
                                    <p class="text-blue-100 text-sm">Kemaskini maklumat pentadbir sistem</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <form id="editAdminForm" action="../backend/admin.php" method="post" class="p-6 space-y-6">
                            <input type="hidden" name="kemaskini_admin" value="1">
                            <input type="hidden" name="id_admin" value="<?php echo $admin['id_admin']; ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                            <!-- Maklumat Asas -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                                    Maklumat Pentadbir
                                </h3>
                                
                                <div class="space-y-4">
                                    <!-- Nama Admin -->
                                    <div>
                                        <label for="nama_admin" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Admin <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="nama_admin" 
                                            name="nama_admin" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                            value="<?php echo htmlspecialchars($admin['nama_admin']); ?>"
                                            required
                                            placeholder="Masukkan nama penuh admin"
                                        >
                                    </div>

                                    <!-- Kata Laluan Baru (Optional) -->
                                    <div>
                                        <label for="password_admin" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kata Laluan Baru
                                        </label>
                                        <input 
                                            type="password" 
                                            id="password_admin" 
                                            name="password_admin" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                            placeholder="Biarkan kosong jika tidak mahu menukar"
                                            minlength="6"
                                        >
                                        <p class="text-xs text-gray-500 mt-1">Minimum 6 aksara. Biarkan kosong jika tidak mahu menukar kata laluan.</p>
                                    </div>

                                    <!-- Sahkan Kata Laluan Baru -->
                                    <div>
                                        <label for="password_admin_confirm" class="block text-sm font-medium text-gray-700 mb-2">
                                            Sahkan Kata Laluan Baru
                                        </label>
                                        <input 
                                            type="password" 
                                            id="password_admin_confirm" 
                                            name="password_admin_confirm" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                            placeholder="Sahkan kata laluan baru"
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-toggle-on text-green-500 mr-2"></i>
                                    Status Akaun
                                </h3>
                                
                                <div class="flex space-x-6">
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input 
                                            type="radio" 
                                            name="status_admin" 
                                            value="1" 
                                            class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300"
                                            <?php echo $admin['status_admin'] == 1 ? 'checked' : ''; ?>
                                        >
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                            <span class="text-gray-700 font-medium">Aktif</span>
                                        </div>
                                    </label>
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input 
                                            type="radio" 
                                            name="status_admin" 
                                            value="0" 
                                            class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300"
                                            <?php echo $admin['status_admin'] == 0 ? 'checked' : ''; ?>
                                        >
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                            <span class="text-gray-700 font-medium">Tidak Aktif</span>
                                        </div>
                                    </label>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">
                                    Pilih status untuk akaun ini. Akaun tidak aktif tidak boleh log masuk ke sistem.
                                </p>
                            </div>

                            <!-- Maklumat Sistem -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-info-circle text-purple-500 mr-2"></i>
                                    Maklumat Sistem
                                </h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">ID Admin:</span>
                                        <p class="font-medium text-gray-800"><?php echo $admin['id_admin']; ?></p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Tarikh Daftar:</span>
                                        <p class="font-medium text-gray-800">
                                            <?php echo date('d/m/Y', strtotime($admin['created_date_admin'])); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                                <a href="manage_admin.php" class="flex-1">
                                    <button type="button" class="w-full px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-200 font-medium">
                                        <i class="fas fa-times mr-2"></i>Batal
                                    </button>
                                </a>
                                <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 font-medium">
                                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mt-6 border border-red-200">
                        <div class="bg-red-50 px-6 py-4 border-b border-red-200">
                            <h3 class="text-lg font-semibold text-red-800 flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                                Zon Bahaya
                            </h3>
                            <p class="text-red-600 text-sm mt-1">Tindakan di bahagian ini tidak boleh dipulihkan</p>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <h4 class="font-medium text-gray-800">Padam Akaun Admin</h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Setelah dipadam, semua data admin ini akan dipadam secara kekal.
                                    </p>
                                </div>
                                <button 
                                    type="button" 
                                    onclick="showDeleteConfirmation()"
                                    class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200 font-medium whitespace-nowrap"
                                >
                                    <i class="fas fa-trash mr-2"></i>Padam Admin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Padam Admin?</h3>
                <p class="text-gray-600 text-center mb-6">
                    Adakah anda pasti mahu memadam admin <span class="font-semibold"><?php echo htmlspecialchars($admin['nama_admin']); ?></span>? 
                    Tindakan ini tidak boleh dibatalkan.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <form action="../backend/admin.php" method="post" class="flex-1">
                        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                        <input type="hidden" name="id_admin" value="<?php echo $admin['id_admin']; ?>">
                        <input type="hidden" name="delete_admin" value="1">
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Ya, Padam
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form validation
        document.getElementById('editAdminForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password_admin').value;
            const confirmPassword = document.getElementById('password_admin_confirm').value;
            
            // If password is provided, check if it matches confirmation
            if (password && password !== confirmPassword) {
                e.preventDefault();
                alert('Kata laluan tidak sepadan! Sila pastikan kedua-dua kata laluan sama.');
                document.getElementById('password_admin_confirm').focus();
                return false;
            }
            
            // Check password length if provided
            if (password && password.length < 6) {
                e.preventDefault();
                alert('Kata laluan mesti sekurang-kurangnya 6 aksara!');
                document.getElementById('password_admin').focus();
                return false;
            }
            
            return true;
        });

        // Delete confirmation modal
        function showDeleteConfirmation() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside or pressing ESC
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Real-time password validation
        const passwordInput = document.getElementById('password_admin');
        const confirmPasswordInput = document.getElementById('password_admin_confirm');

        function validatePasswords() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (password && confirmPassword) {
                if (password !== confirmPassword) {
                    confirmPasswordInput.classList.add('border-red-500', 'focus:ring-red-500');
                    confirmPasswordInput.classList.remove('border-gray-300', 'focus:ring-blue-500');
                } else {
                    confirmPasswordInput.classList.remove('border-red-500', 'focus:ring-red-500');
                    confirmPasswordInput.classList.add('border-gray-300', 'focus:ring-blue-500');
                }
            }
        }

        passwordInput.addEventListener('input', validatePasswords);
        confirmPasswordInput.addEventListener('input', validatePasswords);
    </script>

    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>