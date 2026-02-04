document.addEventListener('DOMContentLoaded', () => {
    // Szűrő panel ki/be
    const szuroGomb = document.getElementById('szuroGomb');
    const szuroPanel = document.getElementById('szuroPanel');
    const szuroNyil = document.getElementById('szuroNyil');
    if (szuroGomb) {
        szuroGomb.addEventListener('click', () => {
            szuroPanel.classList.toggle('hidden');
            szuroNyil.classList.toggle('rotate-180');
        });
    }

    // Baloldali accordion
    document.querySelectorAll('.szint-sav-cim').forEach(cim => {
        cim.addEventListener('click', () => {
            const tartalom = cim.nextElementSibling;
            const nyil = cim.querySelector('.sav-nyil');
            tartalom.classList.toggle('hidden');
            nyil.classList.toggle('rotate-180');
        });
    });

    // Mobil sidebar ki/be
    const mobilSidebarToggle = document.getElementById('mobilSidebarToggle');
    const mobilSidebarClose = document.getElementById('mobilSidebarClose');
    const sidebar = document.getElementById('sidebar');
    if (mobilSidebarToggle) {
        mobilSidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }
    if (mobilSidebarClose) {
        mobilSidebarClose.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    }

    // Szűrő logika (változatlan)
    const keresInput = document.getElementById('keresInput');
    const oldalsoKereso = document.getElementById('oldalsoKereso');
    const kategoriaCheckboxok = document.querySelectorAll('.kategoriaCheckbox');
    const foKategoriaCheckboxok = document.querySelectorAll('.foKategoriaCheckbox');
    const resetGomb = document.getElementById('szuroReset');
    const osszesKategoriaGomb = document.getElementById('osszesKategoria');
    const szuroSzamlalo = document.getElementById('szuroSzamlalo');
    const aktivSzurokKontener = document.getElementById('aktivSzurokKontener');
    const aktivSzurokLista = document.getElementById('aktivSzurokLista');
    const talalatSzam = document.getElementById('talalatSzam');
    const szurtReceptekSzama = document.getElementById('szurtReceptekSzama');
    const nincsEredmeny = document.getElementById('nincsEredmeny');
    const keresTorles = document.getElementById('keresTorles');
    const oldalsoKeresTorles = document.getElementById('oldalsoKeresTorles');

    foKategoriaCheckboxok.forEach(foKatCheckbox => {
        foKatCheckbox.addEventListener('change', (e) => {
            const foKat = e.target.dataset.fokategoria;
            const alKategoriaCheckboxok = document.querySelectorAll(`.kategoriaCheckbox[data-fokategoria="${foKat}"]`);
            alKategoriaCheckboxok.forEach(cb => cb.checked = e.target.checked);
            szur();
        });
    });

    kategoriaCheckboxok.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const foKat = checkbox.dataset.fokategoria;
            const foKatCheckbox = document.querySelector(`.foKategoriaCheckbox[data-fokategoria="${foKat}"]`);
            const alKategoriaCheckboxok = document.querySelectorAll(`.kategoriaCheckbox[data-fokategoria="${foKat}"]`);
            const osszesKijelolve = Array.from(alKategoriaCheckboxok).every(cb => cb.checked);
            const egyikSemKijelolve = Array.from(alKategoriaCheckboxok).every(cb => !cb.checked);

            if (osszesKijelolve) {
                foKatCheckbox.checked = true;
                foKatCheckbox.indeterminate = false;
            } else if (egyikSemKijelolve) {
                foKatCheckbox.checked = false;
                foKatCheckbox.indeterminate = false;
            } else {
                foKatCheckbox.indeterminate = true;
            }

            szur();
        });
    });

    if (osszesKategoriaGomb) {
        osszesKategoriaGomb.addEventListener('click', () => {
            const osszesKijelolve = Array.from(kategoriaCheckboxok).every(cb => cb.checked);
            kategoriaCheckboxok.forEach(cb => cb.checked = !osszesKijelolve);
            foKategoriaCheckboxok.forEach(cb => {
                cb.checked = !osszesKijelolve;
                cb.indeterminate = false;
            });
            osszesKategoriaGomb.textContent = osszesKijelolve ? 'Összes kijelölése' : 'Kijelölések törlése';
            szur();
        });
    }

    if (keresTorles) {
        keresTorles.addEventListener('click', () => {
            keresInput.value = '';
            keresTorles.classList.add('hidden');
            szur();
        });
    }
    if (oldalsoKeresTorles) {
        oldalsoKeresTorles.addEventListener('click', () => {
            oldalsoKereso.value = '';
            oldalsoKeresTorles.classList.add('hidden');
            szur();
        });
    }

    if (keresInput) {
        keresInput.addEventListener('input', (e) => {
            keresTorles.classList.toggle('hidden', e.target.value.length === 0);
            if (oldalsoKereso) oldalsoKereso.value = e.target.value;
            szur();
        });
    }

    if (oldalsoKereso) {
        oldalsoKereso.addEventListener('input', (e) => {
            oldalsoKeresTorles.classList.toggle('hidden', e.target.value.length === 0);
            if (keresInput) keresInput.value = e.target.value;
            szur();
        });
    }

    function frissitAktivSzurok() {
        const aktivSzurok = [];
        const keresSzoveg = (keresInput?.value || '').trim();

        if (keresSzoveg) {
            aktivSzurok.push({
                tipus: 'kereses',
                szoveg: `"${keresSzoveg}"`,
                torles: () => {
                    if (keresInput) keresInput.value = '';
                    if (oldalsoKereso) oldalsoKereso.value = '';
                    if (keresTorles) keresTorles.classList.add('hidden');
                    if (oldalsoKeresTorles) oldalsoKeresTorles.classList.add('hidden');
                    szur();
                }
            });
        }

        kategoriaCheckboxok.forEach(cb => {
            if (cb.checked) {
                aktivSzurok.push({
                    tipus: 'kategoria',
                    szoveg: cb.dataset.alkategoria,
                    torles: () => {
                        cb.checked = false;
                        const foKat = cb.dataset.fokategoria;
                        const foKatCheckbox = document.querySelector(`.foKategoriaCheckbox[data-fokategoria="${foKat}"]`);
                        const alKategoriaCheckboxok = document.querySelectorAll(`.kategoriaCheckbox[data-fokategoria="${foKat}"]`);
                        const egyikSemKijelolve = Array.from(alKategoriaCheckboxok).every(c => !c.checked);
                        if (egyikSemKijelolve) {
                            foKatCheckbox.checked = false;
                            foKatCheckbox.indeterminate = false;
                        } else {
                            foKatCheckbox.indeterminate = true;
                        }
                        szur();
                    }
                });
            }
        });

        if (aktivSzurok.length > 0) {
            aktivSzurokKontener.classList.remove('hidden');
            szuroSzamlalo.classList.remove('hidden');
            szuroSzamlalo.textContent = aktivSzurok.length;

            aktivSzurokLista.innerHTML = aktivSzurok.map(szuro => `
                <button class="inline-flex items-center gap-1 px-3 py-1 bg-[#6F837B] text-white text-xs rounded-full hover:bg-[#5a6a64] transition">
                    ${szuro.szoveg}
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `).join('');

            aktivSzurokLista.querySelectorAll('button').forEach((btn, index) => {
                btn.addEventListener('click', aktivSzurok[index].torles);
            });
        } else {
            aktivSzurokKontener.classList.add('hidden');
            szuroSzamlalo.classList.add('hidden');
        }
    }

    function szur() {
        const keresSzoveg = (keresInput?.value || oldalsoKereso?.value || '').toLowerCase().trim();

        const kivalasztottFoKatk = new Set();
        const kivalasztottAlKatk = new Set();

        kategoriaCheckboxok.forEach(cb => {
            if (cb.checked) {
                kivalasztottFoKatk.add(cb.dataset.fokategoria);
                kivalasztottAlKatk.add(cb.dataset.alkategoria);
            }
        });

        const vanKategoriaSzures = kivalasztottAlKatk.size > 0; // Csak alkategória alapján szűrünk

        let osszesReceptDb = 0;
        let lathatolReceptDb = 0;
        const szintDarabok = {};

        document.querySelectorAll('.szint-blokk').forEach(blokk => {
            let vanLathatoRecept = false;
            let szintLathatoDb = 0;
            const szint = blokk.dataset.szint;

            blokk.querySelectorAll('.recept-kartya').forEach(kartya => {
                osszesReceptDb++;

                const nev = kartya.dataset.nev;
                const foKat = kartya.dataset.fokategoria;
                const alKat = kartya.dataset.alkategoria;

                const nevLatszik = keresSzoveg === '' || nev.includes(keresSzoveg);

                let katLatszik = true;
                if (vanKategoriaSzures) {
                    katLatszik = kivalasztottAlKatk.has(alKat);
                }

                const latszik = nevLatszik && katLatszik;

                kartya.style.display = latszik ? 'block' : 'none';

                if (latszik) {
                    vanLathatoRecept = true;
                    lathatolReceptDb++;
                    szintLathatoDb++;
                }
            });

            blokk.style.display = vanLathatoRecept ? 'block' : 'none';
            szintDarabok[szint] = szintLathatoDb;
        });

        Object.keys(szintDarabok).forEach(szint => {
            const darab = szintDarabok[szint];
            document.querySelectorAll(`.szint-darab[data-szint="${szint}"]`).forEach(elem => {
                elem.textContent = darab;
            });
            document.querySelectorAll(`.szint-darab-fo[data-szint="${szint}"]`).forEach(elem => {
                elem.textContent = darab;
            });
        });

        if (talalatSzam) {
            talalatSzam.textContent = lathatolReceptDb > 0
                ? `${lathatolReceptDb} találat`
                : 'Nincs találat';
        }

        if (szurtReceptekSzama) {
            if (vanKategoriaSzures) {
                szurtReceptekSzama.textContent = `${lathatolReceptDb} recept a kiválasztott kategóriákban`;
            } else {
                szurtReceptekSzama.textContent = `${lathatolReceptDb} recept látható ${osszesReceptDb}-ból`;
            }
        }

        if (nincsEredmeny) {
            nincsEredmeny.classList.toggle('hidden', lathatolReceptDb > 0);
        }

        frissitAktivSzurok();
    }

    if (resetGomb) {
        resetGomb.addEventListener('click', () => {
            kategoriaCheckboxok.forEach(cb => cb.checked = false);
            foKategoriaCheckboxok.forEach(cb => {
                cb.checked = false;
                cb.indeterminate = false;
            });
            if (keresInput) keresInput.value = '';
            if (oldalsoKereso) oldalsoKereso.value = '';
            if (keresTorles) keresTorles.classList.add('hidden');
            if (oldalsoKeresTorles) oldalsoKeresTorles.classList.add('hidden');
            szur();
        });
    }

    szur();
});
