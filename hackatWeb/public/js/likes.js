var leLien = document.querySelector("[data-like-url]");
console.log(leLien);
// Boucler sur chaque lien et ajoute un event listener

leLien.addEventListener("click", function (event) {
    event.preventDefault(); // Empêche de suivre le lien

    /* On récupère l'URL du lien qui se trouve dans le data attribute*/
    let url = leLien.dataset.likeUrl;
    console.log(url)
    //On initialise notre requête avec open()
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP ! Statut : ${response.status}`);
            }
            return response.json(); // Convertit la réponse en JSON (renvoie aussi une promesse)
        })
        .then(data => {
            console.log(data); // Affiche les données récupérées
            console.log(data.vrai)
            console.log(leLien)
            // Supposons que "data.vrai" soit récupéré via une requête AJAX ou une autre source
            if (data.vrai == "supp") {
                console.log("suppression ok")
                console.log(leLien)
                leLien.textContent="Mettre en favoris"
                leLien.dataset.likeUrl="/hackatWeb/hackatWeb/public/index.php/addFavori/"+ data.idHackathon +"/favori"
            } else {
                console.log("Ajout Ok")
                console.log(leLien)
                leLien.textContent="Supprimer des favoris"
                leLien.dataset.likeUrl="/hackatWeb/hackatWeb/public/index.php/suppFavoris/"+ data.idHackathon +"/supp"
            }
          


        })

        .catch(error => {
            console.error("Une erreur s'est produite :", error);
        })

});

