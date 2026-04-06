<div ng-show="isModalOpen"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4">

    <div class="bg-white w-full max-w-5xl rounded-2xl shadow-xl overflow-y-auto max-h-[90vh]">

        <!-- HEADER -->
        <div class="flex justify-between items-center border-b p-5">
            <div>
                <h2 class="text-2xl font-bold">{{ selectedFelhasznalo.id ? 'Felhasználó szerkesztése' : 'Új felhasználó létrehozása' }}</h2>
                <p class="text-sm text-gray-500">
                    ID: {{selectedFelhasznalo.id || selectedFelhasznalo.nextId}}
                </p>
            </div>

            <button ng-click="closeModal()" class="text-gray-500 hover:text-black text-xl">
                ✕
            </button>
        </div>

        <!-- BODY -->
        <div class="p-6 space-y-6">

            <div class="grid md:grid-cols-2 gap-6">


                <div>
                    <label class="text-sm font-semibold">Vezetéknév</label>
                    <input type="text"
                        ng-model="selectedFelhasznalo.Vezeteknev"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                <div>
                    <label class="text-sm font-semibold">Keresztnév</label>
                    <input type="text"
                        ng-model="selectedFelhasznalo.Keresztnev"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                <div>
                    <label class="text-sm font-semibold">Felhasználónév</label>
                    <input type="text"
                        ng-model="selectedFelhasznalo.Felhasznalonev"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                
                <div>
                    <label class="text-sm font-semibold">Születési év</label>
                    <input type="number"
                        ng-model="selectedFelhasznalo.SzuletesiEv"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                <div>
                    <label class="text-sm font-semibold">Email cím</label>
                    <input type="email"
                        ng-model="selectedFelhasznalo.Emailcim"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                <div>
                    <label class="text-sm font-semibold">Jelszó</label>
                    <input type="password"
                        ng-model="selectedFelhasznalo.Jelszo"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                <div>
                    <label class="text-sm font-semibold">Ország</label>
                    <input type="text"
                        ng-model="selectedFelhasznalo.Orszag"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                <div>
                    <label class="text-sm font-semibold">Regisztrációs év</label>
                    <input type="number"
                        ng-model="selectedFelhasznalo.RegisztracioEve"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                


                <div>
                    <label class="text-sm font-semibold">Szerep</label>
                    <select ng-model="selectedFelhasznalo.Szerep"
                        class="w-full border rounded-lg p-2 mt-1">

                        <option value="admin">Admin</option>
                        <option value="user">Felhasználó</option>
                    </select>
                </div>

                
                <div>
                    <label class="text-sm font-semibold">Törölve</label>
                    <select ng-model="selectedFelhasznalo.Torolve"
                        class="w-full border rounded-lg p-2 mt-1">

                        <option value="0">Nem</option>
                        <option value="1">Igen</option>
                    </select>
                </div>

            </div>

            <!-- JOBB OLDAL -->
            <div class="space-y-4">

                <div>
                    <label class="text-sm font-semibold">Kép URL</label>
                    <input type="text"
                        ng-model="selectedFelhasznalo.Profilkep"
                        class="w-full border rounded-lg p-2 mt-1">
                </div>

                <div>
                    <img ng-src="{{selectedFelhasznalo.Profilkep || '/CookQuest/assets/kepek/Logo.png'}}"
                        alt="{{selectedFelhasznalo.Profilkep ? 'Profilkép' : 'Nincs kép'}}"
                        title="{{selectedFelhasznalo.Profilkep ? 'Profilkép' : 'Nincs kép'}}"
                        class="w-32 h-32 object-cover rounded-lg border">
                </div>

            </div>


            <!-- FOOTER -->
            <div class="flex justify-end gap-3 border-t p-5">

                <button ng-click="closeModal()"
                    class="bg-gray-400 text-white px-5 py-2 rounded-lg">
                    Mégse
                </button>

                <button ng-click="saveFelhasznalo()"
                    class="bg-[#5A7863] text-white px-5 py-2 rounded-lg">
                    Mentés
                </button>

            </div>

        </div>

    </div>
</div>