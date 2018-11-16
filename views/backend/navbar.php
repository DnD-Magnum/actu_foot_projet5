<!-- =====  NAVBAR BACKEND  =====  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?= PATH_PREFIX ?>">ACTUFOOT<span class="min_title"> suivez l'actualité du foot</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php active('#/admin$#'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/admin">Administration</a>
            </li>
            <li class="nav-item <?php active('#/admin/editer-post$#'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/admin/editer-post">Editer post</a>
            </li>
            <li class="nav-item <?php active('#/admin/comment$#'); ?>">
                <a class="nav-link" href="<?= PATH_PREFIX ?>/admin/comment">Commentaires</a>
            </li>
        </ul>
    </div>
</nav> 