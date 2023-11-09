<?php

//définition du chemin d'accès à la classe DisclaimerOptions
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); 
include( MY_PLUGIN_PATH . '../entity/DisclaimerOptions.php'); 

class DisclaimerGestionTable {

    public function creerTable() { 

        // Instanciation de la classe DisclaimerOption
        $message = new DisclaimerOptions(); 
        // $message = new DisclaimerOptions(0, "Au regard de la loi européenne, 
        // vous devez nous confirmer que vous avez plus
        // de 18 ans pour visiter ce site ?", "https://www.qwant.com/");
        
        // On alimente l'objet du message
        $message->setMessageDisclaimer(
            "Au regard de la loi européenne, 
            vous devez nous confirmer que vous avez plus
            de 18 ans pour visiter ce site - Merci de votre compréhension"); 

        $message->setRedirectionko("https://www.qwant.com/"); 
        global $wpdb; 

        $tableDisclaimer = $wpdb->prefix.'disclaimer_options'; 

        
        if ($wpdb->get_var("SHOW TABLES LIKE $tableDisclaimer") !=$tableDisclaimer) { 
        // La table n'existe pas déjà
            $sql = "CREATE TABLE $tableDisclaimer

            (id_disclaimer INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            message_disclaimer TEXT NOT NULL, 
            redirection_ko TEXT NOT NULL)
            ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
            COLLATE=utf8mb4_unicode_ci;"; 

            // Message d'erreur
            if (!$wpdb->query($sql)) {
                die("Une erreur est survenue, contactez le développeur du plugin..."); 
            } 
            
            // C'est bon
            $wpdb->insert( 
                $wpdb->prefix . 'disclaimer_options',
                array('message_disclaimer' => $message->getMessageDisclaimer(),
                    // 'message_disclaimer' => 'Message01',
                    'redirection_ko' => $message->getRedirectionko() 
                    // 'redirection_ok' => 'URL01'
                ), 
                array('%s', '%s') 
            ); 
            // $wpdb->query($sql);
        } 
    } 

    public function supprimerTable() { 

        global $wpdb; 
        $table_disclaimer = $wpdb->prefix . "disclaimer_options"; 
        $sql = "DROP TABLE $table_disclaimer"; 

        $wpdb->query($sql); 
    }


    static function insererDansTable($contenu, $url) { 

        global $wpdb; 
        $table_disclaimer = $wpdb->prefix.'disclaimer_options'; 
        $sql = $wpdb->prepare( 
        "UPDATE $table_disclaimer SET message_disclaimer = '%s', redirection_ko = '%s' WHERE id_disclaimer = '%s'", $contenu, $url, 1); 

        $wpdb->query($sql); 
    }

    static public function getplaceholder() {

        global $wpdb;
        $table_disclaimer = $wpdb->prefix.'disclaimer_options'; 

        return $wpdb->get_results( "SELECT * FROM $table_disclaimer;" );
    }

    static function AfficherDonneModal() { 

        global $wpdb; 

        $query = "SELECT * from " . $wpdb->prefix."disclaimer_options"; 

        $row = $wpdb->get_row($query); 

        $message_disclaimer = $row->message_disclaimer; 

        $lien_redirection = $row->redirection_ko; 

        // echo '<div id="monModal" class="modal">
        return '<div id="monModal" class="modal">

                <p>Bienvenue au Vapobar ! </p>

                <p>'. $message_disclaimer . '</p>
                
                <a href="' . $lien_redirection . '" type="button" class="btn-red">Non</a>

                <a href="#" type="button" rel="modal:close" class="btn-green" onclick="accepterLeDisclaimer()">Oui</a> 

                </div>'; 
        }

    
}

?>