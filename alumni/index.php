<?php $location_index = ".."; include("../components/alumni/header.php")?>
<?php $activePage = 'alumni_dashboard'; ?>
<body class="bg-gray-50">
    <div class="flex">
        <?php 
        
            $info_alumni_sql = $connect->prepare("SELECT * FROM info_alumni WHERE id_alumni = :id_alumni");
            $info_alumni_sql->execute([":id_alumni"=> $alumni['id_alumni']]);
            $info_alumni = $info_alumni_sql->fetch(PDO::FETCH_ASSOC);
            
            $jawatan_alumni = $info_alumni['pekerjaan_semasa_alumni'] ?? '';
            $syarikat_alumni = $info_alumni['alamat_bekerja_alumni'] ?? '';
            $gaji_alumni = $info_alumni['gaji_pendapatan_alumni'] ?? '0';
            $no_tel_alumni = $alumni['no_tel_alumni'] ?? '';
            $alamat_alumni = $alumni['alamat_alumni'] ?? '';
            $kohort_alumni = $info_alumni['kohort_alumni'] ?? '';
            $tarikh_mula_belajar_alumni = $info_alumni['tarikh_mula_belajar_alumni'] ?? '';
            $tarikh_tamat_belajar_alumni = $info_alumni['tarikh_tamat_belajar_alumni'] ?? '';
            $kursus_semasa_alumni = $info_alumni['kursus_semasa_alumni'] ?? '';
            $pekerjaan_semasa_alumni = $info_alumni['pekerjaan_semasa_alumni'] ?? '';
            $alamat_belajar_alumni = $info_alumni['alamat_belajar_alumni'] ?? '';
            $alamat_bekerja_alumni = $info_alumni['alamat_bekerja_alumni'] ?? '';
            $status_alumni = $info_alumni['status_alumni'] ?? 'bekerja';

        ?>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Profil Saya</h1>
                            <p class="text-gray-600">Kemaskini maklumat peribadi dan kerjaya anda</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <form action="<?php echo $location_index?>/backend/alumni.php" method="post">

                                <input type="hidden" name="token" value="<?php echo $token?>">
                                <!-- <i class="fas fa-trophy w-5 text-center"></i> -->
                                <div class="text-right">
                                    <button type="submit" name="signout_alumni" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Log Keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="p-6">
                <!-- Profile Form -->
                <div class="max-w-6xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- Form Header -->
                         <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-edit text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-white">Kemaskini Maklumat Profil</h2>
                                        <p class="text-blue-100">Sila pastikan semua maklumat adalah terkini dan tepat</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <form id="alumniForm" method="POST" action="../backend/alumni.php" class="p-6 space-y-6">
                            <input type="hidden" name="kemaskini_alumni" value="1">
                            <input type="hidden" name="id_alumni" value="<?php echo $alumni['id_alumni']; ?>">
                            <input type="hidden" name="token" value="<?php echo $token ?>">

                            <!-- Maklumat Peribadi Section -->
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                                        Maklumat Peribadi
                                    </h3>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">
                                        <i class="fas fa-check mr-1"></i>Lengkap
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Nama Kursus -->
                                    <div>
                                        <label for="id_program" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Kursus <span class="text-red-500">*</span>
                                        </label>
                                        <select 
                                            id="id_program" 
                                            name="id_program" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            required
                                        >
                                            <option value="">Pilih Kursus</option>
                                            <?php 
                                                // program
                                                $program = $connect->prepare("SELECT * FROM program WHERE NOT status_program = 0");
                                                $program->execute();
                                                while($programs = $program->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                    <option value="<?php echo $programs['id_program'] ?>" <?php if($alumni['id_program'] == $programs['id_program']) echo 'selected'; ?>>
                                                        <?php echo $programs['nama_program'] ?>
                                                    </option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- KOHOT -->
                                    <div>
                                        <label for="kohort_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            KOHOT (Tahun Kelulusan) <span class="text-red-500">*</span>
                                        </label>
                                        <select 
                                            id="kohort_alumni" 
                                            name="kohort_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            required
                                        >
                                            <option value="">Pilih Tahun</option>
                                            <?php 
                                                // from 1999 to current year + 2
                                                $currentYear = date('Y');
                                                for ($year = 1999; $year <= $currentYear + 2; $year++) {
                                                    echo "<option value=\"$year\"";
                                                    if ($kohort_alumni == $year) { echo " selected"; }
                                                    echo ">$year</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Nama Penuh -->
                                    <div>
                                        <label for="nama_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Penuh <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="nama_alumni" 
                                            name="nama_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($alumni['nama_alumni'])?>"
                                            required
                                        >
                                    </div>

                                    <!-- No. Kad Pengenalan -->
                                    <div>
                                        <label for="ic_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            No. Kad Pengenalan <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="ic_alumni" 
                                            name="ic_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($alumni['ic_alumni'] ?? '')  ?>"
                                            pattern="[0-9]{12}"
                                            maxlength="12"
                                            required
                                        >
                                    </div>

                                    <!-- Jantina -->
                                    <div>
                                        <label for="jantina_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Jantina <span class="text-red-500">*</span>
                                        </label>
                                        <select 
                                            id="jantina_alumni" 
                                            name="jantina_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            required
                                        >
                                            <option value="">Pilih Jantina</option>
                                            <option value="lelaki" <?php echo $alumni['jantina_alumni'] == 'lelaki' ? 'selected' : '' ?>>Lelaki</option>
                                            <option value="perempuan" <?php echo $alumni['jantina_alumni'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Maklumat Hubungan Section -->
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-address-book text-green-500 mr-2"></i>
                                        Maklumat Hubungan
                                    </h3>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">
                                        <i class="fas fa-check mr-1"></i>Lengkap
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Emel -->
                                    <div>
                                        <label for="email_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Alamat Emel <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="email" 
                                            id="email_alumni" 
                                            name="email_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($alumni['email_alumni'])?>"
                                            required
                                        >
                                    </div>

                                    <!-- Nombor Telefon -->
                                    <div>
                                        <label for="no_tel_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nombor Telefon <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            id="no_tel_alumni" 
                                            name="no_tel_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($no_tel_alumni)?>"
                                            required
                                        >
                                    </div>
                                </div>

                                <!-- Alamat Tempat Tinggal -->
                                <div class="mt-4">
                                    <label for="alamat_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                        Alamat Tempat Tinggal <span class="text-red-500">*</span>
                                    </label>
                                    <textarea 
                                        id="alamat_alumni" 
                                        name="alamat_alumni" 
                                        rows="3" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                        required
                                    ><?php echo htmlspecialchars($alamat_alumni)?></textarea>
                                </div>
                            </div>

                            <!-- Maklumat Pendidikan & Kerjaya Section -->
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-briefcase text-purple-500 mr-2"></i>
                                        Maklumat Pendidikan & Kerjaya
                                    </h3>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-medium">
                                        <i class="fas fa-sync-alt mr-1"></i>Perlu Kemaskini
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kursus Semasa -->
                                    <div>
                                        <label for="kursus_semasa_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kursus Semasa (Jika Masih Belajar)
                                        </label>
                                        <input 
                                            type="text" 
                                            id="kursus_semasa_alumni" 
                                            name="kursus_semasa_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            placeholder="Masukkan kursus semasa"
                                            value="<?php echo htmlspecialchars($kursus_semasa_alumni)?>"
                                        >
                                    </div>

                                    <!-- Pekerjaan Semasa -->
                                    <div>
                                        <label for="pekerjaan_semasa_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Pekerjaan Semasa
                                        </label>
                                        <input 
                                            type="text" 
                                            id="pekerjaan_semasa_alumni" 
                                            name="pekerjaan_semasa_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($pekerjaan_semasa_alumni)?>"
                                        >
                                    </div>

                                    <!-- Tarikh Mula Belajar -->
                                    <div>
                                        <label for="tarikh_mula_belajar_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tarikh Mula Belajar <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="date" 
                                            id="tarikh_mula_belajar_alumni" 
                                            name="tarikh_mula_belajar_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($tarikh_mula_belajar_alumni)?>"
                                            required
                                        >
                                    </div>

                                    <!-- Tarikh Tamat Belajar -->
                                    <div>
                                        <label for="tarikh_tamat_belajar_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tarikh Tamat Belajar
                                        </label>
                                        <input 
                                            type="date" 
                                            id="tarikh_tamat_belajar_alumni" 
                                            name="tarikh_tamat_belajar_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($tarikh_tamat_belajar_alumni)?>"
                                        >
                                    </div>

                                    <!-- Gaji/Pendapatan -->
                                    <div>
                                        <label for="gaji_pendapatan_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Gaji/Pendapatan Bulanan (RM)
                                        </label>
                                        <input 
                                            type="number" 
                                            id="gaji_pendapatan_alumni" 
                                            name="gaji_pendapatan_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            value="<?php echo htmlspecialchars($gaji_alumni)?>"
                                            min="0"
                                            step="0.01"
                                        >
                                    </div>

                                    <!-- Status Alumni -->
                                    <div>
                                        <label for="status_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                            Status Semasa <span class="text-red-500">*</span>
                                        </label>
                                        <select 
                                            id="status_alumni" 
                                            name="status_alumni" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            required
                                        >
                                            <option value="">Pilih Status</option>
                                            <option value="1" <?php echo $status_alumni == '1' ? 'selected' : '' ?>>Bekerja</option>
                                            <option value="2" <?php echo $status_alumni == '2' ? 'selected' : '' ?>>Belajar</option>
                                            <option value="3" <?php echo $status_alumni == '3' ? 'selected' : '' ?>>Usahawan</option>
                                            <!-- <option value="4" <?php echo $status_alumni == '4' ? 'selected' : '' ?>>Campur (Bekerja & Belajar)</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat Institusi & Tempat Kerja Section -->
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-building text-orange-500 mr-2"></i>
                                        Alamat Institusi & Tempat Kerja
                                    </h3>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-medium">
                                        <i class="fas fa-sync-alt mr-1"></i>Perlu Kemaskini
                                    </span>
                                </div>
                                
                                <!-- Alamat Tempat Belajar -->
                                <div class="mb-4">
                                    <label for="alamat_belajar_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                        Alamat Institusi Pengajian
                                    </label>
                                    <textarea 
                                        id="alamat_belajar_alumni" 
                                        name="alamat_belajar_alumni" 
                                        rows="2" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                        placeholder="Masukkan alamat institusi pengajian (jika masih belajar)"
                                    ><?php echo htmlspecialchars($alamat_belajar_alumni)?></textarea>
                                </div>

                                <!-- Alamat Tempat Bekerja -->
                                <div>
                                    <label for="alamat_bekerja_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                        Alamat Tempat Bekerja
                                    </label>
                                    <textarea 
                                        id="alamat_bekerja_alumni" 
                                        name="alamat_bekerja_alumni" 
                                        rows="2" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                        placeholder="Masukkan alamat tempat bekerja (jika bekerja)"
                                    ><?php echo htmlspecialchars($alamat_bekerja_alumni)?></textarea>
                                </div>
                            </div>

                            <!-- Hidden Fields -->
                            <input type="hidden" id="last_updated_alumni" name="last_updated_alumni" value="<?php echo date('Y-m-d'); ?>">

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 justify-between items-center pt-6">
                                <div class="flex items-center space-x-2 text-sm text-gray-600">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                    <span>Kemaskini terakhir: <?php echo $info_alumni['last_updated_alumni'] ?? 'Belum dikemaskini'; ?></span>
                                </div>
                                <div class="flex gap-4">
                                    <button 
                                        type="submit" 
                                        name="kemaskini_alumni"
                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 font-medium"
                                    >
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set last updated date
        document.getElementById('last_updated_alumni').value = new Date().toISOString().split('T')[0];

        // Form validation for status change
        document.getElementById('status_alumni').addEventListener('change', function() {
            const status = this.value;
            const belajarFields = ['kursus_semasa_alumni', 'alamat_belajar_alumni'];
            const kerjaFields = ['pekerjaan_semasa_alumni', 'alamat_bekerja_alumni', 'gaji_pendapatan_alumni'];
            
            belajarFields.forEach(field => {
                const element = document.getElementById(field);
                element.required = false;
                element.closest('div').classList.remove('border-l-4', 'border-blue-500', 'pl-3');
            });
            
            kerjaFields.forEach(field => {
                const element = document.getElementById(field);
                element.required = false;
                element.closest('div').classList.remove('border-l-4', 'border-blue-500', 'pl-3');
            });

            if (status === 'belajar') {
                belajarFields.forEach(field => {
                    const element = document.getElementById(field);
                    element.required = true;
                    element.closest('div').classList.add('border-l-4', 'border-blue-500', 'pl-3');
                });
            } else if (status === 'bekerja' || status === 'usahawan') {
                kerjaFields.forEach(field => {
                    const element = document.getElementById(field);
                    element.required = true;
                    element.closest('div').classList.add('border-l-4', 'border-blue-500', 'pl-3');
                });
            } else if (status === 'campur') {
                [...belajarFields, ...kerjaFields].forEach(field => {
                    const element = document.getElementById(field);
                    element.required = true;
                    element.closest('div').classList.add('border-l-4', 'border-blue-500', 'pl-3');
                });
            }
        });

        // Form submission handler
        document.getElementById('alumniForm').addEventListener('submit', function(e) {
            const tarikhMula = new Date(document.getElementById('tarikh_mula_belajar_alumni').value);
            const tarikhTamat = document.getElementById('tarikh_tamat_belajar_alumni').value;
            
            if (tarikhTamat) {
                const tarikhTamatDate = new Date(tarikhTamat);
                if (tarikhTamatDate < tarikhMula) {
                    alert('Tarikh tamat belajar tidak boleh lebih awal daripada tarikh mula belajar!');
                    e.preventDefault();
                    return;
                }
            }

            const ic = document.getElementById('ic_alumni').value;
            if (ic && !/^\d{12}$/.test(ic)) {
                alert('Sila masukkan nombor kad pengenalan yang sah (12 digit)');
                e.preventDefault();
                return;
            }
        });

        // Input validation
        document.querySelectorAll('input, select, textarea').forEach(element => {
            element.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value) {
                    this.classList.add('border-red-500');
                    this.classList.remove('border-gray-300', 'focus:ring-blue-500');
                    this.classList.add('focus:ring-red-500');
                } else {
                    this.classList.remove('border-red-500', 'focus:ring-red-500');
                    this.classList.add('border-gray-300', 'focus:ring-blue-500');
                }
            });
        });

        // Email validation
        document.getElementById('email_alumni').addEventListener('blur', function() {
            const email = this.value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailPattern.test(email)) {
                this.classList.add('border-red-500');
                alert('Sila masukkan alamat emel yang sah');
            }
        });

        // Phone validation
        document.getElementById('no_tel_alumni').addEventListener('blur', function() {
            const phone = this.value.replace(/\s+/g, '');
            const phonePattern = /^(\+?6?01)[0-46-9]-*[0-9]{7,8}$/;
            
            if (phone && !phonePattern.test(phone)) {
                this.classList.add('border-red-500');
                alert('Sila masukkan nombor telefon Malaysia yang sah (contoh: +60123456789)');
            }
        });

        // Format salary
        document.getElementById('gaji_pendapatan_alumni').addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
    </script>
    <?php $location_index = ".."; include("../components/footer.php"); ?>
</body>
</html>