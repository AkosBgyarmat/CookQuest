<div ng-show="isModalOpen"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4">

    <div class="bg-white w-full max-w-5xl rounded-2xl shadow-xl overflow-y-auto max-h-[90vh]">

        <!-- HEADER -->
        <div class="flex justify-between items-center border-b p-5">
            <div>
                <h2 class="text-2xl font-bold">Eszköz szerkesztése</h2>
                <p class="text-sm text-gray-500">
                    ID: {{selectedEszkoz.id || selectedEszkoz.nextId}}
                </p>
            </div>

            <button ng-click="closeModal()" class="text-gray-500 hover:text-black text-xl">
                ✕
            </button>
        </div>

        <!-- BODY -->
        <div class="p-6 space-y-6">

            <div class="grid md:grid-cols-2 gap-6">

                <!-- BAL OLDAL -->
                <div class="space-y-4">

                    <div>
                        <label class="text-sm font-semibold">Név</label>
                        <input type="text"
                            ng-model="selectedEszkoz.Nev"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Besorolás</label>
                        <select class="w-full border rounded-lg p-2 mt-1" ng-model="selectedEszkoz.BesorolasID">
                            <option ng-repeat="b in besorolas"
                                ng-value="b.BesorolasID">
                                {{b.Elnevezes}}
                            </option>
                        </select>
                    </div>

                </div>

                <!-- JOBB OLDAL -->
                <div class="space-y-4">

                    <div>
                        <label class="text-sm font-semibold">Kép URL</label>
                        <input type="text"
                            ng-model="selectedEszkoz.Kep"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <img ng-src="/CookQuest/assets/kepek/konyhaiEszkoz/{{selectedEszkoz.Kep}}"
                            class="w-full h-36 object-cover rounded-lg border">
                    </div>

                </div>

            </div>


            <!-- LEÍRÁS -->
            <div>
                <label class="text-sm font-semibold">Leírás</label>
                <textarea ng-model="selectedEszkoz.Leiras"
                    class="w-full border rounded-lg p-2 mt-1 h-28"></textarea>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="flex justify-end gap-3 border-t p-5">

            <button ng-click="closeModal()"
                class="bg-gray-400 text-white px-5 py-2 rounded-lg">
                Mégse
            </button>

            <button ng-click="saveEszkoz()"
                class="bg-[#5A7863] text-white px-5 py-2 rounded-lg">
                Mentés
            </button>

        </div>

    </div>
</div>