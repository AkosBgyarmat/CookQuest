<!-- Zárolt recept visszajelző modal -->
<div id="lockedRecipeFeedbackModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" data-locked-modal-close></div>

    <div class="relative bg-white rounded-3xl shadow-2xl p-10 max-w-lg w-full mx-4 text-center z-10 m-4">
        <button type="button" data-locked-modal-close
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">
            &times;
        </button>

        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 bg-red-100">
            <svg class="h-12 w-12 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m0 3.75h.007v.008H12v-.008zm9-3.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>

        <h2 id="lockedRecipeFeedbackTitle" class="text-2xl font-bold mb-4 text-red-700">Zárolt recept</h2>

        <p id="lockedRecipeFeedbackText" class="text-gray-600"></p>

        <button type="button" data-locked-modal-close
            class="mt-6 w-full bg-[#C0CEB8] text-black font-semibold py-2 px-4 rounded-lg transition">
            OK
        </button>
    </div>
</div>

<script>
(function() {
    const modal = document.getElementById('lockedRecipeFeedbackModal');
    const messageEl = document.getElementById('lockedRecipeFeedbackText');

    if (!modal || !messageEl) {
        return;
    }

    const closeModal = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    window.showLockedRecipeFeedback = function(requiredLevel, requiresLogin) {
        const baseText = 'Előbb érd el a(z) ' + requiredLevel + '. szintet.';
        messageEl.textContent = requiresLogin ?
            baseText + ' Jelentkezz be, hogy haladni tudj a szintekkel.' :
            baseText;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

    modal.querySelectorAll('[data-locked-modal-close]').forEach(function(btn) {
        btn.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
})();
</script>