// pour le button suivant et faire apparaitre le formulaire sur scroll down
document.addEventListener('DOMContentLoaded', function test () {
    const form = document.querySelector('.tp1_modal_container');
    const btn_close = document.querySelector('.tp1_modal_close_btn');
    const btn_suivant = document.querySelector('.btn_suivant');
    const second_section = document.querySelector('.tp1_modal_second_section');
    const first_section = document.querySelector('.tp1_modal_first_section');

    // boutonsuivant
    btn_suivant.addEventListener('click', ()=>{
        first_section.style.display = 'none';
        second_section.style.display = 'block';
    })
    // apparition formulaire
    document.addEventListener('scrollend', ()=>{

        // niveau du scroll
        const scrollPosition = window.scrollY + window.innerHeight + 110;

        // taille totale du document
        const documentHeight = document.documentElement.scrollHeight;
        // apparition et disparition du formulaire
        (scrollPosition >= documentHeight)? form.style.opacity = '100%' : form.style.opacity = '0';
        // fermeture du fomulaire avec le button x
        btn_close.addEventListener('click', ()=>{
            form.style.display = 'none';
        })
    
    })


   
})
//    test();

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
        // Mettez à jour le formulaire avec les données récupérées
        updateForm(admin_settings);
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}

// updating form data
function updateForm(data) {
    
    const couleur_fond = document.querySelector('.tp1_modal_container').style.background = data[0].couleur_fond;
    const couleur = document.querySelector('.tp1_modal_container').style.color = data[0].couleur;
    const form_titre = document.querySelector('.form_titre').textContent = data[0].form_titre;
    const form_nom = document.querySelector('.modal_name').textContent = data[0].form_nom;
    const form_couriel = document.querySelector('.modal_couriel').textContent = data[0].form_couriel;
    const btn_suivant = document.querySelector('.btn_suivant').textContent = data[0].btn_suivant;
    const btn_soumettre = document.querySelector('.btn_soumettre').textContent = data[0].btn_soumettre;
    
// console.log(data);
}

document.addEventListener('DOMContentLoaded', fetchAdminData);