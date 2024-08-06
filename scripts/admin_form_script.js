// console.log('yo');


 // fetch the data
 async function fetchAdminData(){
    console.log(window.location.href);
    try {
        const response = await fetch(MyPluginSettings.rest_url);
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const admin_settings = await response.json();
        // console.log(admin_settings);
        // Mettre à jour le formulaire avec les données récupérées
        updateForm(admin_settings);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}

// updating form data 
function updateForm(data) {
    
    const couleur_fond = document.querySelector('#couleur_fond').value = data[0].couleur_fond;
    const couleur = document.querySelector('#couleur').value = data[0].couleur;
    const form_titre = document.querySelector('#form_titre').value = data[0].form_titre;
    const form_nom = document.querySelector('#form_nom').value = data[0].form_nom;
    const form_couriel = document.querySelector('#form_couriel').value = data[0].form_couriel;
    const btn_suivant = document.querySelector('#btn_suivant').value = data[0].btn_suivant;
    const btn_soumettre = document.querySelector('#btn_soumettre').value = data[0].btn_soumettre;
    
}
document.addEventListener('DOMContentLoaded', fetchAdminData);