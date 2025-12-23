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
                        <button onclick="showAddAdminModal()" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Tambah Admin
                        </button>
                        <!-- Hamburger Button -->
                        <div class="block md:hidden">
                            <button id="hamburger-btn" class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Dropdown Menu -->
                    <?php $location_index = ".."; include("../components/admin/mobile_navbar.php")?>
                </div>
            </header>

            <!-- Content -->
            <div class="p-4 sm:p-6">
                
                <!-- Stats Overview -->

                <form method="post" action="../backend/admin.php" class="max-w-sm mx-auto">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <div class="mb-5">
                        <label for="nama_admin" class="block mb-2 text-sm font-medium text-gray-900">Nama Pengguna</label>
                        <input type="text" name="nama_admin"  id="nama_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="pengguna" required />
                    </div>
                    <div class="mb-5">
                        <label for="password_admin" class="block mb-2 text-sm font-medium text-gray-900">Katalaluan Pengguna</label>
                        <input type="password" name="password_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div class="mb-5">
                        <label for="password_admin_confirm" class="block mb-2 text-sm font-medium text-gray-900">Sah Kataluan Pengguna</label>
                        <input type="password" name="password_admin_confirm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <button type="submit" name="tambah_admin" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                </form>
                
            </div>
        </div>
    </div>

   
    <script>
        function validateAdminForm() {
            // Check if passwords match
            const password = document.getElementById('formPasswordAdmin').value;
            const confirmPassword = document.getElementById('formConfirmPassword').value;
            
            if (password !== confirmPassword) {
                alert('Kata laluan tidak sepadan!');
                return false;
            }
            
            // Form will submit normally if validation passes
            return true;
        }

        function showDetail(id) {
            // Redirect to detail page or show modal with server-side data
            window.location.href = 'admin_detail.php?id=' + id;
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showAddAdminModal() {
            document.getElementById('addEditModalTitle').textContent = 'Tambah Admin';
            document.getElementById('adminForm').reset();
            document.getElementById('formAdminId').value = '';
            document.getElementById('formPasswordAdmin').required = true;
            document.getElementById('formConfirmPassword').required = true;
            
            // Set default status to active
            document.querySelector('input[name="status_admin"][value="1"]').checked = true;
            
            document.getElementById('addEditModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function editAdmin(id) {
            // Redirect to edit page
            window.location.href = 'edit_admin.php?id=' + id;
        }

        function closeAddEditModal() {
            document.getElementById('addEditModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showDeleteConfirmation(id, name) {
            document.getElementById('deleteAdminName').textContent = name;
            document.getElementById('deleteAdminId').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modals on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
                closeDeleteModal();
                closeAddEditModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetailModal();
            }
        });

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.getElementById('addEditModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddEditModal();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>