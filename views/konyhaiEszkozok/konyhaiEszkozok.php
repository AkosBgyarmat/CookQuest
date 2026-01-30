<?php include "../head.php"; ?>

<section class=" mx-auto max-w-[2000px] min-w-[280px] py-8 px-4 
    sm:px-8 
    md:px-10 
    lg:0px-20 ">

    <div class="w-full mb-2 mt-2 rounded-[50px] bg-[#EBF4DD] py-6 flex flex-col items-center px-2
        sm:rounded-[60px] sm:py-9 sm:px-4
        md:rounded-[70px] md:py-11 md:px-8
        lg:rounded-[80px] lg:flex-row lg:py-14      
        xl:px-16">

        <img class="w-full max-w-[280px] rounded-[50px] ml-0
            sm:max-w-[320px] 
            md:max-w-[360px] 
            lg:max-w-[400px] lg:ml-6 lg:order-2
            xl:max-w-[410px]"
            src="../../assets/kepek/KonyhaiEszközök.jpg" alt="Konyhai eszközök kép" title="Konyhai eszközök kép">

        <div class="text-center md:text-left">

            <h1 class="text-xl leading-[30px] font-bold mb-6
                md:text-4xl md:leading-[40px] md:mb-12
                lg:text-5xl lg:leading-[50px]">
                Fedezd fel a konyhai eszközök világát!
            </h1>

            <p class="text-md leading-[27px]  font-normal mb-8
                md:mb-12
                sm:text-[24px]"> 
                Praktikus, innovatív és stílusos megoldások minden háztartásba – nézd meg, melyik eszköz lehet a te konyhád legjobb segítője.
            </p>

            <button class="w-full max-w-[350px] text-xl font-bold rounded-[38px] bg-[#90AB8B] text-white py-4 px-6 sm:px-9">
                <a href="#konyhaiEszkozok" class="flex items-center justify-between w-full">
                    <span>Kezdjünk hozzá!</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" height="20px" width="20px" viewBox="0 0 330 330">
                        <path d="M15,180h263.787l-49.394,49.394c-5.858,5.857-5.858,15.355,0,21.213C232.322,253.535,236.161,255,240,255 s7.678-1.465,10.606-4.394l75-75c5.858-5.857,5.858-15.355,0-21.213l-75-75c-5.857-5.857-15.355-5.857-21.213,0 c-5.858,5.857-5.858,15.355,0,21.213L278.787,150H15c-8.284,0-15,6.716-15,15S6.716,180,15,180z" />
                    </svg>
                </a>
            </button>

        </div>

    </div>

</section>

<!-- Rész, amiben minden konyhai eszköz tárolódik -->
<section id="konyhaiEszkozok" class="max-w-full min-w-[280px] py-8 px-4 sm:px-8 md:px-10 lg:px-20 bg-[#EBF4DD]">
    <div class="flex flex-wrap justify-center gap-6">
        
        <!-- Kártya  -->
        <div class="flex flex-col lg:flex-row max-w-xl w-full bg-white rounded-[20px] shadow-md overflow-hidden">
            
            <!-- Kép a konyhai eszközről -->
            <div class="w-full lg:w-2/5">
                <img src="https://i.ibb.co/7ztJFPH/image-product-desktop.jpg" alt="" class="w-full h-auto object-cover" />
            </div>

            <!-- Leírás a konyhai eszközről -->
            <div class="w-full lg:w-3/5 p-6 flex flex-col justify-center space-y-4">
                <p class="border rounded-[50px] border-black w-fit px-2 py-1 text-sm">kategoria</p>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Elnevezes</h1>
                <p class="text-justify text-sm sm:text-base">Leiras</p>
            </div>

        </div>

        <!-- Kártya  -->
        <div class="flex flex-col lg:flex-row max-w-xl w-full bg-white rounded-[20px] shadow-md overflow-hidden">
            
            <!-- Kép a konyhai eszközről -->
            <div class="w-full lg:w-2/5">
                <img src="https://i.ibb.co/7ztJFPH/image-product-desktop.jpg" alt="" class="w-full h-auto object-cover" />
            </div>

            <!-- Leírás a konyhai eszközről -->
            <div class="w-full lg:w-3/5 p-6 flex flex-col justify-center space-y-4">
                <p class="border rounded-[50px] border-black w-fit px-2 py-1 text-sm">kategoria</p>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Elnevezes</h1>
                <p class="text-justify text-sm sm:text-base">Leiras</p>
            </div>
        
        </div>
    </div>
</section>


<?php include "../footer.php"; ?>