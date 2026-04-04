<!-- Visszajelzés modal -->
<div ng-if="feedbackMessage"
     class="fixed inset-0 z-50 flex items-center justify-center">

  <!-- háttér -->
  <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
       ng-click="closeFeedbackMessage()">
  </div>

  <div class="relative bg-white rounded-3xl shadow-2xl p-10 max-w-lg w-full mx-4 text-center z-10 m-4">

    <!-- X -->
    <button ng-click="closeFeedbackMessage()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">
      &times;
    </button>

    <!-- IKON -->
    <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6"
         ng-class="feedbackSuccess ? 'bg-green-100' : 'bg-red-100'">

      <svg ng-if="feedbackSuccess"
           class="h-12 w-12 text-green-600"
           xmlns="http://www.w3.org/2000/svg"
           fill="none"
           viewBox="0 0 24 24"
           stroke-width="1.5"
           stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
      </svg>

      <svg ng-if="!feedbackSuccess"
           class="h-12 w-12 text-red-600"
           xmlns="http://www.w3.org/2000/svg"
           fill="none"
           viewBox="0 0 24 24"
           stroke-width="1.5"
           stroke="currentColor">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 9v3.75m0 3.75h.007v.008H12v-.008zm9-3.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
      </svg>

    </div>

    <h2 class="text-2xl font-bold mb-4"
        ng-class="feedbackSuccess ? 'text-green-700' : 'text-red-700'">

      {{ feedbackSuccess ? 'Sikeres!' : 'Hiba!' }}

    </h2>

    <p class="text-gray-600">

      {{ feedbackText }}

    </p>

    <button ng-click="closeFeedbackMessage()"
            class="mt-6 w-full bg-[#C0CEB8] text-black font-semibold py-2 px-4 rounded-lg transition">
      OK
    </button>

  </div>
</div>


<div ng-if="confirmModal"
     class="fixed inset-0 z-50 flex items-center justify-center">

    <!-- háttér -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         ng-click="confirmCancel()"></div>

    <div class="relative bg-white rounded-2xl shadow-xl p-6 max-w-sm w-full text-center z-10 m-4">

        <h2 class="text-lg font-bold mb-4">Megerősítés</h2>

        <p class="mb-6 text-gray-600">{{confirmText}}</p>

        <div class="flex justify-center gap-4">
            <button ng-click="confirmCancel()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Mégse
            </button>

            <button ng-click="confirmOk()"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Igen
            </button>
        </div>

    </div>
</div>