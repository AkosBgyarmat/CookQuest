<?php include "../head.php"; ?>

<!-- MAIN -->
<main class="bg-[#95A792] min-h-screen flex flex-col text-[#403F48] flex-1 flex justify-center align-center min-h-[calc(100vh-4rem)] px-4">

  <!-- KÁRTYA KÖZÉPEN -->
  <div class="flex-1 flex items-center justify-center">

    <div x-data="authPage()" class="w-full max-w-md bg-[#E3D9CA] p-3 sm:p-5 lg:p-6 rounded-2xl shadow-xl max-h-[85vh] flex flex-col">

      <!-- FEJLÉC -->
      <div class="mb-4">
        <h1 class="text-2xl font-bold text-center text-[#596C68]"
          x-text="isLogin ? 'Bejelentkezés' : 'Regisztráció'"></h1>
        <p class="text-center text-sm text-[#403F48] mt-1">
          <span x-text="isLogin ? 'Lépj be a fiókodba' : 'Hozd létre a saját fiókodat'"></span>
        </p>
      </div>

      <!-- FORM -->
      <form @submit.prevent="handleSubmit"
        class="space-y-3 overflow-auto pr-1">

        <!-- VEZETÉKNÉV + KERESZTNÉV -->
        <div x-show="!isLogin" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <input type="text" placeholder="Vezetéknév" x-model="vezeteknev" class="input-style">
          <input type="text" placeholder="Keresztnév" x-model="keresztnev" class="input-style">
        </div>

        <!-- FELHASZNÁLÓNÉV -->
        <input x-show="!isLogin" type="text"
          placeholder="Felhasználónév"
          x-model="felhasznalonev"
          class="input-style">

        <!-- EMAIL -->
        <input type="email"
          placeholder="Email cím"
          x-model="email"
          class="input-style">

        <!-- JELSZÓ -->
        <input type="password"
          placeholder="Jelszó"
          x-model="password"
          class="input-style">

        <!-- JELSZÓ MÉGEGYSZER -->
        <input x-show="!isLogin" type="password"
          placeholder="Jelszó megerősítése"
          x-model="confirmPassword"
          class="input-style">

        <!-- SZÜLETÉSI ÉV -->
        <input x-show="!isLogin" type="number"
          min="1900" max="2025"
          placeholder="Születési év"
          x-model="szuletesiEv"
          class="input-style">

        <!-- ORSZÁG -->
        <select x-show="!isLogin"
          x-model="orszagId"
          class="input-style">
          <option value="">Válassz országot</option>
          <option value="1">Magyarország</option>
          <option value="2">Szlovákia</option>
          <option value="3">Ausztria</option>
        </select>

        <!-- GOMB -->
        <button type="submit"
          class="w-full bg-[#596C68] text-white py-2 rounded-lg
                         font-semibold hover:bg-[#403F48] transition">
          <span x-text="isLogin ? 'Bejelentkezés' : 'Regisztráció'"></span>
        </button>
      </form>

      <!-- VÁLTÁS -->
      <p class="mt-4 text-center text-sm text-[#403F48]">
        <span x-text="isLogin ? 'Még nincs fiókod?' : 'Már van fiókod?'"></span>
        <button class="ml-1 text-[#596C68] font-semibold hover:text-[#403F48] transition"
          @click="isLogin = !isLogin">
          <span x-text="isLogin ? 'Regisztrálj!' : 'Jelentkezz be!'"></span>
        </button>
      </p>

    </div>
  </div>

</main>

<!-- FOOTER -->
<?php include("../footer.php"); ?>