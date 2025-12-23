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
        <a href="./manage_admin.php" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
            Admin
        </a>
    </nav>
</div>

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