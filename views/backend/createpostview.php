<!-- =====  BACKEND // PAGE DE CREATION DE NOUVEAU CHAPITRE  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'admin | Ecrire nouveau post'; ?>


<!-- ===  PARTIE CREATION  === -->
<h1>Editer nouveau post</h1>

<form action="<?= PATH_PREFIX ?>/admin/newpost?token=<?= $_SESSION['token'] ?>" method="post" enctype="multipart/form-data" class="form-group">
	<p>Catégorie :</p>
	<?php
	foreach ($categories as $categorie) :
	?>
	<div class="form-check">
	    <input class="form-check-input" type="radio" name="categorie_radio" id="<?= $categorie['name'] ?>" value="<?= $categorie['id'] ?>">
	    <label class="form-check-label" for="<?= $categorie['name'] ?>">
	    	<?= $categorie['name'] ?>
	    </label>
	</div>
	<?php
	endforeach;
	?>
	<div class="form-check">
	    <input class="form-check-input" type="radio" name="categorie_radio" id="autre" value="autre">
	    <label class="form-check-label" for="autre">
	        creer autre :
	    </label>
	</div>
	<input type="text" id="autre_text" name="autre_text" class="form-control col-md-3"/>
	<label for="title" class="label_margin">Titre du post</label> : <input type="text" id="title" name="title" class="form-control col-md-3" placeholder="Ex : Chapitre 1 , 2 . . ." required/><br/>
	<label for="picture">Ajouter une photo :</label>
    <input type="file" class="form-control-file col-md-4" name="picture" id="picture" required>
	<label class="label_margin">Contenu</label> :  <textarea name="content" class="tiny-area form-control col-md-12" id="content" required>
	</textarea><br/>
	<input type="hidden" name="author" value="<?= $_SESSION['connect'][0] ?>">
	<?php \blogApp\core\Csrf::generateInput(); ?>
	<button type="button submit" name="save" id="new-post" class="btn btn-outline-dark">Publier</button>
</form>