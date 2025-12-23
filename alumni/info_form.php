<?php $location_index = ".."; include("../components/header.php")?>

<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-700 mb-2">Borang Maklumat Alumni</h1>
            <p class="text-gray-600">Sila isi semua maklumat yang diperlukan di bawah</p>
        </div>

        <!-- Form Container -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 md:p-8">
            <form id="alumniForm" class="space-y-6">
                <!-- Maklumat Peribadi Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Maklumat Peribadi</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Kursus -->
                        <div>
                            <label for="nama_kursus" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kursus <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="nama_kursus" 
                                name="nama_kursus" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                required>
                                <option value="">Pilih Kursus</option>
                                <option value="Sains Komputer">Sains Komputer</option>
                                <option value="Pentadbiran Perniagaan">Pentadbiran Perniagaan</option>
                                <option value="Kejuruteraan Elektrik">Kejuruteraan Elektrik</option>
                                <option value="Kejuruteraan Mekanikal">Kejuruteraan Mekanikal</option>
                                <option value="Perakaunan">Perakaunan</option>
                                <option value="Psikologi">Psikologi</option>
                                <option value="Perubatan">Perubatan</option>
                                <option value="Undang-undang">Undang-undang</option>
                            </select>
                        </div>

                        <!-- KOHOT -->
                        <div>
                            <label for="kohot_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                                KOHOT (Tahun Kelulusan) <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="kohot_alumni" 
                                name="kohot_alumni" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                required>
                                <option value="">Pilih Tahun</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                placeholder="Masukkan nama penuh"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                placeholder="Contoh: 901231145678"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                required
                            >
                                <option value="">Pilih Jantina</option>
                                <option value="Lelaki">Lelaki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Maklumat Hubungan Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Maklumat Hubungan</h2>
                    
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                placeholder="emel.anda@contoh.com"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                placeholder="+60 12-345 6789"
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                            placeholder="Masukkan alamat tempat tinggal lengkap"
                            required
                        ></textarea>
                    </div>
                </div>

                <!-- Maklumat Pendidikan & Kerjaya Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Maklumat Pendidikan & Kerjaya</h2>
                    
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                placeholder="Masukkan kursus semasa"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                placeholder="Masukkan jawatan dan syarikat"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                placeholder="0.00"
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                                required
                            >
                                <option value="">Pilih Status</option>
                                <option value="bekerja">Bekerja</option>
                                <option value="belajar">Belajar</option>
                                <option value="usahawan">Usahawan</option>
                                <option value="campur">Campur (Bekerja & Belajar)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Alamat Institusi & Tempat Kerja Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Alamat Institusi & Tempat Kerja</h2>
                    
                    <!-- Alamat Tempat Belajar -->
                    <div class="mb-4">
                        <label for="alamat_belajar_alumni" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Institusi Pengajian
                        </label>
                        <textarea 
                            id="alamat_belajar_alumni" 
                            name="alamat_belajar_alumni" 
                            rows="2" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                            placeholder="Masukkan alamat institusi pengajian (jika masih belajar)"
                        ></textarea>
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                            placeholder="Masukkan alamat tempat bekerja (jika bekerja)"
                        ></textarea>
                    </div>
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" id="last_updated_alumni" name="last_updated_alumni">

                <!-- Tindakan Form -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6">
                    <button 
                        type="button" 
                        onclick="resetForm()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200 font-medium"
                    >
                        <i class="fas fa-redo mr-2"></i>Set Semula
                    </button>
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200 font-medium transform hover:scale-105"
                    >
                        <i class="fas fa-save mr-2"></i>Hantar Maklumat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('last_updated_alumni').value = new Date().toISOString().split('T')[0];

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

        document.getElementById('alumniForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const tarikhMula = new Date(document.getElementById('tarikh_mula_belajar_alumni').value);
            const tarikhTamat = document.getElementById('tarikh_tamat_belajar_alumni').value;
            
            if (tarikhTamat) {
                const tarikhTamatDate = new Date(tarikhTamat);
                if (tarikhTamatDate < tarikhMula) {
                    alert('Tarikh tamat belajar tidak boleh lebih awal daripada tarikh mula belajar!');
                    return;
                }
            }

            const ic = document.getElementById('ic_alumni').value;
            if (ic && !/^\d{12}$/.test(ic)) {
                alert('Sila masukkan nombor kad pengenalan yang sah (12 digit)');
                return;
            }

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            console.log('Data Form Alumni:', data);
            
            showSummary(data);
        });

        function resetForm() {
            if (confirm('Adakah anda pasti mahu menetapkan semula borang? Semua data akan hilang.')) {
                document.getElementById('alumniForm').reset();
                document.getElementById('last_updated_alumni').value = new Date().toISOString().split('T')[0];
            }
        }

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

        document.getElementById('email_alumni').addEventListener('blur', function() {
            const email = this.value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailPattern.test(email)) {
                this.classList.add('border-red-500');
                alert('Sila masukkan alamat emel yang sah');
            }
        });

        document.getElementById('no_tel_alumni').addEventListener('blur', function() {
            const phone = this.value.replace(/\s+/g, '');
            const phonePattern = /^(\+?6?01)[0-46-9]-*[0-9]{7,8}$/;
            
            if (phone && !phonePattern.test(phone)) {
                this.classList.add('border-red-500');
                alert('Sila masukkan nombor telefon Malaysia yang sah (contoh: +60123456789)');
            }
        });

        document.getElementById('gaji_pendapatan_alumni').addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });

        function showSummary(data) {
            const statusMap = {
                'bekerja': 'Bekerja',
                'belajar': 'Belajar',
                'usahawan': 'Usahawan',
                'campur': 'Campur (Bekerja & Belajar)'
            };

            const jantinaMap = {
                'Lelaki': 'Lelaki',
                'Perempuan': 'Perempuan'
            };

            const summary = `
                Ringkasan Maklumat Alumni:

                Nama: ${data.nama_alumni}
                No. KP: ${data.ic_alumni}
                Jantina: ${jantinaMap[data.jantina_alumni]}
                Kursus: ${data.nama_kursus}
                KOHOT: ${data.kohot_alumni}

                Emel: ${data.email_alumni}
                Telefon: ${data.no_tel_alumni}
                Alamat: ${data.alamat_alumni}

                Tarikh Mula Belajar: ${data.tarikh_mula_belajar_alumni}
                Tarikh Tamat Belajar: ${data.tarikh_tamat_belajar_alumni || 'Masih Belajar'}

                Status: ${statusMap[data.status_alumni]}
                ${data.pekerjaan_semasa_alumni ? `Pekerjaan: ${data.pekerjaan_semasa_alumni}` : ''}
                ${data.kursus_semasa_alumni ? `Kursus Semasa: ${data.kursus_semasa_alumni}` : ''}
                ${data.gaji_pendapatan_alumni ? `Gaji: RM ${data.gaji_pendapatan_alumni}` : ''}

                Tarikh Kemaskini: ${data.last_updated_alumni}
            `.trim();

            if (confirm(`${summary}\n\nAdakah anda pasti mahu menghantar maklumat ini?`)) {
                alert('Borang berjaya dihantar! (Semak konsol untuk data lengkap)');
            }
        }
    </script>
    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>