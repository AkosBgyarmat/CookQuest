<!-- REGISZTRÁCIÓ SIKER MODAL -->
<div ng-if="registerMessage"
    class="fixed inset-0 z-50 flex items-center justify-center">

    <!-- Sötétített / blur háttér -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        ng-click="closeRegisterMessage()">
    </div>

    <!-- Modal doboz -->
    <div class="relative bg-white rounded-3xl shadow-2xl p-10 max-w-lg w-full mx-4 text-center z-10">

        <!-- Bezáró X -->
        <button ng-click="closeRegisterMessage()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">
            &times;
        </button>

        <!-- Ikon -->
        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full">
            <svg class="h-12 w-12 text-green-600"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-green-700 mb-4">
            Sikeres regisztráció!
        </h1>

        <p class="text-gray-600 mb-8">
            {{ registerSuccess ? 
            'A fiókodat sikeresen létrehoztuk.' 
            : registerErrorText }}
        </p>


        <button ng-click="goToLogin()"
            class="px-6 py-3 bg-[#5A7863] text-white rounded-xl hover:bg-[#759277] transition">
            Jelentkezzen be
        </button>

    </div>
</div>