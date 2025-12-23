<!-- Login Modal -->
<div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 relative transform transition-transform duration-300 scale-95">
        <button id="closeLogin" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition duration-200">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-blue-700">Welcome Back</h2>
            <p class="text-gray-600">Sign in to your account</p>
        </div>
        
        <form id="loginForm" method="post" action="../backend/alumni.php" class="space-y-4">
            <input type="hidden" name="token" value="<?php echo $token?>">
            <center>
                <div class="w-full">
                    <div class="w-full ">
                        <a href="<?php echo $google_login_url?>">
                            <button type="button" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 me-2 mb-2">
                                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                                <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                                </svg>
                                Log Masuk Google
                            </button>
                        </a>
                    </div>
                </div>

            </center>
            <hr>
            <div>
                <label for="loginEmail" class="block text-gray-700 mb-1 font-medium">Email Address</label>
                <input type="email" id="loginEmail" name="email_alumni" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" placeholder="you@example.com" required>
            </div>
            
            <div>
                <label for="loginPassword" class="block text-gray-700 mb-1 font-medium">Password</label>
                <input type="password" id="loginPassword" name="password_alumni" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" placeholder="••••••••" required>
            </div>
            
            
            <button type="submit" name="login_alumni" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition duration-300 transform hover:scale-105">
                Sign In
            </button>
            
            <div class="text-center mt-4">
                <p class="text-gray-600">Don't have an account? 
                    <button type="button" id="switchToSignup" class="text-blue-600 hover:text-blue-800 font-medium transition duration-200">Sign up</button>
                </p>
            </div>
        </form>
    </div>
</div>