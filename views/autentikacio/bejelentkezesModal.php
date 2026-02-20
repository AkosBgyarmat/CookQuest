<!-- LOGIN VISSZAJELZŐ MODAL -->
<div ng-if="loginMessage"
     class="fixed inset-0 z-50 flex items-center justify-center">

  <!-- háttér -->
  <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
       ng-click="closeLoginMessage()">
  </div>

  <div class="relative bg-white rounded-3xl shadow-2xl p-10 max-w-lg w-full mx-4 text-center z-10">

    <!-- X -->
    <button ng-click="closeLoginMessage()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">
      &times;
    </button>

    <!-- IKON -->
    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6"
         ng-class="loginSuccess ? 'bg-green-100' : 'bg-red-100'">

      <svg ng-if="loginSuccess"
           class="h-12 w-12 text-green-600"
           xmlns="http://www.w3.org/2000/svg"
           fill="none"
           viewBox="0 0 24 24"
           stroke-width="1.5"
           stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
      </svg>

      <svg ng-if="!loginSuccess"
           class="h-12 w-12 text-red-600"
           xmlns="http://www.w3.org/2000/svg"
           fill="none"
           viewBox="0 0 24 24"
           stroke-width="1.5"
           stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 9v3.75m0 3.75h.007v.008H12v-.008zm9-3.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
      </svg>

    </div>

    <h2 class="text-2xl font-bold mb-4"
        ng-class="loginSuccess ? 'text-green-700' : 'text-red-700'">

      {{ loginSuccess ? 'Sikeres bejelentkezés!' : 'Sikertelen bejelentkezés!' }}

    </h2>

    <p class="text-gray-600">

      {{ loginSuccess 
          ? 'Átirányítás folyamatban...' 
          : 'Hibás email vagy jelszó.' }}

    </p>

  </div>
</div>