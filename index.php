<?php $location_index = "."; include("./components/header.php")?>
<?php 
    include("./backend/functions/google-login.php");

    $google_login_url = generateGoogleUrl($clientId, $clientSecret, $redirectUri);

?>

<body class="bg-gray-100 font-sans">
    <?php $location_index = "."; include("./components/navbar.php")?>
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-orange-400 to-red-500 text-white py-20 bg-cover bg-center h-auto min-h-60">
        <div class="container mx-auto text-center">
            <h1 class="text-6xl font-bold drop-shadow-md">e-Sistem Jejak Alumni</h1>
            <p class="text-xl drop-shadow-md mt-3">Mengingati kejayaan anda yang bakal menjadi inspirasi kepada generasi seterusnya</p>
        </div>
        <br><br>
        <div class="space-x-4 text-center">
            <button id="loginBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 shadow-md">
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </button>
            <button id="signupBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 shadow-md">
                <i class="fas fa-user-plus mr-2"></i>Sign Up
            </button>
        </div>
        <?php $location_index = '.'; include("./components/login_modal.php"); ?>
        <?php include("./components/signup_modal.php"); ?>
        
        <script>
            // DOM Elements
            const loginBtn = document.getElementById('loginBtn');
            const signupBtn = document.getElementById('signupBtn');
            const loginModal = document.getElementById('loginModal');
            const signupModal = document.getElementById('signupModal');
            const closeLogin = document.getElementById('closeLogin');
            const closeSignup = document.getElementById('closeSignup');
            const switchToSignup = document.getElementById('switchToSignup');
            const switchToLogin = document.getElementById('switchToLogin');
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');

            // Show Login Modal
            loginBtn.addEventListener('click', () => {
                signupModal.classList.add('hidden');
                loginModal.classList.remove('hidden');
            });

            // Show Signup Modal
            signupBtn.addEventListener('click', () => {
                loginModal.classList.add('hidden');
                signupModal.classList.remove('hidden');
            });

            // Close Modals
            closeLogin.addEventListener('click', () => {
                loginModal.classList.add('hidden');
            });

            closeSignup.addEventListener('click', () => {
                signupModal.classList.add('hidden');
            });

            // Switch between modals
            switchToSignup.addEventListener('click', () => {
                loginModal.classList.add('hidden');
                signupModal.classList.remove('hidden');
            });

            switchToLogin.addEventListener('click', () => {
                signupModal.classList.add('hidden');
                loginModal.classList.remove('hidden');
            });

            // Close modals when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target === loginModal) {
                    loginModal.classList.add('hidden');
                }
                if (e.target === signupModal) {
                    signupModal.classList.add('hidden');
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    loginModal.classList.add('hidden');
                    signupModal.classList.add('hidden');
                }
            });

            // Form submission (prevent default for demo)
            loginForm.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Login form submitted! (This is a demo)');
                loginModal.classList.add('hidden');
            });

            signupForm.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Signup form submitted! (This is a demo)');
                signupModal.classList.add('hidden');
            });
        </script>

    </section>

    <!-- Alumni Achievements Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Kemenjadian Pelajar Kolej Vokasional Kuala Selangor</h2>
            <?php 
                $alumni_sql = $connect->prepare("SELECT COUNT(*) as total FROM alumni WHERE NOT status_alumni = 0");
                $alumni_sql->execute();

                $alumni = $alumni_sql->fetch(PDO::FETCH_ASSOC);

            ?>
            <p class="text-center text-gray-600 mb-10">Jumlah Alumni Berdaftar: <span class="font-bold text-2xl text-blue-600"><?php echo $alumni['total']?></span></p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Sambung Belajar Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold mb-1">Sambung Belajar</h3>
                                <p class="text-blue-100 text-sm">Alumni yang meneruskan pengajian</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                <i class="fas fa-graduation-cap text-4xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-blue-50 to-white">
                        <div class="text-center">
                            <?php 
                                $belajar_alumni_sql = $connect->prepare("SELECT COUNT(*) as total FROM info_alumni WHERE status_alumni = 2");
                                $belajar_alumni_sql->execute();

                                $belajar_alumni = $belajar_alumni_sql->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <p class="text-5xl font-bold text-blue-600 mb-2"><?php echo $belajar_alumni['total'] ?></p>
                            <p class="text-gray-600">Orang Alumni</p>
                            <div class="mt-4 pt-4 border-t border-blue-200">
                                <p class="text-sm text-gray-500"><?php echo 7; ?>% daripada jumlah alumni</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bekerja Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold mb-1">Bekerja</h3>
                                <p class="text-green-100 text-sm">Alumni yang sedang bekerja</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                <i class="fas fa-briefcase text-4xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-green-50 to-white">
                        <div class="text-center">
                            <?php 
                                $kerja_alumni_sql = $connect->prepare("SELECT COUNT(*) as total FROM info_alumni WHERE status_alumni = 1");
                                $kerja_alumni_sql->execute();

                                $kerja_alumni = $kerja_alumni_sql->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <p class="text-5xl font-bold text-green-600 mb-2"><?php echo $kerja_alumni['total'] ?></p>
                            <p class="text-gray-600">Orang Alumni</p>
                            <div class="mt-4 pt-4 border-t border-green-200">
                                <p class="text-sm text-gray-500"><?php echo 6; ?>% daripada jumlah alumni</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Usahawan Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold mb-1">Usahawan</h3>
                                <p class="text-purple-100 text-sm">Alumni yang berniaga sendiri</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-full">
                                <i class="fas fa-store text-4xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-purple-50 to-white">
                        <div class="text-center">
                            <?php 
                                $usahawan_alumni_sql = $connect->prepare("SELECT COUNT(*) as total FROM info_alumni WHERE status_alumni = 3");
                                $usahawan_alumni_sql->execute();

                                $usahawan_alumni = $usahawan_alumni_sql->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <p class="text-5xl font-bold text-purple-600 mb-2"><?php echo $usahawan_alumni['total']?></p>
                            <p class="text-gray-600">Orang Alumni</p>
                            <div class="mt-4 pt-4 border-t border-purple-200">
                                <p class="text-sm text-gray-500"><?php echo 7; ?>% daripada jumlah alumni</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Statistics
            <div class="mt-12 max-w-5xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Ringkasan Statistik Alumni</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="text-center p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg">
                            <i class="fas fa-users text-3xl text-orange-600 mb-2"></i>
                            <p class="text-2xl font-bold text-orange-600">150</p>
                            <p class="text-sm text-gray-600">Jumlah Alumni</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg">
                            <i class="fas fa-graduation-cap text-3xl text-blue-600 mb-2"></i>
                            <p class="text-2xl font-bold text-blue-600">45</p>
                            <p class="text-sm text-gray-600">Sambung Belajar</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-lg">
                            <i class="fas fa-briefcase text-3xl text-green-600 mb-2"></i>
                            <p class="text-2xl font-bold text-green-600">82</p>
                            <p class="text-sm text-gray-600">Bekerja</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg">
                            <i class="fas fa-store text-3xl text-purple-600 mb-2"></i>
                            <p class="text-2xl font-bold text-purple-600">23</p>
                            <p class="text-sm text-gray-600">Usahawan</p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>

    
    <?php $location_index = "."; include("./components/footer.php")?>

</body>
</html>