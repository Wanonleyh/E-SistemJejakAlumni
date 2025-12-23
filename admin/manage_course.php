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
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Kursus</label>
                            <input type="text" placeholder="Nama kursus..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200 w-full">
                                <i class="fas fa-filter mr-2"></i>Tapisan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Courses Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kursus</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketua Jabatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketua Program</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Alumni</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                    $program_sql = $connect->prepare("SELECT * FROM program");
                                    $program_sql->execute();

                                    while($program = $program_sql->fetch(PDO::FETCH_ASSOC)) {?>

                                    <?php
                                    $statusColor = $program['status_program'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                                    $statusText = $program['status_program'] == 1 ? 'Aktif' : 'Tidak Aktif';
                                    ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-book text-blue-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900"><?php echo $program['nama_program']; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo $program['nama_kj_program']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo $program['nama_kj_program']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php 
                                            $alumni_count_sql = $connect->prepare("SELECT COUNT(*) AS count FROM alumni WHERE id_program = :id_program");
                                            $alumni_count_sql->execute([':id_program' => $program['id_program']]);
                                            $alumni_count = $alumni_count_sql->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <div class="text-sm text-gray-900"><?php echo $alumni_count['count']; ?> alumni</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusColor; ?>">
                                            <?php echo $statusText; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="./edit_program.php?id=<?php echo $program['id_program']; ?>">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3">
                                                <i class="fas fa-edit"></i>
                                                Kemaskini
                                            </button>
                                        </a>
                                        <button class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                            Padam
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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