<?php
// fichier de desinstallation du plugin
// pour que la table de donnee dans la bd soit supprimée à la désinstallation

if(!defined('WP_UNINSTALL_PLUGIN')){
    die;
}

global $wpdb;
$admin_settings = $wpdb -> prefix . 'tp1_admin_settings';
    $user_contacts = $wpdb -> prefix . 'tp1_user_contacts';

    $wpdb ->query(" DROP TABLE IF EXISTS $admin_settings");
    $wpdb ->query(" DROP TABLE IF EXISTS $user_contacts");