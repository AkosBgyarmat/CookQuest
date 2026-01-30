<!-- Footer -->
<footer class="bg-[#3B4953] text-white px-6 py-6 relative overflow-hidden">

  <!-- Decorative Elements -->
  <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
    <div class="w-80 h-80 rounded-full bg-[#EBF4DD] opacity-10 animate-blob3"></div>
    <div class="w-60 h-60 rounded-full bg-[#90AB8B] opacity-10 animate-blob4"></div>
  </div>

  <!-- Footer Content -->
  <div class="max-w-7xl mx-auto grid 
        lg:grid-cols-3  z-10
        md:grid-cols-4 gap-8 relative ">

    <!-- Logo & Description -->
    <div class="border-[black]">
      <h2 class="text-2xl  font-bold mb-4 text-white">CookQuest</h2>
      <p class="mb-4 max-w-[250px]">Tanulj meg főzni lépésről lépésre és ismerkedj meg a konyhai eszközökkel!</p>
    </div>

    <!-- Links -->
    <div>
      <h3 class="text-xl font-semibold mb-4">Oldalaink</h3>
      <ul class="space-y-2">
        <li>
          <a href="../index/index.php" class="hover:text-purple-400 transition">Főoldal</a>
        </li>
        <li>
          <a href="../receptek/receptek.php" class="hover:text-purple-400 transition">Receptek</a>
        </li>
        <li>
          <a href="../konyhaiEszkozok/konyhaiEszkozok.php" class="hover:text-purple-400 transition">Konyhai eszközök</a>
        </li>
        <li>
          <a href="../bejelentkezes/bejelentkezes.php" class="hover:text-purple-400 transition">Bejelentkezés</a>
        </li>
      </ul>
    </div>

    <!-- Contact Info -->
    <div>
      <h3 class="text-xl font-semibold mb-4">Lépj kapcsolatba velünk!</h3>
      <p class="mb-2">2660 Balassagyarmat, Rákóczi fejedelem út 50</p>
      <p class="mb-2">Email: info@cookquest.com</p>
      <p>Phone: +123 456 7890</p>
    </div>

  </div>

  <!-- Copyright -->
  <div class="mt-12 text-center text-gray-400 text-sm relative z-10">
    &copy; 2026 CookQuest. Minden jog fenntartva.
  </div>

  <button id="to-top-button" onclick="goToTop()" title="Go To Top"
    class="hidden fixed z-50 bottom-10 right-10 p-4 border-0 w-14 h-14 rounded-full shadow-md bg-[#5A7863] hover:bg-[#3B4953]-800 text-white text-lg font-semibold transition-colors duration-300">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
      <path d="M12 4l8 8h-6v8h-4v-8H4l8-8z" />
    </svg>
    <span class="sr-only">Go to top</span>
  </button>

  <!-- Javascript -->
  <script src="../../assets/js/hamburger.js"></script>
  <script src="../../assets/js/bejelentkezes.js"></script>
  <script src="../../assets/js/top.js"></script>

</footer>