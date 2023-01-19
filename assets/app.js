/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';


/* Stérilisation Choice */
function manageDateChaleurs() {
    let input_sexe = document.querySelector('input[name="reservation[animal][sexe]"]:checked');
    let input_sterilisation = document.querySelector('input[name="reservation[animal][sterilisation]"]:checked');
    let chaleurs_group = document.querySelector('.chaleurs-group');
    let date_chaleurs = document.getElementById('reservation_animal_dateChaleurs');

    if (input_sexe.value === 'femelle' && input_sterilisation.value == false) {
        chaleurs_group.style.visibility = 'visible';
        date_chaleurs.type = 'text';

    } else {
        chaleurs_group.style.visibility = 'hidden';
        date_chaleurs.type = 'hidden';
    }
}
document.querySelectorAll('input[name="reservation[animal][sexe]"], input[name="reservation[animal][sterilisation]"]').forEach(function (input_reservation) {
    input_reservation.addEventListener('change', function (event) {
        manageDateChaleurs();
    })
})
manageDateChaleurs();

/* Médical Choice */
function manageOrdonnanceFile() {
    let input_medical = document.querySelector('input[name="reservation[animal][medical]"]:checked');
    let file_group = document.querySelector('.file-group');
    let file_input = document.getElementById('reservation_animal_ordonnanceFile');
    let traitement_group = document.querySelector('.traitement-group');
    let traitement_input = document.getElementById('reservation_animal_traitement');

    if (input_medical.value == true) {
        file_group.style.visibility = 'visible';
        file_input.type = 'file';
        traitement_group.style.visibility = 'visible';
        traitement_input.type = 'checkbox';
    } else {
        file_group.style.visibility = 'hidden';
        file_input.type = 'hidden';
        traitement_group.style.visibility = 'hidden';
        traitement_input.type = 'hidden';
    }
}

document.querySelectorAll('input[name="reservation[animal][medical]"]').forEach(function (input_reservation) {
    input_reservation.addEventListener('change', function (event) {
        manageOrdonnanceFile();
    })
})
manageOrdonnanceFile();