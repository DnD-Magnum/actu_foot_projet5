<!-- =====  FRONTEND // PAGE QUI AFFICHE TOUS LES POSTS  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'Toutes l\'actu | ACTUFOOT'; ?>


<!-- ===  PARTIE POSTS  === -->
<div class="home-page-posts">
<?php
foreach ($posts as $post):
?>
	<div class="col-md-5 col-12 news shadow p-3 mb-5 bg-white rounded">
		<p><strong><a href="<?= PATH_PREFIX_P5 . '/categorie/' . $post['slug'] . '?id=' . $post['id_categorie'] ?>"><?= $post['name'] ?></a></strong></p>
		<h2>
			<a href="<?= PATH_PREFIX_P5 ?>/post?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
		</h2>
		
		<img src="<?= $post['image_path'] ?>" class="img-fluid rounded mx-auto d-block" alt="<?= htmlspecialchars($post['title']); ?>">
			    
		<p class="posts">
			<?php 
			echo truncate($post['post'] , 150, " ...   <a href='" . PATH_PREFIX_P5 . "/post?id=" . $post['id'] . "'><em>( lire la suite )</em></a>"); 
			?>
		</p>
		<p>
			<?= htmlspecialchars($post['author']); ?>
			<em>le <?= $post['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="<?= PATH_PREFIX_P5 ?>/post?id=<?= $post['id'] ?>">Commentaires</a></em>
		</p>
	</div>
<?php
endforeach;
// ===> PAGINATION
?>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
	<?php
	if ($totalPages > 1){
		for ($i = 1; $i <= $totalPages; $i++) { 
			if ($i == $currentPage) {
				echo "<li class='page-item disabled'><a class='page-link' href='#'>" . $i . "</a></li>";
			} else {
				echo "<li class='page-item'><a class='page-link' href='" . PATH_PREFIX_P5 . "/toutes-les-news?page=" . $i . "'> " . $i . " </a></li> ";
			}
		}
	}
	?>
  </ul>
</nav>
