<!-- =====  FRONTEND // PAGE QUI AFFICHE TOUS LES POSTS  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'Acceuil | ACTUFOOT Les news'; ?>

<!-- === PARTIE POSTS RéCENT  === -->
<div class="home-page-posts">
	<?php
	foreach ($posts as $nbP => $post):
	?>
	
		<div class="<?php if($nbP != 0): ?>col-md-5<?php endif; ?> col-12 news shadow p-3 mb-5 bg-white rounded">
			<p><strong><a href="<?= PATH_PREFIX_P5 . '/categorie/' . $post['slug'] . '?id=' . $post['id_categorie'] ?>"><?= $post['name'] ?></a></strong></p>
			<h2>
				<a href="<?= PATH_PREFIX_P5 ?>/post?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
			</h2>
			
			<img src="<?= $post['image_path'] ?>" class="img-fluid rounded mx-auto d-block" alt="<?= htmlspecialchars($post['title']); ?>">
				    
			<p class="posts">
				<?php 
				$length = $nbP == 0 ? 350 : 150;
				echo truncate($post['post'] , $length, " ...   <a href='" . PATH_PREFIX_P5 . "/post?id=" . $post['id'] . "'><em>( lire la suite )</em></a>"); 
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
	?>
</div>