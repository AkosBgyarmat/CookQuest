<!-- KILÉPÉS MODAL -->
<div ng-if="showLogoutModal"
     class="fixed inset-0 z-50 flex items-center justify-center">

    <!-- háttér -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         ng-click="closeLogoutModal()">
    </div>

    <!-- doboz -->
    <div class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full mx-4 text-center z-10">

        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            Biztosan ki szeretnél lépni?
        </h2>

        <div class="flex justify-center gap-4 mt-6">

            <button ng-click="closeLogoutModal()"
                class="px-6 py-2 bg-gray-300 rounded-xl hover:bg-gray-400 transition">
                Mégsem
            </button>

            <button ng-click="confirmLogout()"
                class="px-6 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                Kilépés
            </button>

        </div>
    </div>
</div>