<!-- =====  BACKEND // PAGE DE MODéRATION DE COMMENTAIRE SIGNALé  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = ' admin | commentaire'; ?>


<!-- ===  PARTIE MODéRATION  === -->
<h1>Commentaire(s) signalé(s)</h1>

<?php
foreach ($comments as $comment):
?>
	
    <p><strong><?= htmlspecialchars($comment['author']); ?></strong> <em>le <?= $comment['date_commentaire_fr']; ?></em> <span class="badge badge-danger">signalement <?= $comment['signal_count']; ?></span></p>
    <p>Post : <?= $comment['title']; ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
    <form action="<?= PATH_PREFIX ?>/admin/configurecomment?id=<?= $comment['id'] ?>" method="post" class="form-group">
    	<input type="hidden" name="token" id="token" value="<?= $_SESSION['token'] ?>" /> 
    	<button type="button submit" name="nosignal" class="btn btn-outline-dark btn-sm">Enlever signalement</button>
    	<button type="button submit" name="delete" class="btn btn-outline-danger btn-sm">Supprimer le commentaire</button>
    </form>
<?php
endforeach;
?>