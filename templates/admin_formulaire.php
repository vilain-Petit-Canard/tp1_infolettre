<style>
    .tp1_container{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    .tp1_form_row{
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        gap: 5rem;
        margin-bottom: 1rem;
    }
    .tp1_btn_div{
        text-align: center;
        margin-top: 2rem;
    }
    .tp1_btn_submit{ 
        padding: .5rem 1rem .5rem 1rem;
    }
    .email_list_container{
        display:flex;
        flex-direction:column;
        align-items:center;
        max-height:300px;
        max-width:500px;
        width:1000px;
        overflow-y:auto;
     }  
    table{
        border-collapse: collapse;
        width: 100%;
    }
    th,td{
        border: 1px solid black;
        padding: 1rem;
        text-align:center;
    }
</style>

<?php 
    global $wpdb;
    $admin_settings_table = $wpdb -> prefix . 'tp1_admin_settings';
    $admin_settings = $wpdb->get_row("SELECT * FROM $admin_settings_table WHERE id = 1");
    $user_emails_table = $wpdb -> prefix . 'tp1_user_contacts';
    $user_emails = $wpdb -> get_results("SELECT * FROM $user_emails_table");

?>
<div class='tp1_container'>
    <h1 class=''><?php echo get_admin_page_title(); ?></h1>

    <form class='tp1_infolettre_form' action="" method='POST' id="tp1_infolettre_form">
        <div class="tp1_form_row">
            <label for="couleur_fond">Couleur de fond</label>
            <input type="color" name="couleur_fond" id="couleur_fond" >
        </div>
        <div class="tp1_form_row">
            <label for="couleur">Couleur</label>
            <input type="color" name="couleur" id="couleur">
        </div>
        <div class="tp1_form_row">
            <label for="form_titre">Titre</label>
            <input type="text" name="form_titre" id="form_titre">
        </div>
        <div class="tp1_form_row">
            <label for="form_nom">intitulé 'Nom'</label>
            <input type="text" name="form_nom" id="form_nom" >
        </div>
        <div class="tp1_form_row">
            <label for="form_couriel">intitulé 'Couriel'</label>
            <input type="text" name="form_couriel" id="form_couriel" >
        </div>
        <div class="tp1_form_row">
            <label for="btn_suivant">Bouton 'Suivant'</label>
            <input type="text" name="btn_suivant" id="btn_suivant" >
        </div>
        <div class="tp1_form_row">
            <label for="btn_soumettre">Bouton 'Soumettre'</label>
            <input type="text" name="btn_soumettre" id="btn_soumettre" >
        </div>
        <div class="tp1_btn_div">
        <button class="tp1_btn_submit" type="submit">Enregistrer</button>

        </div>
    </form>
    <?php if(!empty($user_emails)) { ?>
        <h2>USER EMAIL LIST</h2>
        <div class="email_list_container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($user_emails as $user_email){ ?>
                    <tr>
                        <td><?php echo $user_email-> id ?></td>
                        <td><?php echo $user_email-> name ?></td>
                        <td><?php echo $user_email-> email ?></td>
                    </tr>
            <?php }
                ?>
            </tbody>
        </table>
    </div>
    <?php }else{ 
        echo "<h2> Aucun utilisateur enregistré! </h2>";
        }  ?>
</div>
