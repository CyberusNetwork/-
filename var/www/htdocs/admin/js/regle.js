/**
 * Created by Adrien on 28/01/2015.
 */

function showType (champ){
    // if  (champ.value != ""){
    document.getElementById("typeID").style.display = "";
    // }
}

function showParam (champ){

    if (document.getElementById("regle").value === "quickBlock" || document.getElementById("regle").value === "block") {


        if (document.getElementById("type").value === "all") {

            document.getElementById("paramGodBlockID").style.display = "";
            document.getElementById("paramBlockID").style.display = "none";
            document.getElementById("paramPassID").style.display = "none";
            document.getElementById("paramGodPassID").style.display = "none";
        }
        else {

            document.getElementById("paramGodBlockID").style.display = "none";
            document.getElementById("paramBlockID").style.display = "";
            document.getElementById("paramPassID").style.display = "none";
            document.getElementById("paramGodPassID").style.display = "none";
        }

    }
    else if (document.getElementById("type").value !="all") {

        document.getElementById("paramGodBlockID").style.display = "none";
        document.getElementById("paramBlockID").style.display = "none";
        document.getElementById("paramPassID").style.display = "";
        document.getElementById("paramGodPassID").style.display = "none";
    }
    else {
        document.getElementById("paramGodBlockID").style.display = "none";
        document.getElementById("paramBlockID").style.display = "none";
        document.getElementById("paramPassID").style.display = "none";
        document.getElementById("paramGodPassID").style.display = "";
    }
}