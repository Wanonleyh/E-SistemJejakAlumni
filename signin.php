<?php $location_index = "."; include("./components/header.php")?>

<body class="bg-gray-100">
    <?php $location_index = "."; include("./components/navbar.php")?>
    
    <!-- Login Section -->
    <section class="flex items-center justify-center min-h-screen p-4">
        <!-- Login Form Section -->
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-center text-xl md:text-2xl font-bold text-green-600 mb-4">
                Log Masuk Admin
            </h2>
            
            <div class="flex justify-center mb-6">
                <div class="relative inline-flex items-center justify-center w-20 h-20 md:w-24 md:h-24 overflow-hidden bg-green-100 rounded-full">
                    <svg class="absolute w-16 h-16 md:w-20 md:h-20 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            
            <form method="post" action="./backend/admin.php" class="space-y-4">
                <input type="hidden" name="token" value="<?php echo $token?>">
                
                <div>
                    <label for="nama_admin" class="block text-sm font-semibold text-gray-700 mb-1">Nama Admin</label>
                    <input 
                        type="text" 
                        id="nama_admin" 
                        name="nama_admin" 
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan nama admin"
                        required
                    >
                </div>
                
                <div>
                    <label for="password_admin" class="block text-sm font-semibold text-gray-700 mb-1">Kata Laluan</label>
                    <input 
                        type="password" 
                        id="password_admin" 
                        name="password_admin" 
                        class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan kata laluan"
                        required
                    >
                </div>

                <div class="text-center pt-4">
                    <button 
                        name="signin_admin" 
                        type="submit" 
                        class="w-full bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 font-medium transition duration-200"
                    >
                        Log Masuk
                    </button>
                </div>
            </form>
        </div>
    </section>
    
    <?php $location_index = "."; include("./components/footer.php")?>

</body>
</html>