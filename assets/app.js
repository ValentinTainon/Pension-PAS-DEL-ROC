/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

/* Livre d'or */
let commentaires = document.querySelectorAll(".commentaire-content");
let commentaireIndex = 0;

// Afficher le premier commentaire
if (commentaires[commentaireIndex]) {
    commentaires[commentaireIndex].style.visibility = "visible";
    commentaires[commentaireIndex].style.opacity = 1;

    function manageCommentaires() {
        // Masquer le commentaire actuel
        commentaires[commentaireIndex].style.visibility = "collapse";
        commentaires[commentaireIndex].style.opacity = 0;

        // Passer au commentaire suivant
        commentaireIndex = (commentaireIndex + 1) % commentaires.length;

        // Afficher le commentaire suivant
        commentaires[commentaireIndex].style.visibility = "visible";
        commentaires[commentaireIndex].style.opacity = 1;
    }
    setInterval(manageCommentaires, 5000);
}