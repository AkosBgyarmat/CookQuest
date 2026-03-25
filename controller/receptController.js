document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('indexReceptekContainer');
  const dataNode = document.getElementById('indexReceptekData');
  const recipePage = (container?.dataset?.recipePage || '/CookQuest/views/receptek/receptek.php').trim();

  if (!container || !dataNode) return;

  let receptek = [];
  try {
    receptek = JSON.parse(dataNode.textContent || '[]');
  } catch (error) {
    receptek = [];
  }

  if (!Array.isArray(receptek)) {
    receptek = [];
  }

  const seen = new Set();
  const unique = [];

  receptek.forEach((recept) => {
    const id = Number(recept.ReceptID || 0);
    const nev = String(recept.Nev || '').trim().toLocaleLowerCase('hu-HU');
    const kulcs = id > 0 ? `id:${id}` : `nev:${nev}`;

    if (!nev || seen.has(kulcs)) return;

    seen.add(kulcs);
    unique.push(recept);
  });

  for (let i = unique.length - 1; i > 0; i -= 1) {
    const j = Math.floor(Math.random() * (i + 1));
    [unique[i], unique[j]] = [unique[j], unique[i]];
  }

  const megjelenitendo = unique.slice(0, 3);

  if (!megjelenitendo.length) {
    container.innerHTML = `
      <div class="md:col-span-3 bg-white rounded-2xl shadow-md p-6 text-center text-gray-600">
        Jelenleg nem található megjeleníthető 1. szintű recept.
      </div>
    `;
    return;
  }

  const kartyaHtml = megjelenitendo.map((r) => {
    const href = `${recipePage}?id=${Number(r.ReceptID || 0)}`;
    const nev = String(r.Nev || '');
    const kep = String(r.KepSrc || '');
    const pont = Number(r.BegyujthetoPontok || 0);
    const szint = Number(r.Szint || 1);
    const ido = String(r.ElkeszitesiIdoFormazott || '');

    return `
      <a href="${href}"
         class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1 block">
        <div class="relative overflow-hidden">
          <img src="${kep}"
               class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
               alt="${nev}">
          <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
            <span class="text-sm text-[#596C68] font-bold">⭐ ${pont}</span>
          </div>
        </div>

        <div class="p-5">
          <div class="flex items-center gap-2 mb-2">
            <span class="text-xs font-semibold px-3 py-1 bg-[#E3D9CA] text-[#596C68] rounded-full">
              ${szint}. SZINT
            </span>
          </div>

          <h3 class="font-bold text-xl mt-2 text-[#403F48] group-hover:text-[#596C68] transition-colors line-clamp-2 min-h-[3.5rem]">
            ${nev}
          </h3>

          <div class="mt-4 flex items-center gap-4 text-sm text-gray-600">
            <div class="flex items-center gap-1">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
              </svg>
              <span>${ido}</span>
            </div>
          </div>

          <span class="mt-4 block text-center w-full py-2.5 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#4a5a56] transition-colors shadow-sm">
            Recept megtekintése
          </span>
        </div>
      </a>
    `;
  }).join('');

  container.innerHTML = kartyaHtml;
});
