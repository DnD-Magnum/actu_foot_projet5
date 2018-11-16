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
			if (strlen($post['post']) >= 350) {
				$post['post'] = substr($post['post'], 0, 350);
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