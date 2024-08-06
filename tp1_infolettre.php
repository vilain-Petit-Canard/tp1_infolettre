<?php
/**
 * Plugin Name: tp1_infolettre
 * Author: Ibrahima Kalil
 * Description: ce plugin sert a avoir un petit formulaire au pied de page ou l'utilisateur peut sair son nom et email, pourrecevoir des nouvelles du site
 * Version: 1.0
 */

//  securiser l'acces du fichier par le front-end
defined( 'ABSPATH' ) || exit();

// constantes
    global $wpdb;
    if(!defined('TP1_ADMIN_SETTINGS')){
        define('TP1_ADMIN_SETTINGS', $wpdb -> prefix . 'tp1_admin_settings');

    }
    if(!defined('TP1_USER_CONTACTS')){
        define('TP1_USER_CONTACTS', $wpdb -> prefix . 'tp1_user_contacts');
    }



// fonction pour activer le plugin tp1_infolettre
function tp1_activation(){
    global $wpdb;
    $admin_settings = $wpdb -> prefix . 'tp1_admin_settings';
    $user_contacts = $wpdb -> prefix . 'tp1_user_contacts';
    $charset_collate = $wpdb -> get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

// creation de la table 'tp1_admin_settings'
    echo TP1_ADMIN_SETTINGS;
    if ( $wpdb->get_var( "SHOW TABLES LIKE ' $admin_settings'" ) != $admin_settings ) {
        $sql_settings = "CREATE TABLE $admin_settings (
            id int NOT NULL AUTO_INCREMENT,
            couleur_fond varchar(50) NOT NULL,
            couleur varchar(50) NOT NULL,
            form_titre varchar(150) NOT NULL,
            form_nom varchar(50) NOT NULL,
            form_couriel varchar(100) NOT NULL,
            btn_suivant varchar(50) NOT NULL,
            btn_soumettre varchar(50) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate";

        dbDelta( $sql_settings);

         // recuperer le contenu de la table
         $deja_initier = $wpdb -> get_results("SELECT * FROM " . $admin_settings);
         // inserer des donnees dans la table si vide
         if(count($deja_initier) == 0){
             $wpdb -> insert($admin_settings, array(
                'couleur_fond' => '#ffffff',
                'couleur' => '#000000',
                'form_titre' => 'Inscrivez-vous à notre infolettre !',
                'form_nom' => 'Nom',
                'form_couriel' => 'Couriel',
                'btn_suivant' => 'Suivant',
                'btn_soumettre' => 'Soumettre',
            ));
         }
    }

        // creation de la table tp1_user_contacts
        if ( $wpdb->get_var( "SHOW TABLES LIKE ' $user_contacts'" ) != $user_contacts ) {
            $sql_contacts = "CREATE TABLE $user_contacts (
            id int NOT NULL AUTO_INCREMENT,
            name varchar(50) NOT NULL,
            email varchar(50) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate";

            dbDelta( $sql_contacts);
        }
   

}
register_activation_hook( __FILE__, 'tp1_activation');


// desactivation et suppression de tables si desactiver
function tp1_deactivation(){
    global $wpdb;
    $admin_settings = $wpdb -> prefix . 'tp1_admin_settings';
    $user_contacts = $wpdb -> prefix . 'tp1_user_contacts';

    $wpdb ->query(" DROP TABLE IF EXISTS $admin_settings");
    $wpdb ->query(" DROP TABLE IF EXISTS $user_contacts");

}
register_deactivation_hook(__FILE__, 'tp1_deactivation');


// fonction pour afficher le menu admin
function tp1_ajouter_menu(){
    add_menu_page(
        'TP1 Infolettre',
        'TP1 Infolettre',
        'manage_options',
        'tp1_infolettre',
        'tp1_infolettre_ajouter_formulaire',
        'dashicons-email-alt2'
    );
}
add_action('admin_menu', 'tp1_ajouter_menu');

// fonction pour rajouter le formulaire du panneau 
function tp1_infolettre_ajouter_formulaire(){
    // include(plugin_dir_path(__FILE__).'templates/modal_infolettre.php');
    include(plugin_dir_path(__FILE__).'templates/admin_formulaire.php');

        // S'il y a un query string nom, ajoute sa valeur à la db
if ( isset( $_POST['couleur_fond'], $_POST['couleur'], $_POST['form_titre'], $_POST['form_nom'], $_POST['form_couriel'], $_POST['btn_suivant'], $_POST['btn_soumettre'] ) ) {
    tp1_ajouter_data(); 
    // Appelle la fonction pour l’appel à la db
    };
    
}

// fonction pour rajouter la donnee de formulaire dans la base de donnees
function tp1_ajouter_data(){
    global $wpdb;
    $couleur_fond = sanitize_text_field($_POST['couleur_fond']);
    $couleur = sanitize_text_field($_POST['couleur']);
    $form_titre = sanitize_text_field($_POST['form_titre']);
    $form_nom = sanitize_text_field($_POST['form_nom']);
    $form_couriel = sanitize_text_field($_POST['form_couriel']);
    $btn_suivant = sanitize_text_field($_POST['btn_suivant']);
    $btn_soumettre = sanitize_text_field($_POST['btn_soumettre']);

    $wpdb -> UPDATE(TP1_ADMIN_SETTINGS, array(
        'couleur_fond' => $couleur_fond,
        'couleur' => $couleur,
        'form_titre' => $form_titre,
        'form_nom' => $form_nom,
        'form_couriel' => $form_couriel,
        'btn_suivant' => $btn_suivant,
        'btn_soumettre' => $btn_soumettre
    ),
    ['id' => 1]
    ); 

};


// rajouter le modal infolettre
function tp1_ajouter_modal(){
    // global $wpdb;
    include(plugin_dir_path(__FILE__).'templates/modal_infolettre.php');
    // global $wpdb;
    // $table_name_test = $wpdb->prefix . 'tp1_admin_settings';
    // $tp1_settings = $wpdb->get_row("SELECT * FROM $table_name_test WHERE id = 1");

}
add_action('wp_footer', 'tp1_ajouter_modal');

// faire un lien rest_api pour que peux utiliser pour la requete que je dois faire dans js
add_action('rest_api_init', function () {
    register_rest_route('tp1_infolettre', '/settings', array(
        'methods' => 'GET',
        'callback' => 'get_admin_settings',
    ));
});
// fonction qui fait la requete pour les donnes settings dans la bd
function get_admin_settings (WP_REST_Request $request) {
    global $wpdb;
    $admin_settings = $wpdb -> prefix . 'tp1_admin_settings';

    $admin_settings_js = $wpdb->get_results("SELECT * FROM $admin_settings");

    return new WP_REST_Response($admin_settings_js, 200);
}
// enregistrer mes scripts et styles
function tp1_enqueue_styles_and_scripts(){
    wp_enqueue_style('tp1_infolettre_main_style', plugin_dir_url(__FILE__).'styles/main_style.css');
    wp_enqueue_script('tp1_infolettre_main_script', plugin_dir_url(__FILE__).'scripts/main_script.js');

     // Localize the main_script script with new data
     wp_localize_script('tp1_infolettre_main_script', 'MyPluginSettings', array(
        'rest_url' => esc_url_raw(rest_url('tp1_infolettre/settings')),
        'nonce'    => wp_create_nonce('wp_rest')
    ));

}
add_action('wp_enqueue_scripts', 'tp1_enqueue_styles_and_scripts');

// adding a script admin side
function tp1_enqueue_styles_and_scripts_admin_side(){
    wp_enqueue_script('tp1_admin_main_script', plugin_dir_url(__FILE__).'scripts/admin_form_script.js');

    // Localize the admin_script script with new data
    wp_localize_script('tp1_admin_main_script', 'MyPluginSettings', array(
        'rest_url' => esc_url_raw(rest_url('tp1_infolettre/settings')),
        'nonce'    => wp_create_nonce('wp_rest')
    ));
}
add_action('admin_enqueue_scripts', 'tp1_enqueue_styles_and_scripts_admin_side');



/**
 * Gestion de la soumission du formulaire côté client
 */
function tp1_nouvelle_inscription() {
    global $wpdb;
    $user_contacts = $wpdb -> prefix . 'tp1_user_contacts';

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        
        if ( !empty( $_POST['modal_name']) && !empty($_POST['modal_email']) ) {

            $modal_name = sanitize_text_field( $_POST['modal_name'] );
            $modal_email = sanitize_email( $_POST['modal_email'] );

            $wpdb->insert( $user_contacts,
                array(
                    'name' => $modal_name,
                    'email' => $modal_email
                ), array(
                    '%s'        // $format (optionnel) => string
                )
            );

            /**
             * Rafraîchi la page pour faire la communication client serveur
             * Détruit la variable spécifiée
             * exit pour stopper l'exécution de la suite du code
             */
            header( "Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
            unset( $_POST );
            exit;
        }
    }
}
add_action( 'init', 'tp1_nouvelle_inscription' );