<!-- =====  TEMPLATE  BACKEND  =====  -->
<!DOCTYPE html>
<html>
    <head>
        <!-- === META & LINK ===  -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="<?= PATH_PREFIX_P5; ?>/public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <!-- === NAVBAR ===  -->

        <?php include('navbar.php')?>
        

        <!-- === CONTENU ===  -->

        <div class="block_page">
            <!--  Message d'alerte  -->
            <?php
            \blogApp\core\MessageAlert::verifySessionAlert();
            \blogApp\core\MessageAlert::destroyMessage();
            ?>
            
            <!--  Boutton deconexion  -->  
            <?php 
                if (isset($_SESSION['connect'])) {
                    echo "<p><a href='" . PATH_PREFIX_P5 . "/deconnexion'>Déconnexion</a></p>";
                }
            ?>
            
            <!--  Contenu  --> 
            <?= $content ?>
        </div>


        <!-- === SCRIPT ===  -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=psn53gxcft0i69plte6ewknlnv9gkoblqqf0hldcdabgk05v"></script>
        <script type="text/javascript" src="<?= PATH_PREFIX_P5; ?>/public/js/TinyMce.js"></script>
    </body>
</html>