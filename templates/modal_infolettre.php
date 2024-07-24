
<style>
    .tp1_modal_container{
        width: fit-content;
        background-color: white;
        padding: 1rem;
        border-radius: 5px;
        position: absolute;
        right:10px;
    }
    .tp1_modal_section{
        padding:1rem;
        display:flex;
        align-items:baseline;
        gap:.5rem;
        justify-content:space-between;
    }
    .tp1_modal_close_btn{
        display:flex;
        justify-content:space-between;
    }
    .tp1_modal_form{
        position:relative;
    }
    .tp1_modal_close_btn{
        position:absolute;
        right: 10px;
        top: 0;
        cursor:pointer;
        color:black;
    }
    .tp1_modal_second_section{
        display:none;
    }
</style>

<?php
    global $wpdb;
    $tp1_admin_settings_table_modal = $wpdb->prefix . 'tp1_admin_settings';
    $tp1_settings_modal = $wpdb->get_row("SELECT * FROM $tp1_admin_settings_table_modal WHERE id = 1");
?>

<div class="tp1_modal_container" style="background-color: <?php echo esc_attr($tp1_settings_modal->couleur_fond); ?>; color: <?php echo esc_attr($tp1_settings_modal->couleur); ?>;>
    <form action="" class="tp1_modal_form">

            <h5><?php echo esc_html($tp1_settings_modal->form_titre) ?></h5>
            <span class="tp1_modal_close_btn">&times;</span>

        <div class=" tp1_modal_section tp1_modal_first_section">
            <label for="modal_name"><?php echo esc_html($tp1_settings_modal->form_nom) ?>:</label>
            <input type="text" name="modal_name" id="modal_name">
            <button type="button"><?php echo esc_html($tp1_settings_modal->btn_suivant) ?></button>
        </div>

        <div class="tp1_modal_section tp1_modal_second_section">
            <label for="modal_name"><?php echo esc_html($tp1_settings_modal->form_email) ?>:</label>
            <input type="text" name="modal_email" id="modal_email">
            <button type="submit"><?php echo esc_html($tp1_settings_modal->btn_soumettre); ?></button>
        </div>

    </form>
</div>
    