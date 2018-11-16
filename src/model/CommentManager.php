<?php
namespace blogApp\src\model;
/**
 * Class CommentManager
 * Model qui gere les commentaires
 */
class CommentManager extends \blogApp\core\Model
{

	/**
     * Recupere le nombre de  commentaire d'un post
     * @param id du post $number
     * Retourne la variable $totalComments 
     */
	public function commentCount($idPost)
	{
		$totalCommentsReq = $this->db->prepare('SELECT COUNT(id) FROM comments WHERE id_post = ?');
		$totalCommentsReq->execute([$idPost]);
		$totalComments = $totalCommentsReq->fetch()[0];
		return $totalComments;
	}

	/**
     * Recupere les commentaire d'un post
     * Fait une pagination tous les 5 commentaires
     * @param id du post $number
     * Retourne la variable $comments pour afficher les commentaire
     * Retourne $totalPages et $currentPage pour gerer la pagination dans la vue
     */
	public function getComments($postId)
	{
		$nbCommentPage = 5;
		$totalComments = $this->commentCount($postId);
		$totalPages = ceil($totalComments/$nbCommentPage);

		if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $totalPages) {
			$_GET['page'] = intval($_GET['page']);
			$currentPage = $_GET['page'];
		} else {
			$currentPage = 1;
		}

		$depart = ($currentPage - 1) * $nbCommentPage;

	    $comments = $this->db->prepare('SELECT id,  id_post, author, comment, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr, signal_count FROM comments WHERE id_post = ? ORDER BY date_comment DESC LIMIT ' . $depart . ', ' . $nbCommentPage);
	    $comments->execute(array($postId));
	    $comments = $comments->fetchAll();

	    $varsForPagination = [$comments, $totalPages, $currentPage];
	    return $varsForPagination;
	}

	/**
     * Rajoute un commentaire a un post
     * @param id du post $number
     * @param auteur du commentaire $string
     * @param commentaire $string
     * Retourne le nouveau commentaire
     */
	public function postComment($postId, $author, $comment)
	{
	    $comments = $this->db->prepare('INSERT INTO comments (id_post, author, comment, date_comment) VALUES(?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $comment));

	    return $affectedLines;
	}

	//recupere un commentaire
	public function getComment($id)
	{
	    $comment = $this->db->prepare('SELECT id, id_post, signal_count, comment, author FROM comments WHERE id = ? ');
	    $comment->execute(array($id));

	    return $comment;
	}

	public function editComment($newComment, $id)
	{
		$comment = $this->db->prepare('UPDATE comments SET comment = ?, date_comment = NOW() WHERE id = ?');
		$affectedComment = $comment->execute(array($newComment, $id));

		return $affectedComment;
	}

	/**
     * Signal le commentaire d'un post
     * @param id du commentairet $number
     * Retourne le nouveau nombre de signalement
     */
	public function addSignalComment($id)
	{
		$comment = $this->db->prepare('UPDATE comments SET signal_count = signal_count + 1 WHERE id = ?');
		$affectedCount = $comment->execute(array($id));

		return $affectedCount;
	}

	/**
	 * Supprime un commentaire
	 * @param id du commentaire $number
	 * Retourne une variable
	 */
	public function deleteComment($idComment)
	{
		$deletedComment = $this->db->prepare('DELETE FROM comments WHERE comments . id = ?');
		$affectedComment = $deletedComment->execute(array($idComment));

		return $affectedComment;
	}

	/**
     * Enleve les signalements sur un commentaire
     * @param id du commentairet $number
     * Retourne le nouveau nombre de signalement
     */
	public function noSignalComment($id)
	{
		$comment = $this->db->prepare('UPDATE comments SET signal_count = 0 WHERE id = ?');
		$affectedCount = $comment->execute(array($id));

		return $affectedCount;	
	}

	/**
     * Retourne les commentaire signalement
     * Retourne les commentaires signaler
     */
	public function getSignalComments()
	{
	    $comments = $this->db->query('SELECT comments.id,  id_post, comments.author, comment, posts.title, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr, signal_count FROM comments LEFT JOIN posts ON comments.id_post = posts.id Where signal_count >= 1 ORDER BY signal_count DESC');
	    $comments = $comments->fetchAll();

	    return $comments;
	}
}