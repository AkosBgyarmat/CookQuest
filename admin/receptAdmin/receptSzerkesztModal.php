<div ng-show="isModalOpen"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4">

    <div class="bg-white w-full max-w-5xl rounded-2xl shadow-xl overflow-y-auto max-h-[90vh]">

        <!-- HEADER -->
        <div class="flex justify-between items-center border-b p-5">
            <div>
                <h2 class="text-2xl font-bold">Recept szerkesztése</h2>
                <p class="text-sm text-gray-500">
                    ID: {{selectedRecept.id || selectedRecept.nextId}}
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
                            ng-model="selectedRecept.Nev"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Alkategória</label>
                        <select class="w-full border rounded-lg p-2 mt-1" ng-model="selectedRecept.AlkategoriaID">
                            <option ng-repeat="a in alkategoriak"
                                ng-value="a.AlkategoriaID">
                                {{a.Alkategoria}}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Elkészítési idő (óra:perc)</label>
                        <input type="time"
                            ng-model="selectedRecept.ElkeszitesiIdo"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Nehézségi szint</label>
                        <select ng-model="selectedRecept.NehezsegiSzintID"
                            ng-options="n.NehezsegiSzintID as n.Szint for n in nehezsegek"
                            class="w-full border rounded-lg p-2 mt-1">
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Kalória</label>
                        <input type="number" step="0.01"
                            ng-model="selectedRecept.Kaloria"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Árkategória</label>

                        <select ng-model="selectedRecept.ArkategoriaID"
                            class="w-full border rounded-lg p-2 mt-1">

                            <option ng-repeat="a in arkategoriak"
                                ng-value="a.ArkategoriaID">
                                {{a.Arkategoria}}
                            </option>

                        </select>
                    </div>

                </div>

                <!-- JOBB OLDAL -->
                <div class="space-y-4">

                    <div>
                        <label class="text-sm font-semibold">Kép URL</label>
                        <input type="text"
                            ng-model="selectedRecept.Kep"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <img ng-src="/CookQuest/assets/kepek/etelek/{{selectedRecept.Kep}}"
                            class="w-full h-32 object-cover rounded-lg border">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Adag</label>
                        <input type="number"
                            ng-model="selectedRecept.Adag"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Pontok</label>
                        <input type="number"
                            ng-model="selectedRecept.BegyujthetoPontok"
                            class="w-full border rounded-lg p-2 mt-1">
                    </div>



                </div>

            </div>

            <div>
                <label class="text-sm font-semibold">Elkészítési mód</label>
                <select class="w-full border rounded-lg p-2 mt-1" ng-model="selectedRecept.ElkeszitesiModID">
                    <option ng-repeat="e in elkeszitesiModok"
                        ng-value="e.ElkeszitesiModID">
                        {{e.ElkeszitesiMod}}
                    </option>
                </select>
            </div>

            <!-- LEÍRÁS -->
            <div>
                <label class="text-sm font-semibold">Elkészítési leírás</label>
                <textarea ng-model="selectedRecept.Elkeszitesi_leiras"
                    class="w-full border rounded-lg p-2 mt-1 h-28"></textarea>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 border">

                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-lg">Hozzávalók</h3>

                    <button ng-click="addHozzavalo()"
                        class="bg-blue-500 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-600">
                        + Hozzáadás
                    </button>
                </div>

                <div class="space-y-2">

                    <div ng-repeat="h in selectedRecept.hozzavalok track by $index"
                        class="grid grid-cols-12 gap-2 items-center bg-white p-2 rounded-lg shadow-sm">

                        <select ng-model="h.selectedHozzavalo"
                            ng-options="x as x.Nev for x in osszesHozzavalo track by x.HozzavaloID"
                            class="col-span-3 border rounded-lg p-2">
                        </select>

                        <input type="number"
                            ng-model="h.Mennyiseg"
                            placeholder="Mennyiség"
                            class="col-span-3 border rounded-lg p-2">

                        <select ng-model="h.selectedMertekegyseg"
                            ng-options="m as m.Elnevezes for m in osszesMertekegyseg track by m.MertekegysegID"
                            class="col-span-3 border rounded-lg p-2">
                        </select>

                        <button ng-click="removeHozzavalo($index)"
                            class="col-span-1 text-red-500 hover:text-red-700">
                            ✕
                        </button>

                    </div>

                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="flex justify-end gap-3 border-t p-5">

            <button ng-click="closeModal()"
                class="bg-gray-400 text-white px-5 py-2 rounded-lg">
                Mégse
            </button>

            <button ng-click="saveRecept()"
                class="bg-green-600 text-white px-5 py-2 rounded-lg">
                Mentés
            </button>

        </div>

    </div>
</div>