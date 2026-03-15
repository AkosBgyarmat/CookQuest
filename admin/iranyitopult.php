<?php include "layout/header.php"; ?>
<?php include "layout/oldalmenu.php";
//var_dump($_SESSION);
?>
<?php require_once "lekerdezes/statisztika.php"; ?>

<main class="flex-1 p-10">
    <header class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold mb-8">Irányító pult</h1>
    </header>

    <div class="grid grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Receptek</p>
            <h2 class="text-3xl font-bold"><?php echo $receptek; ?></h2>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">Felhasználók</p>
            <h2 class="text-3xl font-bold"><?php echo $felhasznalok; ?></h2>
        </div>

        <div class="bg-white p-6 rounded shadow" ng-controller="eszkozController">
            <p class="text-gray-500">Konyhaifelszereles</p>
            <h2 class="text-3xl font-bold">{{eszkozok.length}}</h2>
        </div>

    </div>

</main>

<?php include "layout/footer.php"; ?>

