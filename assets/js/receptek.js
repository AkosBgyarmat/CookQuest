document.addEventListener('DOMContentLoaded', function() {
    // === ELEMEK KIJELÖLÉSE ===
    const szuroGomb        = document.getElementById('szuroGomb');
    const szuroPanel       = document.getElementById('szuroPanel');
    const szuroNyil        = document.getElementById('szuroNyil');
    const szuroSzamlalo    = document.getElementById('szuroSzamlalo');
    const szuroReset       = document.getElementById('szuroReset');
    const keresInput       = document.getElementById('keresInput');
    const nincsEredmeny    = document.getElementById('nincsEredmeny');

    const mobilSidebarToggle = document.getElementById('mobilSidebarToggle');
    const mobilSidebarClose  = document.getElementById('mobilSidebarClose');
    const sidebar            = document.getElementById('sidebar');

    const szintBlokkok       = document.querySelectorAll('.szint-blokk');
    const sidebarSzintCimek  = document.querySelectorAll('.szint-sav-cim');

    let szuroAllapot = {
        keres: '',
        kategoriak: new Set() // "Főkat:Alkat" formátum
    };

    // === 1. SZŰRŐ PANEL ÉS MOBIL SIDEBAR NYITÁSA ===
    if (szuroGomb && szuroPanel) {
        szuroGomb.addEventListener('click', () => {
            szuroPanel.classList.toggle('hidden');
            if (szuroNyil) szuroNyil.classList.toggle('rotate-180');
        });
    }

    if (mobilSidebarToggle && sidebar) {
        mobilSidebarToggle.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });
    }

    if (mobilSidebarClose && sidebar) {
        mobilSidebarClose.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    }

    // === 2. SIDEBAR SZINT-LENYÍLÓK (Accordion) ===
    sidebarSzintCimek.forEach(cim => {
        cim.addEventListener('click', () => {
            const tartalom = cim.nextElementSibling;
            const nyil = cim.querySelector('.sav-nyil');
            
            tartalom.classList.toggle('hidden');
            if (nyil) nyil.classList.toggle('rotate-180');
        });
    });

    // === 3. SZŰRÉSI LOGIKA ===
    function szur() {
        let osszesTalalat = 0;

        szintBlokkok.forEach(blokk => {
            let talalatASzintben = 0;
            const kartyak = blokk.querySelectorAll('.recept-kartya');

            kartyak.forEach(kartya => {
                const nev = kartya.dataset.nev || '';
                const foKat = kartya.dataset.fokategoria || '';
                const alKat = kartya.dataset.alkategoria || '';
                const kulcs = `${foKat}:${alKat}`;

                const joNev = !szuroAllapot.keres || nev.includes(szuroAllapot.keres.toLowerCase());
                let joKategoria = szuroAllapot.kategoriak.size === 0 || szuroAllapot.kategoriak.has(kulcs);

                if (joNev && joKategoria) {
                    kartya.style.display = '';
                    talalatASzintben++;
                    osszesTalalat++;
                } else {
                    kartya.style.display = 'none';
                }
            });

            // Blokk elrejtése ha üres
            blokk.style.display = talalatASzintben > 0 ? '' : 'none';
            
            // Számláló frissítése a fejlécben
            const szamlalo = blokk.querySelector('.szint-darab-fo');
            if (szamlalo) szamlalo.textContent = talalatASzintben;
        });

        // Nincs eredmény üzenet
        if (nincsEredmeny) {
            nincsEredmeny.classList.toggle('hidden', osszesTalalat > 0);
        }
        
        // Szűrő gomb számlálója
        if (szuroSzamlalo) {
            const db = szuroAllapot.kategoriak.size;
            szuroSzamlalo.textContent = db;
            szuroSzamlalo.classList.toggle('hidden', db === 0);
        }
    }

    // === 4. ESEMÉNYKEZELŐK A SZŰRŐHÖZ ===
    if (keresInput) {
        keresInput.addEventListener('input', (e) => {
            szuroAllapot.keres = e.target.value.trim();
            szur();
        });
    }

    document.querySelectorAll('.kategoriaCheckbox').forEach(chk => {
        chk.addEventListener('change', () => {
            const kulcs = `${chk.dataset.fokategoria}:${chk.dataset.alkategoria}`;
            if (chk.checked) szuroAllapot.kategoriak.add(kulcs);
            else szuroAllapot.kategoriak.delete(kulcs);
            szur();
        });
    });

    if (szuroReset) {
        szuroReset.addEventListener('click', () => {
            if (keresInput) keresInput.value = '';
            szuroAllapot.keres = '';
            document.querySelectorAll('.kategoriaCheckbox').forEach(c => c.checked = false);
            szuroAllapot.kategoriak.clear();
            szur();
        });
    }
});