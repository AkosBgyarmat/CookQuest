document.addEventListener('DOMContentLoaded', () => {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  const receptKartyak = () => $$('.recept-kartya');
  const szintBlokkok = () => $$('.szint-blokk');

  // --- HARD "mindig látszódjon" ---
  function mindentMutat() {
    receptKartyak().forEach(el => {
      el.classList.remove('hidden');
      el.style.display = ''; // ha inline display:none volt
    });
    szintBlokkok().forEach(el => {
      el.classList.remove('hidden');
      el.style.display = '';
    });
    const nincsEredmeny = $('#nincsEredmeny');
    if (nincsEredmeny) nincsEredmeny.classList.add('hidden');
  }

  // Többször lefuttatjuk, hogy ha más script elrejti betöltéskor, visszahozzuk
  mindentMutat();
  setTimeout(mindentMutat, 0);
  setTimeout(mindentMutat, 50);
  setTimeout(mindentMutat, 200);
  window.addEventListener('load', mindentMutat);
  window.addEventListener('pageshow', mindentMutat);

  // --- Mobil sidebar ---
  const sidebar = $('#sidebar');
  const mobilSidebarToggle = $('#mobilSidebarToggle');
  const mobilSidebarClose = $('#mobilSidebarClose');

  function sidebarNyit() {
    if (!sidebar) return;
    sidebar.classList.remove('-translate-x-full');
  }
  function sidebarZar() {
    if (!sidebar) return;
    sidebar.classList.add('-translate-x-full');
  }

  if (mobilSidebarToggle && sidebar) mobilSidebarToggle.addEventListener('click', sidebarNyit);
  if (mobilSidebarClose && sidebar) mobilSidebarClose.addEventListener('click', sidebarZar);

  document.addEventListener('click', (e) => {
    if (!sidebar) return;
    if (window.matchMedia('(min-width: 1024px)').matches) return;
    const clickedToggle = mobilSidebarToggle && mobilSidebarToggle.contains(e.target);
    const clickedInsideSidebar = sidebar.contains(e.target);
    if (!clickedInsideSidebar && !clickedToggle) sidebarZar();
  });

  // --- Sidebar szint lenyitás ---
  $$('.szint-sav-cim').forEach((btn) => {
    btn.addEventListener('click', () => {
      const wrapper = btn.parentElement;
      if (!wrapper) return;
      const ul = $('.szint-sav-tartalom', wrapper);
      const nyil = $('.sav-nyil', btn);
      if (!ul) return;

      const nyitva = !ul.classList.contains('hidden');
      ul.classList.toggle('hidden', nyitva);
      if (nyil) nyil.classList.toggle('rotate-180', !nyitva);
    });
  });

  // --- Szűrő elemek (ha vannak) ---
  const szuroGomb = $('#szuroGomb');
  const szuroPanel = $('#szuroPanel');
  const szuroReset = $('#szuroReset');
  const szuroSzamlalo = $('#szuroSzamlalo');
  const szuroNyil = $('#szuroNyil');
  const kategoriaCheckboxok = $$('.kategoriaCheckbox');

  function frissitSzuroSzamlalo() {
    if (!szuroSzamlalo) return;
    const db = kategoriaCheckboxok.filter(cb => cb.checked).length;
    szuroSzamlalo.textContent = String(db);
    szuroSzamlalo.classList.toggle('hidden', db === 0);
  }

  if (szuroGomb && szuroPanel) {
    szuroGomb.addEventListener('click', () => {
      const nyitva = !szuroPanel.classList.contains('hidden');
      szuroPanel.classList.toggle('hidden', nyitva);
      if (szuroNyil) szuroNyil.classList.toggle('rotate-180', !nyitva);
    });
  }

  // --- Kereső (ha van fent a navbarban) ---
  // Megfogjuk bármelyik tipikus kereső inputot
  const keresInput =
    $('#kereso') ||
    $('#kereses') ||
    $('#navKereses') ||
    document.querySelector('input[placeholder*="Keres"]');

  function szuresAlkalmazasa() {
    const cards = receptKartyak();
    if (!cards.length) return;

    // kiválasztott kategóriák
    const kivalasztott = new Set(
      kategoriaCheckboxok
        .filter(cb => cb.checked)
        .map(cb => `${cb.dataset.fokategoria || ''}||${cb.dataset.alkategoria || ''}`)
    );
    const vanKategoriaSzures = kivalasztott.size > 0;

    // kereső szöveg
    const q = (keresInput?.value || '').trim().toLowerCase();
    const vanKereses = q.length > 0;

    // szűrés
    cards.forEach(card => {
      const fo = card.dataset.fokategoria || '';
      const al = card.dataset.alkategoria || '';
      const key = `${fo}||${al}`;

      const nev = (card.dataset.nev || '').toLowerCase();

      const okKat = !vanKategoriaSzures || kivalasztott.has(key);
      const okNev = !vanKereses || nev.includes(q);

      const lathato = okKat && okNev;
      card.classList.toggle('hidden', !lathato);
    });

    // szint darabok frissítés + nincs találat
    frissitDarabokEsBlokkok();
    frissitSzuroSzamlalo();
  }

  function frissitDarabokEsBlokkok() {
    const cards = receptKartyak();
    const blokkok = szintBlokkok();
    const nincsEredmeny = $('#nincsEredmeny');

    // kártya -> szint map
    const kartyaSzintMap = new Map();
    cards.forEach(card => {
      const blokk = card.closest('.szint-blokk');
      const szint = blokk ? parseInt(blokk.getAttribute('data-szint') || '0', 10) : 0;
      kartyaSzintMap.set(card, szint);
    });

    const szamlalo = {};
    cards.forEach(card => {
      const szint = kartyaSzintMap.get(card) || 0;
      const lathato = !card.classList.contains('hidden');
      szamlalo[szint] ??= 0;
      if (lathato) szamlalo[szint]++;
    });

    $$('.szint-darab').forEach(span => {
      const s = parseInt(span.getAttribute('data-szint') || '0', 10);
      span.textContent = String(szamlalo[s] ?? 0);
    });

    $$('.szint-darab-fo').forEach(span => {
      const s = parseInt(span.getAttribute('data-szint') || '0', 10);
      span.textContent = String(szamlalo[s] ?? 0);
    });

    blokkok.forEach(blokk => {
      const s = parseInt(blokk.getAttribute('data-szint') || '0', 10);
      blokk.classList.toggle('hidden', (szamlalo[s] ?? 0) === 0);
    });

    const vanValami = cards.some(c => !c.classList.contains('hidden'));
    if (nincsEredmeny) nincsEredmeny.classList.toggle('hidden', vanValami);
  }

  // események
  kategoriaCheckboxok.forEach(cb => cb.addEventListener('change', szuresAlkalmazasa));
  if (keresInput) keresInput.addEventListener('input', szuresAlkalmazasa);

  if (szuroReset) {
    szuroReset.addEventListener('click', () => {
      kategoriaCheckboxok.forEach(cb => cb.checked = false);
      if (keresInput) keresInput.value = '';
      mindentMutat();
      frissitSzuroSzamlalo();
      frissitDarabokEsBlokkok();
    });
  }

  // indulás
  frissitSzuroSzamlalo();
  frissitDarabokEsBlokkok();
});