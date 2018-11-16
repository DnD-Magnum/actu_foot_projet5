<!-- =====  FRONTEND // PAGE QUI AFFICHE TOUS LES POSTS  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = 'Acceuil | ACTUFOOT Les news'; ?>

<!-- === PARTIE ARTICLE ENTETEd  === -->
<div class="news shadow p-3 mb-5 bg-white rounded">
	<p><strong><a href="<?= PATH_PREFIX . '/categorie/' . $header['name'] . '?id=' . $header['id_categorie'] ?>"><?= $header['name'] ?></a></strong></p>
	<h2>
		<a href="<?= PATH_PREFIX ?>/post?id=<?= $header['id'] ?>"><?= htmlspecialchars($header['title']); ?></a>
	</h2>
			
	<img src="<?= $header['image_path'] ?>" class="img-fluid rounded mx-auto d-block" alt="<?= htmlspecialchars($header['title']); ?>">
				    
	<p class="posts">
		<?php 
		if (strlen($header['post']) >= 350) {
			$header['post'] = substr($header['post'], 0, 350);
			$espace = strrpos($header['post'], " ");
			$header['post'] = substr($header['post'], 0, $espace) . " ...   <a href='" . PATH_PREFIX . "/post?id=" . $header['id'] . "'><em>( lire la suite )</em></a>";
		}
		echo $header['post']; 
		?>
	</p>
	<p>
		<?= htmlspecialchars($header['author']); ?>
		<em>le <?= $header['date_creation_fr']; ?></em>
	</p>
	<p>
		<em><a href="<?= PATH_PREFIX ?>/post?id=<?= $header['id'] ?>">Commentaires</a></em>
	</p>
</div>

<!-- === PARTIE POSTS RéCENT  === -->
<div class="home-page-posts">
	<?php
	foreach ($posts as $post):
	?>
		<div class="col-md-5 col-xs-12 news shadow p-3 mb-5 bg-white rounded">
			<p><strong><a href="<?= PATH_PREFIX . '/categorie/' . $post['name'] . '?id=' . $post['id_categorie'] ?>"><?= $post['name'] ?></a></strong></p>
			<h2>
				<a href="<?= PATH_PREFIX ?>/post?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']); ?></a>
			</h2>
			
			<img src="<?= $post['image_path'] ?>" class="img-fluid rounded mx-auto d-block" alt="<?= htmlspecialchars($post['title']); ?>">
				    
			<p class="posts">
				<?php 
				if (strlen($post['post']) >= 150) {
					$post['post'] = substr($post['post'], 0, 150);
					$espace = strrpos($post['post'], " ");
					$post['post'] = substr($post['post'], 0, $espace) . " ...   <a href='" . PATH_PREFIX . "/post?id=" . $post['id'] . "'><em>( lire la suite )</em></a>";
				}
				echo $post['post']; 
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
	?>
</div>