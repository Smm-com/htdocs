
if(lireUnCookie('eu-disclaimer-vapobar') != "ejD86j7ZXF3x"){ 

    $("#monModal").modal({
        escapeClose: false, 
        clickClose: false, 
        showClose: false
        
});
}

function creerUnCookie(nomCookie, valeurCookie, dureeJours){ 
     // Si le nombre de jours est spécifié
     if(dureeJours){ 
        var date = new Date(); 
        
        // Converti le nombre de jours spécifiés en millisecondes
        date.setTime(date.getTime() + (dureeJours * 24 * 60 * 60 * 1000 )); 
        var expire = "; expire="+date.toGMTString(); 
     } 
     // Si aucune valeur n'est spécifiée 
    else
     var expire = ""; 

     document.cookie = nomCookie + "=" + valeurCookie + expire + "; path=/"; } 


     function lireUnCookie(nomCookie){ 
    
     // Tableau contenant tous les cookies 
       nomFormate = nomCookie + "=";
      
    // Recherche du cookie dans le tableau
       var tableauCookies = document.cookie.split(';');

       for(var i=0; i < tableauCookies.length; i++) { 
            var cookieTrouve = tableauCookies[i]; 
            
            // Suppression des espaces
            while (cookieTrouve.charAt(0) == ' ') { 
                cookieTrouve = cookieTrouve.substring(1, cookieTrouve.length); 
                } 
                if (cookieTrouve.indexOf(nomFormate) == 0){ 
            return cookieTrouve.substring(nomFormate.length, cookieTrouve.length); 
                } 
        } 
        // Retourne une valeur nulle si aucun cookie trouvé
        return null; 
    } 

        // Création d'une fonction associée au bouton Oui de la modale
        function accepterLeDisclaimer(){ 

            creerUnCookie('eu-disclaimer-vapobar', "ejD86j7ZXF3x", 1); 

            var cookie = lireUnCookie('eu-disclaimer-vapobar'); 
        } 