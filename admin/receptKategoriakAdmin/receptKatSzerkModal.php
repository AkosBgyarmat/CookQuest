<div ng-if="isModalOpen"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white p-6 rounded-xl shadow-xl w-[400px]">

        <h2 class="text-lg font-bold mb-4">
          {{ selectedReceptKategoria.id ? 'Recept kategória szerkesztése' : 'Új recept kategória hozzáadása' }}
        </h2>

        <input ng-model="selectedReceptKategoria.Kategoria"
               class="w-full border p-2 rounded mb-4"
               placeholder="Név">

        <div class="flex justify-end gap-2">
            <button ng-click="closeFeedbackMessage()"
                    class="px-4 py-2 bg-gray-300 rounded">
                Mégse
            </button>

            <button ng-click="saveReceptKategoria()"
                    class="px-4 py-2 bg-[#5A7863] text-white rounded">
                {{ selectedReceptKategoria.id ? 'Mentés' : 'Létrehozás' }}
            </button>
        </div>

    </div>
</div>