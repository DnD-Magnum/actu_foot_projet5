<!-- =====  BACKEND // PAGE D'ACCUEIL PARTIE ADMIN  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'ACTUFOOT | ADMIN'; ?>


<!-- ===  LISTE DE TOUS LES POTS  === -->
<?php
foreach ($posts as $post):
?>
	<div>
		<h2>
			<a href="<?= PATH_PREFIX ?>/admin/modifier-post?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
		</h2>
			    
		<p class="chapter">
			<?= $post['post']; ?>
		</p>
		<p>
			<?= htmlspecialchars($post['author']); ?>
			<em>le <?= $post['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="<?= PATH_PREFIX ?>/admin/modifier-post?id=<?= $post['id'] ?>">Modifier / suprimer post | moderer commentaire</a></em>
		</p>
	</div>
<?php
endforeach;
// ===> PAGINATION
?>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
	<?php
	if ($totalPages > 1){
		for ($i = 1; $i <= $totalPages; $i++) { 
			if ($i == $currentPage) {
				echo "<li class='page-item disabled'><a class='page-link' href='#'>" . $i . "</a></li>";
			} else {
				echo "<li class='page-item'><a class='page-link' href='" . PATH_PREFIX . "/admin?page=" . $i . "'> " . $i . " </a></li> ";
			}
		}
	}
	?>
  </ul>
</nav>