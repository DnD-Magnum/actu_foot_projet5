<!-- =====  BACKEND // PAGE DE CREATION DE NOUVEAU CHAPITRE  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'admin | Ecrire nouveau post'; ?>


<!-- ===  PARTIE CREATION  === -->
<h1>Editer nouveau post</h1>

<form action="<?= PATH_PREFIX ?>/admin/newpost?token=<?= $_SESSION['token'] ?>" method="post" class="form-group">
	<label for="title">Titre du post</label> : <input type="text" id="title" name="title" class="form-control col-md-3" placeholder="Ex : Chapitre 1 , 2 . . ." required/><br/>
	<label>Contenu</label> :  <textarea name="content" class="tiny-area form-control col-md-12" id="content" required>
	</textarea><br/>
	<input type="hidden" name="author" value="<?= $_SESSION['connect'][0] ?>">
	<?php \blogApp\core\Csrf::generateInput(); ?>
	<button type="button submit" name="save" id="new-post" class="btn btn-outline-dark">Publier</button>
</form>