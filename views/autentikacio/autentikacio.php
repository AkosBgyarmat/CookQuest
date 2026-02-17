<?php include "../head.php"; ?>

<main class="bg-[#95A792] min-h-screen flex flex-col text-[#403F48] flex-1 flex justify-center align-center min-h-[calc(100vh-4rem)] px-4" ng-controller="authController" ng-cloak>

  <!-- Regisztráció kártya -->
  <section ng-show="mode === 'regisztracio'" ng-controller="orszagCtrl">

    <div class="flex-1 flex items-center justify-center">

      <div class="w-full max-w-md bg-[#E3D9CA] p-3 sm:p-5 lg:p-6 rounded-2xl shadow-xl flex flex-col">

        <!-- Regisztráció -->
        <div class="mb-4">
          <h1 class="text-2xl font-bold text-center text-[#596C68]">Regisztáció</h1>
          <p class="text-center text-sm text-[#403F48] mt-1">
            <span>Regisztrálj a CookQuest platformon!</span>
          </p>
        </div>

        <!-- Regisztrációs űrlap -->
        <form name="regForm" ng-submit="handleRegister(regForm)" class="space-y-3 overflow-auto pr-1">

          <!-- #region NÉV  szakasz -->
            <!--Név-->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

              <!-- Vezetéknév input -->
              <input type="text"
                name="surname"
                ng-model="user.surname"
                placeholder="Vezetéknév"
                class="input-style"
                required>

              <!-- Keresztnév input-->
              <input type="text"
                name="firstName"
                ng-model="user.firstName"
                placeholder="Keresztnév"
                class="input-style"
                required>

            </div>
          <!-- #endregion -->
          
          <!-- #region FELHASZNÁLÓNÉV  szakasz -->

          <!-- Felhasználónév input -->
          <input type="text"
            name="username"
            ng-model="user.username"
            ng-minlength="3"
            placeholder="Felhasználónév"
            class="input-style"
            required>

          <!-- Felhasználónév hibák -->
          <!-- Kitöltés -->
          <p
            class="text-red-500 text-sm mt-1"
            ng-if="regForm.username.$error.required && regSubmitted">
            A felhasználónév megadása kötelező.
          </p>

          <!-- Minimumhossz -->
          <p
            class="text-red-500 text-sm mt-1"
            ng-if="regSubmitted && !regForm.username.$error.required && regForm.username.$error.minlength">
            A felhasználónév hossza legalább 3 karakter hosszúnak kell lennie.
          </p>
          <!-- #endregion -->

          <!-- #region EMAIL  szakasz -->

          <!-- Email input -->
          <input type="email"
            name="email"
            ng-model="user.email"
            placeholder="Email cím"
            class="input-style"
            required>

          <!-- Email hibák -->

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

          <!-- #endregion --> 

          <!-- #region JELSZÓ  szakasz -->
          <!-- Jelszó -->
          <input type="password"
            name="password"
            ng-model="user.password"
            password-strength
            placeholder="Jelszó"
            class="input-style"
            required>

          <ul class="text-sm flex align-center justify-around text-center">

            <li ng-class="{
              'text-gray-400': !passwordChecks.minLength,
              'text-emerald-500': passwordChecks.minLength}">
              Legalább 8 karakter
            </li>

            <li ng-class="{
              'text-gray-400': !passwordChecks.hasNumber,
              'text-emerald-500': passwordChecks.hasNumber}">
              Tartalmazzon számot
            </li>

            <li ng-class="{
              'text-gray-400': !passwordChecks.hasUppercase,
              'text-emerald-500': passwordChecks.hasUppercase}">
              Tartalmazzon nagybetűt
            </li>

          </ul>


          <p class="text-red-500 text-sm mt-1"
            ng-if="regForm.password.$touched && regForm.password.$error.required">
            A jelszó megadása kötelező.
          </p>

          <!-- Jelszó mégegyszer -->
          <input type="password"
            name="passwordAgain"
            ng-model="user.passwordAgain"
            password-match="user.password"
            placeholder="Jelszó megerősítése"
            class="input-style"
            required>

          <p class="text-red-500 text-sm mt-1"
            ng-if="regForm.passwordAgain.$touched && regForm.passwordAgain.$error.passwordMismatch">
            A jelszavak nem egyeznek.
          </p>

          <!-- #endregion -->

          <!-- #region SZÜLETÉSI ÉV  szakasz -->
          <!-- Születési év -->
          <input type="number"
            name="birthDate"
            ng-model="user.birthDate"
            min="1900" max="{{currentYear}}"
            placeholder="Születési év"
            class="input-style"
            required>

          <p class="text-red-500 text-sm mt-1"
            ng-if="regForm.birthDate.$touched && regForm.birthDate.$error.required">
            A születési év megadása kötelező.
          </p>

          <p class="text-red-500 text-sm mt-1"
            ng-if="regForm.birthDate.$touched && regForm.birthDate.$error.min">
            A születési év nem lehet korábbi, mint 1900.
          </p>

          <p class="text-red-500 text-sm mt-1"
            ng-if="regForm.birthDate.$touched && regForm.birthDate.$error.max">
            A születési év nem lehet későbbi, mint {{currentYear}}.
          </p>

          <!-- #endregion -->

          <!-- #region ORSZÁG  szakasz -->
            <!-- Ország -->
            <select class="input-style"
              name="country"
              ng-model="user.country"
              required>
              <option value="">Válassz országot</option>
              <option ng-repeat="o in orszagok" value="{{o.Id}}">{{o.Elnevezes}}</option>
            </select>
          <!-- #endregion -->

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

        <!-- Bejelentkezés űrlap -->
        <form name="loginForm" ng-submit="handleLogin(loginForm)"
          class="space-y-3 overflow-auto pr-1">

          <!-- #region EMAIL  szakasz -->
            <!-- Email -->
            <input type="email"
              name="email"
              ng-model="user.email"
              placeholder="Email cím"
              class="input-style"
              required>

            <!-- Email hibák -->

            <!-- Kitöltés -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="loginForm.email.$error.required && loginSubmitted">
              Az email cím megadása kötelező.
            </p>

            <!-- Minimumhossz -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="loginForm.email.$error.email && loginSubmitted">
              Nem megfelelő email formátum.
            </p>

            <!-- Foglalt email -->
            <p
              class="text-red-500 text-sm mt-1"
              ng-if="loginSubmitted && loginForm.email.$valid && invalidCredentialsError">
              Az email cím vagy jelszó nem megfelelő.
            </p>
          <!-- #endregion -->

          <!-- #region JELSZÓ  szakasz -->

          <!-- Jelszó -->
          <input type="password"
            name="password"
            ng-model="user.password"
            placeholder="Jelszó"
            class="input-style"
          required>
          
          <!-- #endregion -->

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