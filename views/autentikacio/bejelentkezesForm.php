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

                <!-- Foglalt email 
                <p
                    class="text-red-500 text-sm mt-1"
                    ng-if="loginSubmitted && loginForm.email.$valid && invalidCredentialsError">
                    Az email cím vagy jelszó nem megfelelő.
                </p>-->
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