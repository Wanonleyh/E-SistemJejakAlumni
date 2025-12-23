<?php $location_index = ".."; include("../components/header.php")?>
<?php// $activePage = 'index'; ?>
<body class="bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <?php $location_index = ".."; include("../components/alumni/sidebar.php")?>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Pencapaian Saya</h1>
                            <p class="text-gray-600">Urus dan lihat semua pencapaian anda</p>
                        </div>
                        <button onclick="openAddAchievementModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center">
                            <i class="fas fa-plus mr-2"></i>Tambah Pencapaian
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">Total Pencapaian</p>
                                <p class="text-2xl font-bold text-gray-800">12</p>
                            </div>
                            <i class="fas fa-trophy text-blue-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">Disahkan</p>
                                <p class="text-2xl font-bold text-gray-800">10</p>
                            </div>
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-yellow-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">Menunggu</p>
                                <p class="text-2xl font-bold text-gray-800">2</p>
                            </div>
                            <i class="fas fa-clock text-yellow-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-sm border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">Tahap Alumni</p>
                                <p class="text-2xl font-bold text-gray-800">Emas</p>
                            </div>
                            <i class="fas fa-medal text-purple-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Filter and Search -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pencapaian</label>
                            <input type="text" placeholder="Nama pencapaian..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Jenis</option>
                                <option value="award">Anugerah</option>
                                <option value="certificate">Sijil</option>
                                <option value="publication">Penerbitan</option>
                                <option value="recognition">Pengiktirafan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="verified">Disahkan</option>
                                <option value="pending">Menunggu</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200 w-full">
                                <i class="fas fa-filter mr-2"></i>Tapisan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Achievements Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    $achievements = [
                        [
                            'title' => 'Anugerah Inovasi Teknologi 2024',
                            'type' => 'Anugerah',
                            'date' => '15 Jan 2024',
                            'status' => 'verified',
                            'icon' => 'fas fa-award',
                            'color' => 'bg-yellow-500',
                            'description' => 'Anugerah untuk inovasi dalam pembangunan aplikasi mobile'
                        ],
                        [
                            'title' => 'Sijil Kecemerlangan Profesional',
                            'type' => 'Sijil',
                            'date' => '02 Jan 2024',
                            'status' => 'verified',
                            'icon' => 'fas fa-certificate',
                            'color' => 'bg-blue-500',
                            'description' => 'Sijil pengiktirafan pencapaian profesional'
                        ],
                        [
                            'title' => 'Penceramah Jemputan - Konferens IT',
                            'type' => 'Pengiktirafan',
                            'date' => '20 Dis 2023',
                            'status' => 'verified',
                            'icon' => 'fas fa-microphone',
                            'color' => 'bg-green-500',
                            'description' => 'Penceramah jemputan di Konferens Teknologi Kebangsaan'
                        ],
                        [
                            'title' => 'Penerbitan Jurnal Antarabangsa',
                            'type' => 'Penerbitan',
                            'date' => '10 Dis 2023',
                            'status' => 'verified',
                            'icon' => 'fas fa-book',
                            'color' => 'bg-purple-500',
                            'description' => 'Artikel penyelidikan dalam jurnal IEEE'
                        ],
                        [
                            'title' => 'Hackathon Champion 2023',
                            'type' => 'Anugerah',
                            'date' => '25 Nov 2023',
                            'status' => 'verified',
                            'icon' => 'fas fa-code',
                            'color' => 'bg-red-500',
                            'description' => 'Juara Hackathon Pembangunan Aplikasi'
                        ],
                        [
                            'title' => 'Sijil Kepimpinan',
                            'type' => 'Sijil',
                            'date' => '15 Nov 2023',
                            'status' => 'pending',
                            'icon' => 'fas fa-user-tie',
                            'color' => 'bg-indigo-500',
                            'description' => 'Program kepimpinan dan pengurusan'
                        ]
                    ];

                    $statusConfig = [
                        'verified' => ['color' => 'bg-green-100 text-green-800', 'text' => 'Disahkan'],
                        'pending' => ['color' => 'bg-yellow-100 text-yellow-800', 'text' => 'Menunggu'],
                        'rejected' => ['color' => 'bg-red-100 text-red-800', 'text' => 'Ditolak']
                    ];

                    foreach ($achievements as $achievement) {
                        $status = $statusConfig[$achievement['status']];
                    ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition duration-200">
                        <div class="p-6">
                            <!-- Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 <?php echo $achievement['color']; ?> rounded-lg flex items-center justify-center">
                                    <i class="<?php echo $achievement['icon']; ?> text-white text-lg"></i>
                                </div>
                                <span class="px-2 py-1 <?php echo $status['color']; ?> text-xs rounded-full font-medium">
                                    <?php echo $status['text']; ?>
                                </span>
                            </div>

                            <!-- Content -->
                            <h3 class="text-lg font-semibold text-gray-800 mb-2"><?php echo $achievement['title']; ?></h3>
                            <p class="text-gray-600 text-sm mb-4"><?php echo $achievement['description']; ?></p>

                            <!-- Meta Info -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-tag mr-1"></i>
                                        <?php echo $achievement['type']; ?>
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar mr-1"></i>
                                        <?php echo $achievement['date']; ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-200">
                                <button class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </button>
                                <div class="flex space-x-2">
                                    <button class="text-green-600 hover:text-green-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <!-- Empty State (if no achievements) -->
                <div id="emptyState" class="hidden bg-white rounded-xl shadow-sm p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-trophy text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Tiada Pencapaian</h3>
                    <p class="text-gray-600 mb-6">Mulakan dengan menambah pencapaian pertama anda</p>
                    <button onclick="openAddAchievementModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-plus mr-2"></i>Tambah Pencapaian Pertama
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Achievement Modal -->
    <div id="addAchievementModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Tambah Pencapaian Baharu</h3>
                <button onclick="closeAddAchievementModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pencapaian</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Jenis</option>
                        <option value="award">Anugerah</option>
                        <option value="certificate">Sijil</option>
                        <option value="publication">Penerbitan</option>
                        <option value="recognition">Pengiktirafan</option>
                        <option value="other">Lain-lain</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pencapaian</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Anugerah Inovasi Teknologi">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Penerangan</label>
                    <textarea rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Terangkan pencapaian ini..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tarikh</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Muat Naik Dokumen (Pilihan)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600">Seret fail atau klik untuk muat naik</p>
                        <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Maks 5MB)</p>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeAddAchievementModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan Pencapaian</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddAchievementModal() {
            document.getElementById('addAchievementModal').classList.remove('hidden');
        }

        function closeAddAchievementModal() {
            document.getElementById('addAchievementModal').classList.add('hidden');
        }

        // Show empty state if no achievements
        document.addEventListener('DOMContentLoaded', function() {
            const achievementsGrid = document.querySelector('.grid.grid-cols-1');
            const emptyState = document.getElementById('emptyState');
            
            if (achievementsGrid && achievementsGrid.children.length === 0) {
                emptyState.classList.remove('hidden');
            }
        });
    </div>


    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>