
<style>
    .tp1_modal_container{
        width: fit-content;
        background-color: white;
        padding: 1rem;
        border-radius: 5px;
        position: fixed;
        right:5px;
        bottom:20px;
        opacity: 0;
        transition: ease-in-out .5s;
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

<div class="tp1_modal_container" >
    <form method="post" class="tp1_modal_form" id="tp1_modal_form">

            <h5 class='form_titre'><?php echo esc_html($tp1_settings_modal->form_titre) ?></h5>
            <span class="tp1_modal_close_btn">&times;</span>

        <div class=" tp1_modal_section tp1_modal_first_section">
            <label for="modal_name" class='modal_name'>:</label>
            <input type="text" name="modal_name" id="modal_name">
            <button class='btn_suivant' type="button"></button>
        </div>

        <div class="tp1_modal_section tp1_modal_second_section">
            <label for="modal_email" class='modal_couriel'>:</label>
            <input type="text" name="modal_email" id="modal_email">
            <button class='btn_soumettre' type="submit"></button>
        </div>

    </form>
</div>
    