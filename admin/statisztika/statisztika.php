<?php include "../layout/header.php"; ?>
<?php include "../lekerdezes/statisztika.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Statisztika</h1>
    </header>


    <div class="bg-white rounded-xl shadow-md p-6 w-fit  mt-2"> 
        <h3 class="text-xl font-bold text-center">
            Felhasználók száma országonként
        </h3>
        <div class="w-full max-w-lg h-96">
            <canvas id="myChart"></canvas>
        </div>
        <div class="mt-2  text-center">
            <span class="text-gray-500 italic text-[small]">A legtöbb felhasználó maximum 5 országból.</span>
        </div>
    </div>



    <!-- Chart.js könyvtár betöltése CDN-ről -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart létrehozása a lekérdezett adatokkal -->
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Felhasználók száma országonként',
                    data: <?php echo json_encode($adatok); ?>
                }]
            }
        });
    </script>

</main>

<?php include "../layout/footer.php"; ?>

</div>
</div>