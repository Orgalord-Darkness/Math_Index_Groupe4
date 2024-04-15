document.addEventListener("DOMContentLoaded", function() {
    let connexionNormal = document.getElementById("connexion_normal");
    let popUp = document.getElementById("pop_up");
    let etat = 0;
    
    connexionNormal.addEventListener("click", function() {
        if (etat === 0) {
            popUp.style.display = "flex";
            popUp.style.opacity = "1";
            etat = 1; 
        } else {
            popUp.style.display = "none";
            popUp.style.opacity = "0";
            etat = 0; 
        }
    });
});

