<!-- =====  FRONTEND // PAGE QUI AFFICHE TOUS LES POSTS D'UNE CATéGORIE  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = $categorie['name'] . ' | ACTUFOOT'; ?>


<!-- ===  PARTIE POSTS  === -->
<?php
foreach ($posts as $post):
?>
	<div class="news shadow p-3 mb-5 bg-white rounded">
		<p><strong><a href="<?= PATH_PREFIX . '/categorie/' . $categorie['name'] . '?id=' . $categorie['id'] ?>"><?= $categorie['name'] ?></a></strong></p>
		<h2>
			<a href="<?= PATH_PREFIX ?>/post?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
		</h2>
		
		<img src="<?= PATH_PREFIX . '/' .  $post['image_path'] ?>" class="img-fluid rounded mx-auto d-block" alt="<?= htmlspecialchars($post['title']); ?>">
			    
		<p class="posts">
			<?php 
				echo truncate($post['post'] , 350, " ...   <a href='" . PATH_PREFIX . "/post?id=" . $post['id'] . "'><em>( lire la suite )</em></a>"); 
			?>
		</p>
		<p>
			<?= htmlspecialchars($post['author']); ?>
			<em>le <?= $post['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="<?= PATH_PREFIX ?>/post?id=<?= $post['id'] ?>">Commentaires</a></em>
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
				echo "<li class='page-item'><a class='page-link' href='" . PATH_PREFIX . "/categorie/" . $categorie['name'] . "?id=" . $categorie['id'] . "&page=" . $i . "'> " . $i . " </a></li> ";
			}
		}
	}
	?>
  </ul>
</nav>