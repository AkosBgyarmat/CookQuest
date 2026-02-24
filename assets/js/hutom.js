document.addEventListener('DOMContentLoaded', function() {
    var kereso = document.getElementById('hozzavaloKereses');
    var labelek = document.querySelectorAll('.hozzavalo-label');
    var checkboxok = document.querySelectorAll('.hozzavalo-checkbox');
    var szamlalo = document.getElementById('kivalasztottSzamlalo');
    var torlesGomb = document.getElementById('mindTorles');
    var nincsUzenet = document.getElementById('nincsHozzavalo');
    var lista = document.getElementById('hozzavaloLista');

    // A kiválasztott elemek számának frissítése
    function frissitSzamlalo() {
        var db = 0;
        for (var i = 0; i < checkboxok.length; i++) {
            if (checkboxok[i].checked) db++;
        }
        szamlalo.textContent = db;
    }

    // Szűrőfüggvény: ellenőrzi, hogy a név a keresési kifejezéssel kezdődik-e (kis- és nagybetű érzéketlenül)
    function startsWithFilter(item) {
        if (!kereso.value || kereso.value.trim() === '') {
            return true; // Üres keresés esetén nincs szűrés
        }
        const nev = (item || '').toLowerCase();
        const search = kereso.value.trim().toLowerCase();
        return nev.indexOf(search) === 0; // Vizsgálja, hogy a név a keresett szöveggel kezdődik-e
    }

    // Keresőmező változásának figyelése és lista szűrése
    kereso.addEventListener('input', function() {
        var kereses = this.value.trim().toLowerCase();
        var vanTalalat = false;

        for (var i = 0; i < labelek.length; i++) {
            var nev = labelek[i].getAttribute('data-nev');

            if (startsWithFilter(nev)) {
                labelek[i].style.display = '';
                vanTalalat = true;
            } else {
                labelek[i].style.display = 'none';
            }
        }

        // "Nincs találat" üzenet és lista megjelenítésének kezelése
        nincsUzenet.classList.toggle('hidden', vanTalalat);
        lista.classList.toggle('hidden', !vanTalalat);
    });

    // Checkbox állapotváltozás figyelése → számláló frissítése
    for (var i = 0; i < checkboxok.length; i++) {
        checkboxok[i].addEventListener('change', frissitSzamlalo);
    }

    // Összes kijelölés törlése gomb működése
    torlesGomb.addEventListener('click', function() {
        for (var i = 0; i < checkboxok.length; i++) {
            checkboxok[i].checked = false;
        }
        frissitSzamlalo();
    });

    // Kezdeti számláló frissítése (pl. POST után megőrzött kijelölések esetén)
    frissitSzamlalo();
});