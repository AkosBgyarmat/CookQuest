/* ----------- Segédfüggvény ----------- */

function formatResult(value, decimals = 4) {
    const rounded = parseFloat(value.toFixed(decimals));
    return Number.isInteger(rounded) ? rounded : rounded;
}

function convert(value, from, to, rates) {
    const base = value * rates[from];
    return formatResult(base / rates[to]);
}


/* ---------------- TÖMEG ---------------- */

function tomegValtas() {
    const value = parseFloat(document.getElementById("tomeg1").value);
    if (isNaN(value)) return;

    const from = document.getElementById("tomegHonnan").value;
    const to = document.getElementById("tomegHova").value;

    const rates = {
        gramm: 1,
        dkg: 10,
        kg: 1000,
        oz: 28.3495
    };

    document.getElementById("tomeg2").value =
        convert(value, from, to, rates);
}


/* ---------------- TÉRFOGAT ---------------- */

function terfogatValtas() {
    const value = parseFloat(document.getElementById("terfogat1").value);
    if (isNaN(value)) return;

    const from = document.getElementById("terfogatHonnan").value;
    const to = document.getElementById("terfogatHova").value;

    const rates = {
        ml: 1,
        dl: 100,
        l: 1000,
        tsp: 5,
        tbsp: 15,
        cup: 240
    };

    document.getElementById("terfogat2").value =
        convert(value, from, to, rates);
}


/* ---------------- HŐMÉRSÉKLET ---------------- */

function homersekletValtas() {
    const value = parseFloat(document.getElementById("homerseklet1").value);
    if (isNaN(value)) return;

    const from = document.getElementById("homersekletHonnan").value;
    const to = document.getElementById("homersekletHova").value;

    let result;

    if (from === "C" && to === "F") {
        result = (value * 9/5) + 32;
    } else if (from === "F" && to === "C") {
        result = (value - 32) * 5/9;
    } else {
        result = value;
    }

    document.getElementById("homerseklet2").value =
        formatResult(result);
}


/* ---------------- IDŐ ---------------- */

function idoValtas() {
    const value = parseFloat(document.getElementById("ido1").value);
    if (isNaN(value)) return;

    const from = document.getElementById("idoHonnan").value;
    const to = document.getElementById("idoHova").value;

    const rates = {
        ora: 60,
        perc: 1
    };

    document.getElementById("ido2").value =
        convert(value, from, to, rates);
}