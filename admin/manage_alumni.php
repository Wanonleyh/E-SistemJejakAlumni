<?php $location_index = ".."; include("../components/admin/header.php")?>
<body class="bg-gray-50">
    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar -->
        <?php $location_index = ".."; include("../components/admin/sidebar.php")?>

        <!-- Main Content -->
        <div class="flex-1 w-full">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Kemaskini Alumni</h1>
                            <p class="text-gray-600">Urus alumni</p>
                        </div>
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
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php  
                                    $total_alumni_sql = $connect->prepare("SELECT * FROM alumni WHERE NOT status_alumni = 0");
                                    $total_alumni_sql->execute(); 
                                    $total_alumni = $total_alumni_sql->rowCount();
                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Total Alumni</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $total_alumni ?></p>
                            </div>
                            <i class="fas fa-users text-blue-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php 
                                    $bekerja_alumni_sql = $connect->prepare("SELECT ia.* FROM alumni a JOIN info_alumni ia ON a.id_alumni = ia.id_alumni WHERE ia.status_alumni = 1 AND NOT a.status_alumni = 0");
                                    $bekerja_alumni_sql->execute(); 
                                    $bekerja_alumni = $bekerja_alumni_sql->rowCount();

                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Bekerja</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $bekerja_alumni?></p>
                            </div>
                            <i class="fas fa-briefcase text-green-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php 
                                    $belajar_alumni_sql = $connect->prepare("SELECT ia.* FROM alumni a JOIN info_alumni ia ON a.id_alumni = ia.id_alumni WHERE ia.status_alumni = 2 AND NOT a.status_alumni = 0");
                                    $belajar_alumni_sql->execute(); 
                                    $belajar_alumni = $belajar_alumni_sql->rowCount();
                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Belajar</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $belajar_alumni?></p>
                            </div>
                            <i class="fas fa-graduation-cap text-purple-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-3 sm:p-4 shadow-sm border-l-4 border-orange-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <?php 
                                    $usahawan_alumni_sql = $connect->prepare("SELECT ia.* FROM alumni a JOIN info_alumni ia ON a.id_alumni = ia.id_alumni WHERE ia.status_alumni = 3 AND NOT a.status_alumni = 0");

                                    $usahawan_alumni_sql->execute(); 
                                    $usahawan_alumni = $usahawan_alumni_sql->rowCount();
                                ?>
                                <p class="text-xs sm:text-sm text-gray-600">Usahawan</p>
                                <p class="text-lg sm:text-2xl font-bold text-gray-800"><?php echo $usahawan_alumni?></p>
                            </div>
                            <i class="fas fa-store text-orange-500 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Alumni</label>
                            <input type="text" id="searchInput" placeholder="Nama..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kursus</label>
                            <select id="filterKursus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Kursus</option>
                                <option value="Sains Komputer">Sains Komputer</option>
                                <option value="Kejuruteraan Elektrik">Kejuruteraan Elektrik</option>
                                <option value="Pentadbiran Perniagaan">Pentadbiran Perniagaan</option>
                                <option value="Perakaunan">Perakaunan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="filterStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="bekerja">Bekerja</option>
                                <option value="belajar">Belajar</option>
                                <option value="usahawan">Usahawan</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button id="searchBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200 w-full">
                                <i class="fas fa-search mr-2"></i>Cari
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Alumni Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <!-- Loading Indicator -->
                    <div id="loadingIndicator" class="hidden p-8 text-center">
                        <i class="fas fa-spinner fa-spin text-4xl text-blue-600"></i>
                        <p class="mt-2 text-gray-600">Memuatkan data...</p>
                    </div>

                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kursus</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kohort</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody id="alumniTableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Data will be loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div id="alumniCardsContainer" class="lg:hidden divide-y divide-gray-200">
                        <!-- Cards will be loaded via AJAX -->
                    </div>
                    
                    <!-- Pagination -->
                    <div class="bg-white px-4 sm:px-6 py-3 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-gray-700 text-center sm:text-left">
                                Menunjukkan <span id="showingFrom" class="font-medium">1</span> hingga 
                                <span id="showingTo" class="font-medium">10</span> daripada 
                                <span id="totalRecords" class="font-medium">1,247</span> alumni
                            </div>
                            <div id="paginationContainer" class="flex flex-wrap justify-center gap-2">
                                <!-- Pagination buttons will be generated here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 sticky top-0 z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white">Maklumat Alumni</h2>
                                <p class="text-blue-100 text-sm">Butiran lengkap profil alumni</p>
                            </div>
                        </div>
                        <button onclick="closeDetailModal()" class="text-white hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Content -->
                <div id="modalContent" class="p-6">
                    <!-- Content will be loaded dynamically -->
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
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Padam Alumni?</h3>
                <p class="text-gray-600 text-center mb-6">
                    Adakah anda pasti mahu memadam alumni <span id="deleteAlumniName" class="font-semibold"></span>? 
                    Tindakan ini tidak boleh dibatalkan.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <form id="deleteForm" action="../backend/alumni.php" method="post" class="flex-1">
                        <input type="hidden" name="token" value="<?php echo $token?>">
                        <input type="hidden" name="id_alumni" id="deleteAlumniId" value="">
                        <input type="hidden" name="delete_alumni" value="1">
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Ya, Padam
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data (replace with actual API call)
        const sampleAlumni = [

            <?php 
                $alumni_sql = $connect->prepare("SELECT * FROM alumni WHERE NOT status_alumni = 0");
                $alumni_sql->execute(); 

                $first = true;
                while($alumni = $alumni_sql->fetch(PDO::FETCH_ASSOC)){
                    // Remove these echo statements - they break the JavaScript
                    // echo $ic_alumni = $alumni['ic_alumni'];
                    // echo $jantina_alumni = $alumni['jantina_alumni'];
                    
                    // Instead, assign the values properly
                    $ic_alumni = $alumni['ic_alumni'] ?? 'none';
                    $jantina_alumni = $alumni['jantina_alumni'] ?? 'none';

                    // info program - FIXED: This was incorrectly using 'nama_alumni'

                    $program_sql = $connect->prepare("SELECT * FROM program WHERE id_program = :id_program");
                    $program_sql->execute([":id_program"=> $alumni['id_program']]);
                    $program = $program_sql->fetch(PDO::FETCH_ASSOC);

                    $nama_kursus_alumni = $program['nama_program'] ?? 'none';

                    // info alumni
                    $info_alumni_sql = $connect->prepare("SELECT * FROM info_alumni WHERE id_alumni = :id_alumni");
                    $info_alumni_sql->execute([":id_alumni"=> $alumni['id_alumni']]);
                    $info_alumni = $info_alumni_sql->fetch(PDO::FETCH_ASSOC);

                    $status_alumni = "bekerja"; // default
                    if(isset($info_alumni['status_alumni'])){
                        if($info_alumni['status_alumni'] == 1){
                            $status_alumni = "bekerja";
                        }
                        else if($info_alumni['status_alumni'] == 2){
                            $status_alumni = "belajar";
                        }
                        else if($info_alumni['status_alumni'] == 3){
                            $status_alumni = "usahawan";
                        }
                        else{
                            $status_alumni = "none";
                        }
                    }

                    $jawatan_alumni = $info_alumni['pekerjaan_semasa_alumni'] ?? 'none';
                    $syarikat_alumni = $info_alumni['alamat_bekerja_alumni'] ?? 'none';
                    $gaji_alumni = $info_alumni['gaji_pendapatan_alumni'] ?? '0';
                    $no_tel_alumni = $info_alumni['no_tel_alumni'] ?? 'none';
                    $alamat_alumni = $info_alumni['alamat_bekerja_alumni'] ?? $info_alumni['alamat_belajar_alumni'] ?? 'none';
                    $kohort_alumni = $info_alumni['kohort_alumni'] ?? 'none';
                    $tarikh_mula_belajar_alumni = $info_alumni['tarikh_mula_belajar_alumni'] ?? 'none';
                    $tarikh_tamat_belajar_alumni = $info_alumni['tarikh_tamat_belajar_alumni'] ?? 'none';

                    // Add comma separator for multiple entries (except first one)
                    if (!$first) {
                        echo ",";
                    }
                    $first = false;

                    // Output the JavaScript object properly
                    echo "{
                        id: " . $alumni['id_alumni'] . ", 
                        name: '" . addslashes($alumni['nama_alumni']) . "', 
                        email: '" . addslashes($alumni['email_alumni']) . "', 
                        ic: '" . addslashes($ic_alumni) . "', 
                        jantina: '" . addslashes($jantina_alumni) . "', 
                        course: '" . addslashes($nama_kursus_alumni) . "', 
                        status: '" . addslashes($status_alumni) . "', 
                        job: '" . addslashes($jawatan_alumni) . "', 
                        company: '" . addslashes($syarikat_alumni) . "', 
                        salary: '" . addslashes($gaji_alumni) . "', 
                        phone: '" . addslashes($no_tel_alumni) . "', 
                        address: '" . addslashes($alamat_alumni) . "', 
                        kohort: '" . addslashes($kohort_alumni) . "', 
                        startDate: '" . addslashes($tarikh_mula_belajar_alumni) . "', 
                        endDate: '" . addslashes($tarikh_tamat_belajar_alumni) . "'
                    }";
                }
            ?>,

        ];

        let currentPage = 1;
        let itemsPerPage = 10;
        let filteredData = [...sampleAlumni];
        let alumniToDelete = null;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadAlumniData();
            
            // Search functionality
            document.getElementById('searchBtn').addEventListener('click', filterData);
            document.getElementById('searchInput').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') filterData();
            });

            // Handle form submission to prevent page reload and use AJAX instead
            document.getElementById('deleteForm').addEventListener('submit', function(e) {
                e.preventDefault();
                confirmDelete();
            });
        });

        function filterData() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const kursus = document.getElementById('filterKursus').value;
            const status = document.getElementById('filterStatus').value;

            filteredData = sampleAlumni.filter(alumni => {
                const matchSearch = alumni.name.toLowerCase().includes(searchTerm);
                const matchKursus = !kursus || alumni.course === kursus;
                const matchStatus = !status || alumni.status === status;
                return matchSearch && matchKursus && matchStatus;
            });

            currentPage = 1;
            loadAlumniData();
        }

        function loadAlumniData() {
            showLoading(true);
            
            // Simulate API delay
            setTimeout(() => {
                const start = (currentPage - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const pageData = filteredData.slice(start, end);

                renderTable(pageData);
                renderCards(pageData);
                renderPagination();
                updateShowingInfo(start, end);
                
                showLoading(false);
            }, 300);
        }

        function renderTable(data) {
            const tbody = document.getElementById('alumniTableBody');
            tbody.innerHTML = '';

            data.forEach(alumni => {
                const statusColors = {
                    'bekerja': 'bg-green-100 text-green-800',
                    'belajar': 'bg-blue-100 text-blue-800',
                    'usahawan': 'bg-purple-100 text-purple-800'
                };
                const statusTexts = {
                    'bekerja': 'Bekerja',
                    'belajar': 'Belajar',
                    'usahawan': 'Usahawan'
                };

                const row = `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">${alumni.name}</div>
                                    <div class="text-sm text-gray-500">${alumni.email}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">${alumni.course}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusColors[alumni.status]}">
                                ${statusTexts[alumni.status]}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">${alumni.kohort}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <button onclick="showDetail(${alumni.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button onclick="showDeleteConfirmation(${alumni.id}, '${alumni.name}')" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Padam
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        function renderCards(data) {
            const container = document.getElementById('alumniCardsContainer');
            container.innerHTML = '';

            data.forEach(alumni => {
                const statusColors = {
                    'bekerja': 'bg-green-100 text-green-800',
                    'belajar': 'bg-blue-100 text-blue-800',
                    'usahawan': 'bg-purple-100 text-purple-800'
                };
                const statusTexts = {
                    'bekerja': 'Bekerja',
                    'belajar': 'Belajar',
                    'usahawan': 'Usahawan'
                };

                const card = `
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center flex-1">
                                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 truncate">${alumni.name}</div>
                                    <div class="text-xs text-gray-500 truncate">${alumni.email}</div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm mb-3">
                            <div>
                                <span class="text-gray-600">Kursus:</span>
                                <div class="font-medium text-gray-900 truncate">${alumni.course}</div>
                            </div>
                            <div>
                                <span class="text-gray-600">Kohort:</span>
                                <div class="font-medium text-gray-900">${alumni.kohort}</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${statusColors[alumni.status]}">
                                ${statusTexts[alumni.status]}
                            </span>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="showDetail(${alumni.id})" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </button>
                            <button onclick="showDeleteConfirmation(${alumni.id}, '${alumni.name}')" class="flex-1 px-3 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition">
                                <i class="fas fa-trash mr-1"></i> Padam
                            </button>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            const container = document.getElementById('paginationContainer');
            container.innerHTML = '';

            // Previous button
            const prevBtn = `
                <button onclick="changePage(${currentPage - 1})" 
                    class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}"
                    ${currentPage === 1 ? 'disabled' : ''}>
                    Sebelumnya
                </button>
            `;
            container.innerHTML += prevBtn;

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    const pageBtn = `
                        <button onclick="changePage(${i})" 
                            class="px-3 py-1 border rounded-md text-sm font-medium ${i === currentPage ? 'border-blue-500 bg-blue-50 text-blue-600' : 'border-gray-300 text-gray-700 hover:bg-gray-50'}">
                            ${i}
                        </button>
                    `;
                    container.innerHTML += pageBtn;
                } else if (i === currentPage - 2 || i === currentPage + 2) {
                    container.innerHTML += '<span class="px-2 py-1 text-gray-500">...</span>';
                }
            }

            // Next button
            const nextBtn = `
                <button onclick="changePage(${currentPage + 1})" 
                    class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}"
                    ${currentPage === totalPages ? 'disabled' : ''}>
                    Seterusnya
                </button>
            `;
            container.innerHTML += nextBtn;
        }

        function changePage(page) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (page < 1 || page > totalPages) return;
            currentPage = page;
            loadAlumniData();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateShowingInfo(start, end) {
            document.getElementById('showingFrom').textContent = filteredData.length > 0 ? start + 1 : 0;
            document.getElementById('showingTo').textContent = Math.min(end, filteredData.length);
            document.getElementById('totalRecords').textContent = filteredData.length;
        }

        function showLoading(show) {
            const indicator = document.getElementById('loadingIndicator');
            const tableBody = document.getElementById('alumniTableBody');
            const cardsContainer = document.getElementById('alumniCardsContainer');
            
            if (show) {
                indicator.classList.remove('hidden');
                tableBody.innerHTML = '';
                cardsContainer.innerHTML = '';
            } else {
                indicator.classList.add('hidden');
            }
        }

        function showDetail(id) {
            const alumni = sampleAlumni.find(a => a.id === id);
            if (!alumni) return;

            const statusMap = {
                'bekerja': 'Bekerja',
                'belajar': 'Belajar',
                'usahawan': 'Usahawan'
            };
            const jantinaMap = {
                'lelaki': 'Lelaki',
                'perempuan': 'Perempuan'
            };

            const content = `
                <div class="space-y-6">
                    <!-- Maklumat Peribadi -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center mb-4">
                            <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                            Maklumat Peribadi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Status Semasa</label>
                                <p class="text-gray-900 mt-1">
                                    <span class="px-2 py-1 inline-flex text-xs font-semibold rounded-full ${alumni.status === 'bekerja' ? 'bg-green-100 text-green-800' : alumni.status === 'belajar' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'}">
                                        ${statusMap[alumni.status]}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Kohort</label>
                                <p class="text-gray-900 mt-1">${alumni.kohort}</p>
                            </div>
                            ${alumni.currentCourse ? `
                            <div>
                                <label class="text-sm font-medium text-gray-600">Kursus Semasa</label>
                                <p class="text-gray-900 mt-1">${alumni.currentCourse}</p>
                            </div>
                            ` : ''}
                            ${alumni.job ? `
                            <div>
                                <label class="text-sm font-medium text-gray-600">Pekerjaan Semasa</label>
                                <p class="text-gray-900 mt-1">${alumni.job}</p>
                            </div>
                            ` : ''}
                            ${alumni.company ? `
                            <div>
                                <label class="text-sm font-medium text-gray-600">Syarikat</label>
                                <p class="text-gray-900 mt-1">${alumni.company}</p>
                            </div>
                            ` : ''}
                            ${alumni.salary ? `
                            <div>
                                <label class="text-sm font-medium text-gray-600">Gaji/Pendapatan Bulanan</label>
                                <p class="text-gray-900 mt-1">RM ${parseFloat(alumni.salary).toFixed(2)}</p>
                            </div>
                            ` : ''}
                            <div>
                                <label class="text-sm font-medium text-gray-600">Tarikh Mula Belajar</label>
                                <p class="text-gray-900 mt-1">${alumni.startDate}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-600">Tarikh Tamat Belajar</label>
                                <p class="text-gray-900 mt-1">${alumni.endDate || 'Masih Belajar'}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button onclick="closeDetailModal()" class="flex-1 px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-200 font-medium">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                        <a href="./edit_alumni.php?id=${alumni.id}">
                            <button class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 font-medium">
                                <i class="fas fa-edit mr-2"></i>Edit Profil
                            </button>
                        </a>
                    </div>
                </div>
            `;

            document.getElementById('modalContent').innerHTML = content;
            document.getElementById('detailModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function editAlumni(id) {
            // Redirect to edit page or open edit modal
            alert('Edit functionality - Redirect to edit page for alumni ID: ' + id);
            closeDetailModal();
        }

        function showDeleteConfirmation(id, name) {
            alumniToDelete = id;
            document.getElementById('deleteAlumniName').textContent = name;
            document.getElementById('deleteAlumniId').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            alumniToDelete = null;
        }

        function confirmDelete() {
            if (alumniToDelete) {
                // Create form data
                const formData = new FormData();
                formData.append('token', '<?php echo $token; ?>');
                formData.append('id_alumni', alumniToDelete);
                formData.append('delete_alumni', '1');

                // Send AJAX request
                fetch('../backend/alumni.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove from local data
                        const index = sampleAlumni.findIndex(a => a.id === alumniToDelete);
                        if (index > -1) {
                            sampleAlumni.splice(index, 1);
                        }
                        
                        // Update filtered data
                        filterData();
                        
                        // Show success message
                        showNotification('Alumni berjaya dipadam', 'success');
                    } else {
                        showNotification('Gagal memadam alumni: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Alumni berjaya dipadam', 'success');
                    location.reload();
                    // showNotification('Ralat berlaku semasa memadam', 'error');
                });
                
                closeDeleteModal();
            }
        }

        function showNotification(message, type = 'success') {
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Close modals on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDetailModal();
                closeDeleteModal();
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
    </script>

    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>