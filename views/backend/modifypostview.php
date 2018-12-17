<!-- =====  BACKEND // PAGE MODIFICATION CHAPITRE ET MODERATION DE SES COMMENTAIRES  =====  -->

<!-- ===  TITRE ENTETE  === -->
<?php $title = ' admin | Modifier post'; ?>


<!-- ===  PARTIE CHPITRE  === -->
<h1>Modifier post</h1>

<form action="<?= PATH_PREFIX_P5 ?>/admin/configurepost?id=<?= $post['id'] ?>&token=<?= $_SESSION['token'] ?>" method="post" enctype="multipart/form-data" class="form-group">

	<p>Catégorie :</p>
	<select name="categorie_radio">
		<option value="">Sélectionner une catégorie ...</option>
		<?php foreach ($categories as $categorie) : ?>
			<option value="<?= $categorie['id'] ?>" <?php selected($post['name'], $categorie['name']); ?>><?= $categorie['name'] ?></option>
		<?php endforeach; ?>
	</select>
	<div class="form-check">
	    <input class="form-check-input" type="checkbox" name="categorie_radio" id="autre" value="autre">
	    <label class="form-check-label" for="autre">
	        creer autre :
	    </label>
	</div>
	<input type="text" id="autre_text" name="autre_text" class="form-control col-md-3"/>
	<label for="title" class="label_margin">Titre du post</label> : <input type="text" id="title" name="title" value="<?= $post['title']; ?>" class="form-control col-md-3" placeholder="Ex : Chapitre 1 , 2 . . ." required/><br/>
	<label for="picture">Modifier photo :</label>
    <input type="file" class="form-control-file col-md-4" id="picture" name="picture">
	<label class="label_margin">Contenu</label> :  <textarea name="content" class="tiny-area form-control col-md-12" id="content" required>
		<?= $post['post']; ?>
	</textarea><br/>
	<?php \blogApp\core\Csrf::generateInput(); ?>
	<button type="button submit" name="modify" class="btn btn-outline-dark">Modifier</button>
	<button type="button submit" name="delete" class="btn btn-outline-danger">Supprimer</button>
</form>


<!-- ===  PARTIE COMMENTAIRE  === -->
<h2>Commentaires</h2>

<?php
foreach ($comments as $comment):
?>
    <p><strong><?= htmlspecialchars($comment['author']); ?></strong> <em>le <?= $comment['date_commentaire_fr']; ?></em> <span class="badge badge-danger">signalement <?= $comment['signal_count']; ?></span></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
    <form action="<?= PATH_PREFIX_P5 ?>/admin/configurecomment?id=<?= $comment['id'] ?>" method="post" class="form-group">
    	<?php \blogApp\core\Csrf::generateInput(); ?>
    	<button type="button submit" name="nosignal" class="btn btn-outline-dark btn-sm">Enlever signalement</button>
    	<button type="button submit" name="delete" class="btn btn-outline-danger btn-sm">Supprimer le commentaire</button>
    </form>
<?php
endforeach;
if ($totalPages > 1) {
	for ($i = 1; $i <= $totalPages; $i++) { 
		if ($i == $currentPage) {
			echo $i;
		} else {
			echo "<a href='" . PATH_PREFIX_P5 . "/admin/modifier-post?id=" . $post['id'] . "&page=" . $i . "'> " . $i . " </a> ";
		}
	}
}
?>