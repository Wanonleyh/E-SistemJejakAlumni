<?php 
    $location_index = "..";
    include("../components/admin/header.php");

// Calculate Key Metrics
try {
    // Total Alumni Count
    $total_alumni_sql = $connect->prepare("SELECT COUNT(*) as total FROM alumni WHERE status_alumni != 0");
    $total_alumni_sql->execute();
    $total_alumni = $total_alumni_sql->fetch(PDO::FETCH_ASSOC)['total'];

    // Employment Rate (Working Alumni / Total Alumni with info)
    // Based on your info_alumni table, status_alumni values: 1=Bekerja, 2=Belajar, 3=Usahawan, etc.
    $working_sql = $connect->prepare("
        SELECT COUNT(DISTINCT id_alumni) as working_count 
        FROM info_alumni 
        WHERE status_alumni = 1
    ");
    $working_sql->execute();
    $working_count = $working_sql->fetch(PDO::FETCH_ASSOC)['working_count'];
    $employment_rate = $total_alumni > 0 ? round(($working_count / $total_alumni) * 100, 1) : 0;

    // Average Salary
    $salary_sql = $connect->prepare("
        SELECT AVG(CAST(gaji_pendapatan_alumni AS DECIMAL(10,2))) as avg_salary 
        FROM info_alumni 
        WHERE (status_alumni = 1 OR status_alumni = 3)  AND gaji_pendapatan_alumni IS NOT NULL AND gaji_pendapatan_alumni != '' AND gaji_pendapatan_alumni != '0'
    ");
    $salary_sql->execute();
    $avg_salary_result = $salary_sql->fetch(PDO::FETCH_ASSOC)['avg_salary'];
    $avg_salary = $avg_salary_result ? round($avg_salary_result, 2) : 0;

    // Further Studies Rate
    $studying_sql = $connect->prepare("
        SELECT COUNT(DISTINCT id_alumni) as studying_count 
        FROM info_alumni 
        WHERE status_alumni = 2
    ");
    $studying_sql->execute();
    $studying_count = $studying_sql->fetch(PDO::FETCH_ASSOC)['studying_count'];
    $studying_rate = $total_alumni > 0 ? round(($studying_count / $total_alumni) * 100, 1) : 0;

    // Alumni Status Distribution from info_alumni table
    $status_sql = $connect->prepare("
        SELECT 
            status_alumni,
            COUNT(*) as count
        FROM info_alumni 
        WHERE status_alumni IN (1, 2, 3)
        GROUP BY status_alumni
    ");
    $status_sql->execute();
    $status_data = $status_sql->fetchAll(PDO::FETCH_ASSOC);

    // Initialize status counts
    $working = 0;
    $studying = 0;
    $entrepreneur = 0;

    foreach ($status_data as $status) {
        switch ($status['status_alumni']) {
            case 1: $working = $status['count']; break;
            case 2: $studying = $status['count']; break;
            case 3: $entrepreneur = $status['count']; break;
        }
    }

    // Calculate percentages
    $total_with_status = $working + $studying + $entrepreneur;
    if ($total_with_status > 0) {
        $working_percent = round(($working / $total_with_status) * 100, 1);
        $studying_percent = round(($studying / $total_with_status) * 100, 1);
        $entrepreneur_percent = round(($entrepreneur / $total_with_status) * 100, 1);
        $mixed_percent = 0; // No mixed status in your table structure
    } else {
        $working_percent = $studying_percent = $entrepreneur_percent = $mixed_percent = 0;
    }

    // Average Salary by Program (Course)
    $salary_by_course_sql = $connect->prepare("
        SELECT 
            p.nama_program,
            AVG(CAST(ia.gaji_pendapatan_alumni AS DECIMAL(10,2))) as avg_salary
        FROM info_alumni ia
        JOIN alumni a ON ia.id_alumni = a.id_alumni
        JOIN program p ON a.id_program = p.id_program
        WHERE (ia.status_alumni = 1 OR ia.status_alumni = 3) 
            AND ia.gaji_pendapatan_alumni IS NOT NULL 
            AND ia.gaji_pendapatan_alumni != '' 
            AND ia.gaji_pendapatan_alumni != '0'
        GROUP BY p.nama_program
        ORDER BY avg_salary DESC
        LIMIT 8
    ");
    $salary_by_course_sql->execute();
    $salary_by_course = $salary_by_course_sql->fetchAll(PDO::FETCH_ASSOC);

    // Popular Programs (Alumni count by program)
    $popular_courses_sql = $connect->prepare("
        SELECT 
            p.nama_program,
            COUNT(a.id_alumni) as student_count
        FROM alumni a
        JOIN program p ON a.id_program = p.id_program
        WHERE a.status_alumni != 0
        GROUP BY p.nama_program
        ORDER BY student_count DESC
        LIMIT 5
    ");
    $popular_courses_sql->execute();
    $popular_courses = $popular_courses_sql->fetchAll(PDO::FETCH_ASSOC);

    // Calculate percentages for popular courses
    $total_students = 0;
    foreach ($popular_courses as $course) {
        $total_students += $course['student_count'];
    }
    foreach ($popular_courses as &$course) {
        $course['percentage'] = $total_students > 0 ? round(($course['student_count'] / $total_students) * 100, 1) : 0;
    }

    // Employment by Industry (Based on pekerjaan_semasa_alumni)
    $industry_sql = $connect->prepare("
        SELECT 
            CASE 
                WHEN LOWER(pekerjaan_semasa_alumni) LIKE '%tech%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%software%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%it%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%programmer%' THEN 'Teknologi'
                WHEN LOWER(pekerjaan_semasa_alumni) LIKE '%bank%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%finance%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%account%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%kewangan%' THEN 'Kewangan'
                WHEN LOWER(pekerjaan_semasa_alumni) LIKE '%manufactur%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%factory%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%production%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%pembuatan%' THEN 'Pembuatan'
                WHEN LOWER(pekerjaan_semasa_alumni) LIKE '%teacher%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%lecturer%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%education%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%pengajar%' THEN 'Pendidikan'
                WHEN LOWER(pekerjaan_semasa_alumni) LIKE '%health%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%hospital%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%clinic%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%kesihatan%' THEN 'Kesihatan'
                WHEN LOWER(pekerjaan_semasa_alumni) LIKE '%engineer%' OR LOWER(pekerjaan_semasa_alumni) LIKE '%kejuruteraan%' THEN 'Kejuruteraan'
                ELSE 'Lain-lain'
            END as industry,
            COUNT(*) as count
        FROM info_alumni 
        WHERE status_alumni = 1 
            AND pekerjaan_semasa_alumni IS NOT NULL 
            AND pekerjaan_semasa_alumni != ''
        GROUP BY industry
        ORDER BY count DESC
        LIMIT 6
    ");
    $industry_sql->execute();
    $industries = $industry_sql->fetchAll(PDO::FETCH_ASSOC);

    // Achievement Highlights (Sample data based on actual achievements)
    $achievements_sql = $connect->prepare("
        SELECT COUNT(*) as total_entrepreneurs 
        FROM info_alumni 
        WHERE status_alumni = 3
    ");
    $achievements_sql->execute();
    $entrepreneur_count = $achievements_sql->fetch(PDO::FETCH_ASSOC)['total_entrepreneurs'];

    $achievements = [
        ['icon' => 'trophy', 'color' => 'green', 'title' => 'Usahawan Berjaya', 'description' => $entrepreneur_count . ' alumni menjadi usahawan'],
        ['icon' => 'graduation-cap', 'color' => 'blue', 'title' => 'Lanjutan Pengajian', 'description' => $studying_count . ' alumni melanjutkan pengajian'],
        ['icon' => 'briefcase', 'color' => 'purple', 'title' => 'Bekerja', 'description' => $working_count . ' alumni sedang bekerja']
    ];

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    // Set default values in case of error
    $total_alumni = 0;
    $employment_rate = 0;
    $avg_salary = 0;
    $studying_rate = 0;
    $working_percent = $studying_percent = $entrepreneur_percent = $mixed_percent = 0;
    $salary_by_course = [];
    $popular_courses = [];
    $industries = [];
    $achievements = [];
}
?>
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
                            <h1 class="text-2xl font-bold text-gray-800">Statistik & Laporan</h1>
                            <p class="text-gray-600">Analisis pencapaian dan perkembangan alumni</p>
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
            <div class="p-6">
                <!-- Key Metrics -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-600 text-sm">Kadar Pekerjaan</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $employment_rate; ?>%</h3>
                                <p class="text-green-600 text-sm mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>Berdasarkan <?php echo $total_alumni; ?> alumni
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-briefcase text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-600 text-sm">Purata Gaji</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2">RM <?php echo number_format($avg_salary, 0); ?></h3>
                                <p class="text-green-600 text-sm mt-1">
                                    <i class="fas fa-chart-line mr-1"></i>Alumni bekerja & Usahawan
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-purple-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-600 text-sm">Alumni Lanjutan Pengajian</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $studying_rate; ?>%</h3>
                                <p class="text-blue-600 text-sm mt-1">Peringkat Pendidikan Tinggi</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-orange-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-600 text-sm">Total Alumni</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $total_alumni; ?></h3>
                                <p class="text-green-600 text-sm mt-1">Aktif dalam sistem</p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-orange-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Status Alumni Chart -->
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Alumni Semasa</h3>
                        <div class="h-80">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>

                    <!-- Gaji Mengikut Program -->
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Purata Gaji Mengikut Program</h3>
                        <div class="h-80">
                            <canvas id="salaryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Detailed Statistics -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Top Programs -->
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Program Terpopular</h3>
                        <div class="space-y-4">
                            <?php if (!empty($popular_courses)): ?>
                                <?php foreach ($popular_courses as $course): ?>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="font-medium text-gray-800"><?php echo htmlspecialchars($course['nama_program']); ?></span>
                                            <span class="text-gray-600"><?php echo $course['student_count']; ?> alumni</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: <?php echo $course['percentage']; ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-500 text-center">Tiada data program</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Employment by Industry -->
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Industri Pekerjaan</h3>
                        <div class="space-y-3">
                            <?php if (!empty($industries)): ?>
                                <?php
                                $industry_colors = [
                                    'Teknologi' => 'bg-blue-500',
                                    'Kewangan' => 'bg-green-500',
                                    'Pembuatan' => 'bg-purple-500',
                                    'Pendidikan' => 'bg-orange-500',
                                    'Kesihatan' => 'bg-red-500',
                                    'Kejuruteraan' => 'bg-indigo-500',
                                    'Lain-lain' => 'bg-gray-500'
                                ];
                                
                                $total_industry = 0;
                                foreach ($industries as $industry) {
                                    $total_industry += $industry['count'];
                                }
                                ?>
                                <?php foreach ($industries as $industry): ?>
                                <?php 
                                $percentage = $total_industry > 0 ? round(($industry['count'] / $total_industry) * 100, 1) : 0;
                                $color = $industry_colors[$industry['industry']] ?? 'bg-gray-500';
                                ?>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-3 h-3 <?php echo $color; ?> rounded-full"></div>
                                        <span class="text-sm text-gray-800"><?php echo htmlspecialchars($industry['industry']); ?></span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-medium text-gray-800"><?php echo $industry['count']; ?></span>
                                        <span class="text-xs text-gray-600 ml-1">(<?php echo $percentage; ?>%)</span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-500 text-center">Tiada data industri</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Achievement Highlights -->
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pencapaian Utama</h3>
                        <div class="space-y-4">
                            <?php foreach ($achievements as $achievement): ?>
                            <div class="flex items-start space-x-3 p-3 bg-<?php echo $achievement['color']; ?>-50 rounded-lg">
                                <i class="fas fa-<?php echo $achievement['icon']; ?> text-<?php echo $achievement['color']; ?>-600 mt-1"></i>
                                <div>
                                    <p class="font-medium text-<?php echo $achievement['color']; ?>-800"><?php echo $achievement['title']; ?></p>
                                    <p class="text-sm text-<?php echo $achievement['color']; ?>-600"><?php echo $achievement['description']; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Status Alumni Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Bekerja', 'Belajar', 'Usahawan'],
                datasets: [{
                    data: [
                        <?php echo $working_percent; ?>,
                        <?php echo $studying_percent; ?>,
                        <?php echo $entrepreneur_percent; ?>
                    ],
                    backgroundColor: [
                        '#10B981', // Green for Working
                        '#3B82F6', // Blue for Studying  
                        '#8B5CF6'  // Purple for Entrepreneur
                    ],
                    borderWidth: 2,
                    borderColor: '#FFFFFF'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });

        // Salary by Program Chart
        const salaryCtx = document.getElementById('salaryChart').getContext('2d');
        const salaryChart = new Chart(salaryCtx, {
            type: 'bar',
            data: {
                labels: [
                    <?php 
                    if (!empty($salary_by_course)) {
                        $labels = [];
                        foreach ($salary_by_course as $course) {
                            $labels[] = "'" . addslashes($course['nama_program']) . "'";
                        }
                        echo implode(', ', $labels);
                    } else {
                        echo "'Tiada Data'";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Purata Gaji (RM)',
                    data: [
                        <?php 
                        if (!empty($salary_by_course)) {
                            $salaries = [];
                            foreach ($salary_by_course as $course) {
                                $salaries[] = $course['avg_salary'] ? round($course['avg_salary'], 0) : 0;
                            }
                            echo implode(', ', $salaries);
                        } else {
                            echo '0';
                        }
                        ?>
                    ],
                    backgroundColor: '#3B82F6',
                    borderColor: '#2563EB',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'RM ' + value.toLocaleString();
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Purata Gaji: RM ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Add some animation to charts when they load
        document.addEventListener('DOMContentLoaded', function() {
            const charts = [statusChart, salaryChart];
            charts.forEach(chart => {
                chart.options.animation = {
                    duration: 1000,
                    easing: 'easeOutQuart'
                };
                chart.update();
            });
        });
    </script>
    <?php $location_index = ".."; include("../components/footer.php")?>
</body>
</html>