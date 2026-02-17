<?php include "../head.php"; ?>

<main class="bg-[#95A792] min-h-screen flex flex-col text-[#403F48] flex-1 flex justify-center align-center min-h-[calc(100vh-4rem)] px-4" ng-controller="authController" ng-cloak>

  <!-- Regisztráció kártya -->
  <section ng-show="mode === 'regisztracio'">

    <div class="flex-1 flex items-center justify-center">

      <div class="w-full max-w-md bg-[#E3D9CA] p-3 sm:p-5 lg:p-6 rounded-2xl shadow-xl flex flex-col">

        <!-- FEJLÉC -->
        <div class="mb-4">
          <h1 class="text-2xl font-bold text-center text-[#596C68]">Regisztáció</h1>
          <p class="text-center text-sm text-[#403F48] mt-1">
            <span></span>
          </p>
        </div>

        <!-- FORM -->
        <form name="regForm" ng-submit="handleRegister(regForm)"
          class="space-y-3 overflow-auto pr-1">

          <!-- VEZETÉKNÉV + KERESZTNÉV -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <input type="text"
              name="surname"
              ng-model="user.surname"
              placeholder="Vezetéknév"
              class="input-style"
              required>

            <input type="text"
              name="firstName"
              ng-model="user.firstName"
              placeholder="Keresztnév"
              class="input-style"
              required>
          </div>

          <!-- Felhasználónév input -->
          <input type="text"
            name="username"
            ng-model="user.username"
            ng-minlength="3"
            placeholder="Felhasználónév"
            class="input-style"
            required>

          <!-- Felhasználónév hibák -->
          <div>

            <!-- Kitöltés -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="regForm.username.$error.required && regSubmitted">
              A felhasználónév megadása kötelező.
            </p>

            <!-- Minimumhossz -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="regSubmitted && !regForm.username.$error.required && regForm.username.$error.minlength || regForm.username.$error.minlength">
              A felhasználónév hossza legalább 3 karakter hosszúnak kell lennie.
            </p>

          </div>


          <!-- Email -->
          <input type="email"
            name="email"
            ng-model="user.email"
            placeholder="Email cím"
            class="input-style"
            required>

          <!-- Email hibák -->
          <div>

            <!-- Kitöltés -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="regForm.email.$error.required && regSubmitted">
              Az email cím megadása kötelező.
            </p>

            <!-- Minimumhossz -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="regForm.email.$error.email && regSubmitted">
              Nem megfelelő email formátum.
            </p>

            <!-- Foglalt email -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="regSubmitted && regForm.email.$valid && emailExistsError">
              Az email cím már használatban van.
            </p>

          </div>

          <!-- Jelszó -->
          <input type="password"
            name="password"
            ng-model="user.password"
            placeholder="Jelszó"
            class="input-style"
            required>

          <!-- Jelszó mégegyszer -->
          <input type="password"
            name="passwordAgain"
            ng-model="user.passwordAgain"
            placeholder="Jelszó megerősítése"
            class="input-style"
            required>

          <!-- Születési év -->
          <input type="number"
            name="birthDate"
            ng-model="user.birthDate"
            min="1900" max="2025"
            placeholder="Születési év"
            class="input-style"
            required>

          <!-- Ország -->
          <select class="input-style"
            name="country"
            ng-model="user.country"
            required>
            <option value="">Válassz országot</option>
            <option value="1">Magyarország</option>
            <option value="2">Szlovákia</option>
            <option value="3">Ausztria</option>
          </select>

          <!-- Regisztráció gomb -->
          <div class="flex justify-center align-center">
            <button
              type="submit"
              class="w-full bg-[#5A7863] text-[#ebf4dd] font-semibold hover:bg-[#759277] transition p-2 rounded-[0.5rem]">
              Regisztráció!
            </button>
          </div>


          <!-- Váltás -->
          <p class="mt-4 text-center text-sm text-[#403F48]">
            <span>Van már fiókja?</span>
            <button
              ng-click="showBejelentkezes()"
              type="button"
              class="ml-1 text-[#596C68] font-semibold hover:text-[#403F48] transition">
              <span>Jelentkezzen be!</span>
            </button>
          </p>

        </form>
      </div>
    </div>

  </section>

  <!-- Bejelentkezés kártya -->
  <section ng-show="mode === 'bejelentkezes'">

    <div class="flex-1 flex items-center justify-center">

      <div class="w-full max-w-md bg-[#E3D9CA] p-3 sm:p-5 lg:p-6 rounded-2xl shadow-xl max-h-[85vh] flex flex-col">

        <div class="mb-4">
          <h1 class="text-2xl font-bold text-center text-[#596C68]">Bejelentkezés</h1>
          <p class="text-center text-sm text-[#403F48] mt-1">
            <span>Üdvözlünk újra!</span>
          </p>
        </div>

        <!-- FORM -->
        <form name="loginForm" ng-submit="handleLogin(loginForm)"
          class="space-y-3 overflow-auto pr-1">

          <!-- Email input -->
          <input type="email"
            name="email"
            ng-model="user.email"
            placeholder="Email cím"
            class="input-style"
            required>

          <!-- Jelszó input -->
          <input type="password"
            name="password"
            ng-model="user.password"
            placeholder="Jelszó"
            class="input-style"
            required>

          <!-- Bejelentkezés gomb -->
          <div class="flex justify-center align-center">
            <button
              type="submit"
              class="w-full bg-[#5A7863] text-[#ebf4dd] font-semibold hover:bg-[#759277] transition p-2 rounded-[0.5rem]">
              Bejelentkezés!
            </button>
          </div>

        </form>

        <!-- Váltás -->
        <p class="mt-4 text-center text-sm text-[#403F48]">
          <span>Nincs még fiókja?</span>
          <button
            ng-click="showRegisztracio()"
            type="button"
            class="ml-1 text-[#596C68] font-semibold hover:text-[#403F48] transition">
            <span>Regisztráljon most!</span>
          </button>
        </p>

      </div>
    </div>
  </section>

</main>

<?php include("../footer.php"); ?>