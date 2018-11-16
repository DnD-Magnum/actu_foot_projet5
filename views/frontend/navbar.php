<!-- =====  NAVBAR FRONTEND  =====  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?= PATH_PREFIX ?>/">ACTUFOOT<span class="min_title"> suivez l'actualité du foot</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php active('#/$#'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/">Accueil</a>
            </li>
            <li class="nav-item <?php active('#/toutes-les-news#'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/toutes-les-news">Toutes les news</a>
            </li>
            <li class="nav-item dropdown <?php active('/categorie/'); ?>">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php 
                       $categorieManager = new \blogApp\src\model\CategorieManager();
                       $categories = $categorieManager->getCategories();
                       foreach ($categories as $categorie) {
                                echo "<a class='dropdown-item' href='" . PATH_PREFIX . "/categorie/" . urldecode($categorie['name']) . "?id=" . $categorie['id'] . "'>" . $categorie['name'] . "</a>";
                        }
                    ?>
                </div>
            </li>
            <li class="nav-item <?php active('#/contact$#'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/contact">Contact</a>
            </li>
        </ul>
    </div>
</nav> 