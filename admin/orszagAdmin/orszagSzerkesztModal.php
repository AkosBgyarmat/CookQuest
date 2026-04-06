<div ng-if="isModalOpen"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

    <div class="bg-white p-6 rounded-xl shadow-xl w-[400px]">

        <h2 class="text-lg font-bold mb-4">
          {{ selectedOrszag.Id ? 'Ország szerkesztése' : 'Új ország hozzáadása' }}
        </h2>

        <input ng-model="selectedOrszag.Nev"
               class="w-full border p-2 rounded mb-4"
               placeholder="Név">

        <div class="flex justify-end gap-2">
            <button ng-click="closeModal()"
                    class="px-4 py-2 bg-gray-300 rounded">
                Mégse
            </button>

            <button ng-click="saveOrszag()"
                    class="px-4 py-2 bg-[#5A7863] text-white rounded">
                {{ selectedOrszag.Id ? 'Mentés' : 'Létrehozás' }}
            </button>
        </div>

    </div>
</div>