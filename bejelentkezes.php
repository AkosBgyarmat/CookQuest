<?php include "head.php"; ?>

<div class="bg-bg h-screen flex items-center justify-center text-dark">


  <div
    x-data="authPage()"
    class="w-full max-w-md bg-secondary p-8 rounded-2xl shadow-xl">

    <!-- CÍM -->
    <h1 class="text-2xl font-bold text-center mb-2 text-primary"
      x-text="isLogin ? 'Bejelentkezés' : 'Regisztráció'">
    </h1>

    <p class="text-center text-sm mb-6 text-dark">
      <span x-text="isLogin ? 'Lépj be a fiókodba' : 'Hozd létre a saját fiókodat'"></span>
    </p>

    <!-- ŰRLAP -->
    <form @submit.prevent="handleSubmit" class="space-y-4">

      <!-- VEZETÉKNÉV + KERESZTNÉV -->
      <div x-show="!isLogin" class="grid grid-cols-2 gap-4">
        <input type="text" placeholder="Vezetéknév" x-model="vezeteknev" class="input-style">
        <input type="text" placeholder="Keresztnév" x-model="keresztnev" class="input-style">
      </div>

      <!-- FELHASZNÁLÓNÉV -->
      <input x-show="!isLogin" type="text" placeholder="Felhasználónév"
        x-model="felhasznalonev" class="input-style">

      <!-- EMAIL -->
      <input type="email" placeholder="Email cím"
        x-model="email" class="input-style">

      <!-- JELSZÓ -->
      <input type="password" placeholder="Jelszó"
        x-model="password" class="input-style">

      <!-- JELSZÓ MÉGEGYSZER -->
      <input x-show="!isLogin" type="password"
        placeholder="Jelszó megerősítése"
        x-model="confirmPassword" class="input-style">

      <!-- SZÜLETÉSI ÉV -->
      <input x-show="!isLogin" type="number"
        min="1900" max="2025"
        placeholder="Születési év"
        x-model="szuletesiEv" class="input-style">

      <!-- ORSZÁG -->
      <select x-show="!isLogin" x-model="orszagId" class="input-style">
        <option value="">Válassz országot</option>
        <option value="1">Magyarország</option> <!--Javítás: Az ország táblához fog csatlakozni onnan töltődik be az adat, egyenlőre  -->
        <option value="2">Szlovákia</option>
        <option value="3">Ausztria</option>
      </select>

      <!-- GOMB -->
      <button type="submit"
        class="w-full bg-primary text-white py-2 rounded-lg
                   font-semibold hover:bg-dark transition">
        <span x-text="isLogin ? 'Bejelentkezés' : 'Regisztráció'"></span>
      </button>
    </form>

    <!-- VÁLTÁS -->
    <p class="mt-6 text-center text-sm text-dark">
      <span x-text="isLogin ? 'Még nincs fiókod?' : 'Már van fiókod?'"></span>
      <button class="ml-1 text-primary font-semibold hover:text-dark transition"
        @click="isLogin = !isLogin">
        <span x-text="isLogin ? 'Regisztrálj!' : 'Jelentkezz be!'"></span>
      </button>
    </p>

  </div>
</div>

<script>
  function authPage() {
    return {
      isLogin: true,
      vezeteknev: '',
      keresztnev: '',
      felhasznalonev: '',
      email: '',
      password: '',
      confirmPassword: '',
      szuletesiEv: '',
      orszagId: '',

      handleSubmit() {
        alert(this.isLogin ?
          'Frontend: bejelentkezés elküldve' :
          'Frontend: regisztráció elküldve');
      }
    }
  }
</script>

<!-- Egyedi színpaletta -->
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          bg: '#95A792',
          primary: '#596C68',
          secondary: '#E3D9CA',
          dark: '#403F48'
        }
      }
    }
  }
</script>

<<<<<<< HEAD

<?php include("footer.php") ?>?>
=======
<script>
  document.documentElement.style.overflow = 'hidden';
  document.body.style.overflow = 'hidden';
</script>
>>>>>>> e26f69ac33b32a2a710a443992709df0bb4b1f96
