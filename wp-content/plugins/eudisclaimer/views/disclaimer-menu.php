<?php 
 
 if (!empty($_POST['message_disclaimer']) && !empty($_POST['url_redirection'])) {

 $text = new DisclaimerOptions(); 
 $text->setMessageDisclaimer(htmlspecialchars($_POST['message_disclaimer'])); 
 $text->setRedirectionko(htmlspecialchars($_POST['url_redirection'])); 

 DisclaimerGestionTable::insererDansTable($text->getMessageDisclaimer(), $text->getRedirectionko()); 

 $message = "Mise à jour bien effectuée";
 }


 $placeholder = DisclaimerGestionTable::getplaceholder()[0];


 ?>

<!-- ["message_disclaimer"]=> string(9) "Ho Ho Ho " ["redirection_ko"]=> string(14) "www.qwant.com" } -->



<h1>EU DISCLAIMER</h1>

<br>

<h2>Configuration</h2>

<p><strong style="color:black"><?php echo @$message; ?></strong></p>

<form method="post" action="" novalidate="novalidate">

    <table class="form-table">
        <tr>
            <th scope="row"><label for="blogname">Message du disclaimer</label></th>
            <td><input name="message_disclaimer" type="text" id="message_disclaimer"value="<?= $placeholder->message_disclaimer?>" class="regular-text" required /></td>
        </tr>
        <tr>
            <th scope="row"><label for="blogname">Url de redirection</label></th>
            <td><input name="url_redirection" type="text" id="url_redirection" value="<?= $placeholder->redirection_ko?>" class="regular-text" required/></td>
        </tr>
    </table>

    <p class="submit"><input type="submit" name="submit" id="submit" class="button btn-outline-primary" value="Enregistrer les modifications"/></p>

</form>

 <br>

<h2>Exemple: La législation nous impose de vous informer sur la nocivité des 
produits à base de nicotine, vous devez avoir plus de 18 ans pour consulter 
ce site !</h2>

<br>

<h4>
Centre AFPA / session DWWM 22239 / 2023-2024
</h4>

<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 
'assets/img/layout_set_logo.jpg'; ?>" width="10%">