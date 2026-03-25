document.addEventListener('DOMContentLoaded', () => {
  // Rövid segédek: egy elem, illetve több elem lekérése.
  const selectOne = (selector, rootElement = document) => rootElement.querySelector(selector);
  const selectAll = (selector, rootElement = document) => Array.from(rootElement.querySelectorAll(selector));

  const getRecipeCards = () => selectAll('.recept-kartya');
  const getLevelBlocks = () => selectAll('.szint-blokk');
  const levelNavContainer = selectOne('#szintNav');
  const levelNavButtons = levelNavContainer ? selectAll('.szint-nav-gomb', levelNavContainer) : [];
  let activeLevelNav = null;
  const normalizeDataValue = (value) => String(value ?? '')
    .trim()
    .toLocaleLowerCase('hu-HU');
  const getNumericDatasetValue = (element, key) => {
    const numericValue = Number(element?.dataset?.[key]);
    return Number.isNaN(numericValue) ? 0 : numericValue;
  };
  const buildCategoryKey = (mainId, subId, mainName, subName) => {
    if (mainId || subId) {
      return `${mainId}:${subId}`;
    }
    return `${normalizeDataValue(mainName)}||${normalizeDataValue(subName)}`;
  };

  const szintParamFromUrl = (() => {
    const params = new URLSearchParams(window.location.search);
    const rawValue = params.get('szint');
    if (!rawValue) return null;
    const parsedValue = parseInt(rawValue, 10);
    return Number.isNaN(parsedValue) ? null : parsedValue;
  })();

  if (levelNavButtons.length && szintParamFromUrl !== null) {
    const hasMatchingButton = levelNavButtons.some((button) => {
      const buttonLevel = parseInt(button.getAttribute('data-szint') || '0', 10);
      return !Number.isNaN(buttonLevel) && buttonLevel === szintParamFromUrl;
    });
    if (hasMatchingButton) {
      activeLevelNav = szintParamFromUrl;
    }
  }

  // --- HARD "mindig látszódjon" ---
  function showAllRecipes() {
    getRecipeCards().forEach(cardElement => {
      cardElement.classList.remove('hidden');
      cardElement.style.display = ''; // ha inline display:none volt
    });
    getLevelBlocks().forEach(levelBlockElement => {
      levelBlockElement.classList.remove('hidden');
      levelBlockElement.style.display = '';
    });
    const noResultElement = selectOne('#nincsEredmeny');
    if (noResultElement) noResultElement.classList.add('hidden');

    applyLevelNavVisibility();
  }

  // Többször lefuttatjuk, hogy ha más script elrejti betöltéskor, visszahozzuk.
  showAllRecipes();
  setTimeout(showAllRecipes, 0);
  setTimeout(showAllRecipes, 50);
  setTimeout(showAllRecipes, 200);
  window.addEventListener('load', showAllRecipes);
  window.addEventListener('pageshow', showAllRecipes);

  // --- Mobil sidebar ---
  const sidebarElement = selectOne('#sidebar');
  const mobileSidebarOpenButton = selectOne('#mobilSidebarToggle');
  const mobileSidebarCloseButton = selectOne('#mobilSidebarClose');

  function openSidebar() {
    if (!sidebarElement) return;
    sidebarElement.classList.remove('-translate-x-full');
  }

  function closeSidebar() {
    if (!sidebarElement) return;
    sidebarElement.classList.add('-translate-x-full');
  }

  if (mobileSidebarOpenButton && sidebarElement) {
    mobileSidebarOpenButton.addEventListener('click', openSidebar);
  }
  if (mobileSidebarCloseButton && sidebarElement) {
    mobileSidebarCloseButton.addEventListener('click', closeSidebar);
  }

  document.addEventListener('click', (clickEvent) => {
    if (!sidebarElement) return;
    if (window.matchMedia('(min-width: 1024px)').matches) return;

    const clickOnOpenButton = mobileSidebarOpenButton && mobileSidebarOpenButton.contains(clickEvent.target);
    const clickInsideSidebar = sidebarElement.contains(clickEvent.target);
    if (!clickInsideSidebar && !clickOnOpenButton) closeSidebar();
  });

  // --- Sidebar szint lenyitás ---
  selectAll('.szint-sav-cim').forEach((levelHeaderButton) => {
    levelHeaderButton.addEventListener('click', () => {
      const levelHeaderWrapper = levelHeaderButton.parentElement;
      if (!levelHeaderWrapper) return;

      const levelContentList = selectOne('.szint-sav-tartalom', levelHeaderWrapper);
      const arrowIcon = selectOne('.sav-nyil', levelHeaderButton);
      if (!levelContentList) return;

      const isOpen = !levelContentList.classList.contains('hidden');
      levelContentList.classList.toggle('hidden', isOpen);
      if (arrowIcon) arrowIcon.classList.toggle('rotate-180', !isOpen);
    });
  });

  // --- Szűrő elemek (ha vannak) ---
  const filterToggleButton = selectOne('#szuroGomb');
  const filterPanelElement = selectOne('#szuroPanel');
  const filterResetButton = selectOne('#szuroReset');
  const filterBadgeElement = selectOne('#szuroSzamlalo');
  const filterArrowIcon = selectOne('#szuroNyil');
  const prepTimeSelect = selectOne('#idoSzuro');
  const categoryCheckboxes = selectAll('.kategoriaCheckbox');
  const priceCategoryCheckboxes = selectAll('.arkategoriaCheckbox');

  // Az adatbázisból jövő időt percekre normalizáljuk,
  // hogy a dropdown tartományaihoz (pl. 16-30) hasonlítható legyen.
  function parsePreparationTimeToMinutes(rawPreparationTime) {
    const normalizedRawValue = String(rawPreparationTime || '').trim();
    if (!normalizedRawValue) return null;

    if (/^\d+$/.test(normalizedRawValue)) {
      const parsedMinutes = parseInt(normalizedRawValue, 10);
      return Number.isNaN(parsedMinutes) ? null : parsedMinutes;
    }

    const timeParts = normalizedRawValue.split(':').map(part => parseInt(part, 10));
    if (timeParts.some(Number.isNaN)) return null;

    if (timeParts.length === 3) {
      const [hours, minutes, seconds] = timeParts;
      return (hours * 60) + minutes + (seconds > 0 ? 1 : 0);
    }

    if (timeParts.length === 2) {
      const [minutes, seconds] = timeParts;
      return minutes + (seconds > 0 ? 1 : 0);
    }

    return null;
  }

  // A dropdown value-ból (pl. "16-30") készítünk alsó/felső határt.
  function parseTimeRange(selectedRange) {
    const [minRawValue, maxRawValue] = String(selectedRange || '').split('-');
    const minMinutes = parseInt(minRawValue || '', 10);
    const maxMinutes = parseInt(maxRawValue || '', 10);
    if (Number.isNaN(minMinutes) || Number.isNaN(maxMinutes)) return null;
    return { minMinutes, maxMinutes };
  }

  // A szűrő gomb melletti badge-ben az aktív szűrők számát mutatjuk.
  function refreshActiveFilterCount() {
    if (!filterBadgeElement) return;

    let activeFilterCount = 0;
    activeFilterCount += categoryCheckboxes.filter(categoryCheckbox => categoryCheckbox.checked).length;
    activeFilterCount += priceCategoryCheckboxes.filter(priceCheckbox => priceCheckbox.checked).length;
    if ((prepTimeSelect?.value || '').trim() !== '') activeFilterCount += 1;

    filterBadgeElement.textContent = String(activeFilterCount);
    filterBadgeElement.classList.toggle('hidden', activeFilterCount === 0);
  }

  if (filterToggleButton && filterPanelElement) {
    filterToggleButton.addEventListener('click', () => {
      const isPanelOpen = !filterPanelElement.classList.contains('hidden');
      filterPanelElement.classList.toggle('hidden', isPanelOpen);
      if (filterArrowIcon) filterArrowIcon.classList.toggle('rotate-180', !isPanelOpen);
    });
  }

  function applyFilters() {
    const recipeCards = getRecipeCards();
    if (!recipeCards.length) return;

    // Kiválasztott kategóriák (főkategória + alkategória páros).
    const selectedCategoryPairs = new Set(
      categoryCheckboxes
        .filter(categoryCheckbox => categoryCheckbox.checked)
        .map((categoryCheckbox) => {
          const mainId = getNumericDatasetValue(categoryCheckbox, 'fokategoriaId');
          const subId = getNumericDatasetValue(categoryCheckbox, 'alkategoriaId');
          return buildCategoryKey(
            mainId,
            subId,
            categoryCheckbox.dataset.fokategoria,
            categoryCheckbox.dataset.alkategoria,
          );
        })
    );
    const hasCategoryFilter = selectedCategoryPairs.size > 0;

    const selectedPriceCategories = new Set(
      priceCategoryCheckboxes
        .filter(priceCheckbox => priceCheckbox.checked)
        .map(priceCheckbox => normalizeDataValue(priceCheckbox.dataset.arkategoria))
    );
    const hasPriceCategoryFilter = selectedPriceCategories.size > 0;

    // Időszűrés csak akkor aktív, ha a dropdownban konkrét tartomány van kiválasztva.
    const selectedTimeRange = parseTimeRange(prepTimeSelect?.value || '');
    const hasTimeFilter = Boolean(selectedTimeRange);

    // A kártya akkor marad látható, ha minden aktív szűrőfeltételnek megfelel.
    recipeCards.forEach((recipeCard) => {
      const mainCategory = normalizeDataValue(recipeCard.dataset.fokategoria);
      const subCategory = normalizeDataValue(recipeCard.dataset.alkategoria);
      const mainCategoryId = getNumericDatasetValue(recipeCard, 'fokategoriaId');
      const subCategoryId = getNumericDatasetValue(recipeCard, 'alkategoriaId');
      const categoryPairKey = buildCategoryKey(mainCategoryId, subCategoryId, mainCategory, subCategory);
      const priceCategory = normalizeDataValue(recipeCard.dataset.arkategoria || 'Nincs');
      const prepMinutes = parsePreparationTimeToMinutes(recipeCard.dataset.elkeszitesiIdo || '');

      const categoryMatches = !hasCategoryFilter || selectedCategoryPairs.has(categoryPairKey);
      const priceMatches = !hasPriceCategoryFilter || selectedPriceCategories.has(priceCategory);
      const timeMatches = !hasTimeFilter || (
        prepMinutes !== null
        && prepMinutes >= selectedTimeRange.minMinutes
        && prepMinutes <= selectedTimeRange.maxMinutes
      );

      const isVisible = categoryMatches && priceMatches && timeMatches;
      recipeCard.classList.toggle('hidden', !isVisible);
    });

    // Szint darabok frissítés + nincs találat.
    refreshLevelCountsAndBlocks();
    refreshActiveFilterCount();
  }

  function refreshLevelCountsAndBlocks() {
    const recipeCards = getRecipeCards();

    // Részletes nézetben nincsenek kártyák, ilyenkor hagyjuk meg a szerver által renderelt számokat.
    if (!recipeCards.length) return;

    const levelBlocks = getLevelBlocks();
    const noResultElement = selectOne('#nincsEredmeny');

    // Kártya -> szint map.
    const cardLevelMap = new Map();
    recipeCards.forEach((recipeCard) => {
      const closestLevelBlock = recipeCard.closest('.szint-blokk');
      const levelNumber = closestLevelBlock
        ? parseInt(closestLevelBlock.getAttribute('data-szint') || '0', 10)
        : 0;
      cardLevelMap.set(recipeCard, levelNumber);
    });

    // Látható kártyák darabszáma szintenként.
    const visibleCountByLevel = {};
    recipeCards.forEach((recipeCard) => {
      const levelNumber = cardLevelMap.get(recipeCard) || 0;
      const isVisible = !recipeCard.classList.contains('hidden');
      visibleCountByLevel[levelNumber] ??= 0;
      if (isVisible) visibleCountByLevel[levelNumber]++;
    });

    selectAll('.szint-darab').forEach((levelCountElement) => {
      const levelNumber = parseInt(levelCountElement.getAttribute('data-szint') || '0', 10);
      levelCountElement.textContent = String(visibleCountByLevel[levelNumber] ?? 0);
    });

    selectAll('.szint-darab-fo').forEach((levelCountElement) => {
      const levelNumber = parseInt(levelCountElement.getAttribute('data-szint') || '0', 10);
      levelCountElement.textContent = String(visibleCountByLevel[levelNumber] ?? 0);
    });

    // Elrejtjük azokat a szint-blokkokat, ahol a szűrés után 0 találat maradt.
    levelBlocks.forEach((levelBlock) => {
      const levelNumber = parseInt(levelBlock.getAttribute('data-szint') || '0', 10);
      levelBlock.classList.toggle('hidden', (visibleCountByLevel[levelNumber] ?? 0) === 0);
    });

    // Globális "nincs találat" állapot.
    const hasAnyVisibleRecipe = recipeCards.some((recipeCard) => {
      const levelNumber = cardLevelMap.get(recipeCard) || 0;
      const navAllows = (activeLevelNav === null) || levelNumber === activeLevelNav;
      return navAllows && !recipeCard.classList.contains('hidden');
    });
    if (noResultElement) noResultElement.classList.toggle('hidden', hasAnyVisibleRecipe);

    applyLevelNavVisibility();
  }

  function applyLevelNavVisibility() {
    if (!levelNavButtons.length) return;

    const levelBlocks = getLevelBlocks();
    levelBlocks.forEach((levelBlock) => {
      const levelNumber = parseInt(levelBlock.getAttribute('data-szint') || '0', 10);
      const shouldHide = activeLevelNav !== null && levelNumber !== activeLevelNav;
      levelBlock.style.display = shouldHide ? 'none' : '';
    });
  }

  function updateLevelNavButtonStyles() {
    if (!levelNavButtons.length) return;

    levelNavButtons.forEach((button) => {
      const buttonLevel = parseInt(button.getAttribute('data-szint') || '0', 10);
      const isActive = buttonLevel === activeLevelNav;
      button.setAttribute('aria-pressed', isActive ? 'true' : 'false');

      const pill = selectOne('[data-role="pill"]', button);
      if (!pill) return;

      pill.classList.toggle('bg-white', isActive);
      pill.classList.toggle('text-[#5A7863]', isActive);
      pill.classList.toggle('shadow-md', isActive);
      pill.classList.toggle('bg-transparent', !isActive);
      pill.classList.toggle('text-white/80', !isActive);
      pill.classList.toggle('shadow-none', !isActive);
    });
  }

  function setActiveLevelNav(levelNumber) {
    if (Number.isNaN(levelNumber)) return;
    if (activeLevelNav === levelNumber) {
      activeLevelNav = null;
    } else {
      activeLevelNav = levelNumber;
    }
    updateLevelNavButtonStyles();
    refreshLevelCountsAndBlocks();
  }

  // Események.
  categoryCheckboxes.forEach(categoryCheckbox => categoryCheckbox.addEventListener('change', applyFilters));
  priceCategoryCheckboxes.forEach(priceCheckbox => priceCheckbox.addEventListener('change', applyFilters));
  if (prepTimeSelect) prepTimeSelect.addEventListener('change', applyFilters);

  if (filterResetButton) {
    filterResetButton.addEventListener('click', () => {
      // Minden panel-szűrőt alaphelyzetbe rakunk.
      categoryCheckboxes.forEach(categoryCheckbox => categoryCheckbox.checked = false);
      priceCategoryCheckboxes.forEach(priceCheckbox => priceCheckbox.checked = false);
      if (prepTimeSelect) prepTimeSelect.value = '';

      showAllRecipes();
      refreshActiveFilterCount();
      refreshLevelCountsAndBlocks();
    });
  }

  // Indulás.
  refreshActiveFilterCount();
  refreshLevelCountsAndBlocks();

  if (levelNavButtons.length) {
    levelNavButtons.forEach((button) => {
      button.addEventListener('click', () => {
        const levelNumber = parseInt(button.getAttribute('data-szint') || '0', 10);
        if (Number.isNaN(levelNumber)) return;

        setActiveLevelNav(levelNumber);

        if (activeLevelNav !== null) {
          const targetBlock = document.querySelector(`.szint-blokk[data-szint="${levelNumber}"]`);
          if (targetBlock) {
            targetBlock.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
      });
    });

    if (activeLevelNav !== null) {
      updateLevelNavButtonStyles();
      refreshLevelCountsAndBlocks();
    } else {
      applyLevelNavVisibility();
    }
  } else {
    applyLevelNavVisibility();
  }
});