<?php $location_index = ".."; include("../components/admin/header.php")?>
<body class="bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <?php $location_index = ".."; include("../components/admin/sidebar.php")?>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Kemaskini Program</h1>
                            <p class="text-gray-600">Urus program dan kursus kolej</p>
                        </div>
                        <button onclick="openAddCourseModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Tambah Program
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
                    <div id="mobile-menu" class="hidden md:hidden mt-4 pb-2">
                        <nav class="flex flex-col space-y-2">
                            <a href="./index.php" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                                Dashboard
                            </a>
                            <a href="./manage_course.php" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                                Urus Kursus
                            </a>
                            <a href="./manage_alumni.php" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                                Urus Alumni
                            </a>
                        </nav>
                    </div>
                </div>
            </header>

            <script>
                const hamburgerBtn = document.getElementById('hamburger-btn');
                const mobileMenu = document.getElementById('mobile-menu');

                hamburgerBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });

                // Optional: Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!hamburgerBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            </script>

            <!-- Content -->
            <div class="p-6">
                <!-- Search and Filter -->

                <center>

                    <div class="text-left bg-white rounded-xl shadow-2xl max-w-lg w-full p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Kemaskini Kursus Baru</h3>
                            <button onclick="closeAddCourseModal()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <?php 
                            $id_program = validateInput($_GET['id']);
                            $program_sql = $connect->prepare("SELECT * FROM program WHERE id_program = :id_program");
                            $program_sql->execute([
                                ":id_program" => $id_program
                            ]);
                            $program = $program_sql->fetch(PDO::FETCH_ASSOC);
                        ?>

                        <form method="post" action="../backend/program.php" class="space-y-4">
                            <input type="hidden" name="token" value="<?php echo $token?>">
                            <input type="hidden" name="id_program" value="<?php echo htmlspecialchars($program['id_program']) ?>">
    
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program</label>
                                <input type="text" name="nama_program" value="<?php echo htmlspecialchars($program['nama_program']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Teknologi Komputeran">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ketua Jabatan</label>
                                <input type="text" name="nama_kj_program" value="<?php echo htmlspecialchars($program['nama_kj_program']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ketua Program</label>
                                <input type="text" name="nama_kp_program" value="<?php echo htmlspecialchars($program['nama_kp_program']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombor Telefon Ketua Jabatan</label>
                                <input type="text" name="notel_kj_program" value="<?php echo htmlspecialchars($program['notel_kj_program']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="012-3456789">
                            </div>
    
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombor Telefon Ketua Program</label>
                                <input type="text" name="notel_kp_program" value="<?php echo htmlspecialchars($program['notel_kp_program']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="012-3456789">
                            </div>
                            <!-- <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tempoh Pengajian</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Tempoh</option>
                                    <option value="2">2 Tahun</option>
                                    <option value="3">3 Tahun</option>
                                    <option value="4">4 Tahun</option>
                                </select>
                            </div> -->
    
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="closeAddCourseModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Batal</button>
                                <button type="submit" name="kemaskini_program" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kemaskini</button>
                            </div>
                        </form>
                    </div>
                </center>
                
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div id="editCourseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Kemaskini Kursus Baru</h3>
                <button onclick="closeEditCourseModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="post" action="../backend/program.php" class="space-y-4">
                <input type="hidden" name="token" value="<?php echo $token?>">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program</label>
                    <input type="text" name="nama_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Teknologi Komputeran">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ketua Jabatan</label>
                    <input type="text" name="nama_kj_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ketua Program</label>
                    <input type="text" name="nama_kp_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombor Telefon Ketua Jabatan</label>
                    <input type="text" name="notel_kj_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="012-3456789">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombor Telefon Ketua Program</label>
                    <input type="text" name="notel_kp_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="012-3456789">
                </div>
                <!-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tempoh Pengajian</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Tempoh</option>
                        <option value="2">2 Tahun</option>
                        <option value="3">3 Tahun</option>
                        <option value="4">4 Tahun</option>
                    </select>
                </div> -->

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeEditCourseModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" name="tambah_program" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div id="addCourseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Tambah Kursus Baru</h3>
                <button onclick="closeAddCourseModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="post" action="../backend/program.php" class="space-y-4">
                <input type="hidden" name="token" value="<?php echo $token?>">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program</label>
                    <input type="text" name="nama_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Teknologi Komputeran">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ketua Jabatan</label>
                    <input type="text" name="nama_kj_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ketua Program</label>
                    <input type="text" name="nama_kp_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombor Telefon Ketua Jabatan</label>
                    <input type="text" name="notel_kj_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="012-3456789">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombor Telefon Ketua Program</label>
                    <input type="text" name="notel_kp_program" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="012-3456789">
                </div>
                <!-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tempoh Pengajian</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Tempoh</option>
                        <option value="2">2 Tahun</option>
                        <option value="3">3 Tahun</option>
                        <option value="4">4 Tahun</option>
                    </select>
                </div> -->

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeAddCourseModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" name="tambah_program" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddCourseModal() {
            document.getElementById('addCourseModal').classList.remove('hidden');
        }

        function closeAddCourseModal() {
            document.getElementById('addCourseModal').classList.add('hidden');
        }

        function openEditCourseModal() {
            document.getElementById('editCourseModal').classList.remove('hidden');
        }

        function closeEditCourseModal() {
            document.getElementById('editCourseModal').classList.add('hidden');
        }
    </script>
    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>