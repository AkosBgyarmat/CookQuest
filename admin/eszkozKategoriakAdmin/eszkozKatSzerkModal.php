<div ng-if="isModalOpen"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white p-6 rounded-xl shadow-xl w-[400px]">

        <h2 class="text-lg font-bold mb-4">
          {{ selectedEszkozKategoria.id ? 'Eszköz kategória szerkesztése' : 'Új eszköz kategória hozzáadása' }}
        </h2>

        <input ng-model="selectedEszkozKategoria.Elnevezes"
               class="w-full border p-2 rounded mb-4"
               placeholder="Név">

        <div class="flex justify-end gap-2">
            <button ng-click="closeFeedbackMessage()"
                    class="px-4 py-2 bg-gray-300 rounded">
                Mégse
            </button>

            <button ng-click="saveEszkozKategoria()"
                    class="px-4 py-2 bg-[#5A7863] text-white rounded">
                {{ selectedEszkozKategoria.id ? 'Mentés' : 'Létrehozás' }}
            </button>
        </div>

    </div>
</div>