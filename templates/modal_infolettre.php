
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
    .tp1_modal_first_section_errors, .tp1_modal_second_section_errors{
        display: flex;
        flex-direction: column;
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
    .tp1_modal_second_section_errors{
        display:none;
    }
    .tp1_modal_third_section{
        display:none;
    }
    .error{
        color:tomato;
        margin:0;
        padding:0;
        /* -webkit-text-stroke: .2px white; */
    }
</style>
 

<?php
    global $wpdb;
    global $tp1_errors;
    $tp1_admin_settings_table_modal = $wpdb->prefix . 'tp1_admin_settings';
    $tp1_settings_modal = $wpdb->get_row("SELECT * FROM $tp1_admin_settings_table_modal WHERE id = 1");
?>

<div class="tp1_modal_container" >
    <form method="POST" class="tp1_modal_form" id="tp1_modal_form" name="tp1_infolettre_form">
        <input type="hidden" name="form_name" value="tp1_infolettre_form">
        
        <h5 class='form_titre'><?php echo esc_html($tp1_settings_modal->form_titre) ?></h5>
        <span class="tp1_modal_close_btn">&times;</span>

        <div class="tp1_modal_first_section_errors">
            <div class=" tp1_modal_section tp1_modal_first_section">
                <label for="modal_name" class='modal_name'>:</label>
                <input type="text" name="modal_name" id="modal_name">
                <button class='btn_suivant' type="button"></button>
            </div>
            <!-- <div><span><?php //(isset($tp1_errors['name_empty']))? $tp1_errors['name_empty'] : '' ?></span></div> -->
             <div><span class=" error error_name"></span></div>
        </div>

        <div class="tp1_modal_second_section_errors">
            <div class="tp1_modal_section tp1_modal_second_section">
                <label for="modal_email" class='modal_couriel'>:</label>
                <input type="text" name="modal_email" id="modal_email">
                <!-- <span><?php //echo $tp1_errors['email_empty'] ?></span> -->
                <!-- <span><?php //echo $errors['email_invalide'] ?></span>  -->
                <button class='btn_soumettre' type="submit"></button>
            </div>
            <div><span class=" error error_email"></span></div>
        </div>
        <div class="thank_you_message tp1_modal_section tp1_modal_third_section">
            <span>Merci de vous être abonné à l'infolettre</span>
        </div>

    </form>
</div>

<?php 
?>
    