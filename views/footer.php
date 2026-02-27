<!-- Footer -->
<footer class="bg-[#3B4953] text-white px-6 py-6 relative overflow-hidden">

  <!-- Decorative Elements -->
  <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
    <div class="w-80 h-80 rounded-full bg-[#EBF4DD] opacity-10 animate-blob3"></div>
    <div class="w-60 h-60 rounded-full bg-[#90AB8B] opacity-10 animate-blob4"></div>
  </div>

  
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative ">

    <!-- Logo & Description -->
    <div class="border-[black] hidden md:block">
      <h2 class="text-2xl  font-bold mb-4 text-white">CookQuest</h2>
      <p class="mb-4 max-w-[250px]">Tanulj meg főzni lépésről lépésre és ismerkedj meg a konyhai eszközökkel!</p>
    </div>

    <!-- Jogi információk -->
    <div>
      <h3 class="text-xl font-semibold mb-4">Jogi információk</h3>
      <ul class="space-y-2">
        <li>
          <a href="../jogiInformaciok/adatkezelesiTajekoztato.php" class="hover:text-purple-400 transition">Adatkezelési tájékoztató</a>
        </li>
        <li>
          <a href="../jogiInformaciok/aszf.php" class="hover:text-purple-400 transition">ÁSZF</a>
        </li>
        <li>
          <a href="../jogiInformaciok/cookieTajekoztato.php" class="hover:text-purple-400 transition">Süti tájékoztató</a>
        </li>
        <li>
          <a href="../jogiInformaciok/impresszum.php" class="hover:text-purple-400 transition">Impresszum</a>
        </li>
      </ul>
    </div>

    <!-- Kontact info -->
    <div>
      <h3 class="text-xl font-semibold mb-4">Lépj kapcsolatba velünk!</h3>

      <div class="flex items-center space-x-2 mb-2">
        <p>Székhely: </p>
        <p>Oktatási projekt</p>
      </div>

      <div class="flex items-center space-x-2 mb-2">
        <p>E-mail:</p>
        <a href="mailto:info@cookquest.com" class="hover:text-purple-400 transition">
          info@cookquest.com
        </a>
      </div>

      <div class="flex items-center space-x-2">
        <p>Telefon:</p>
        <a href="tel:+1234567890" class="hover:text-purple-400 transition">
          +123 456 7890
        </a>
      </div>
    </div>

  </div>

  <!-- Copyright -->
  <div class="mt-12 text-center text-gray-400 text-sm relative z-10">
    &copy; 2026 CookQuest. Minden jog fenntartva.
  </div>

  <button id="to-top-button" onclick="goToTop()" title="Go To Top"
    class="hidden fixed z-50 bottom-10 right-10 p-4 border-0 w-14 h-14 rounded-full shadow-md bg-[#5A7863] hover:bg-[#3B4953] text-white text-lg font-semibold transition-colors duration-300">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
      <path d="M12 4l8 8h-6v8h-4v-8H4l8-8z" />
    </svg>
  </button>

  <!-- Controller -->
  <script src="../../controller/eszkozController.js"></script>
  <script src="../../controller/orszagController.js"></script>
  <script src="../../controller/autentikacioController.js"></script>
  <script src="../../controller/profilController.js"></script>
  <script src="../../controller/galeriaController.js"></script>

  <!-- Javascript -->
  <script src="../../assets/js/hamburger.js"></script>
  <script src="../../assets/js/top.js"></script>
  <script src="../../assets/js/atvalto.js"></script>


</footer>

</body>

</html>