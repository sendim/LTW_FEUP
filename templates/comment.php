<?php 
		include_once('../database/db_user.php');
		include_once('../database/db_comment.php');

		function drawComment($comment) {
		/**
		 * Draws the comment section.
		 */ 
				$username = getUserUsername($comment['userId']);
				$text = $comment['text'];
				$subComments = getCommentsOfComment($comment['commentId']);
		?>
				<div class="comment story-card bg-white" id="<?=$comment['commentId']?>">   
						<p>
								<a href="profile.php?username=<?=$username?>">@<?=$username?></a>
								<?= ' ' . $text ?>
						</p>
								
						<hr/>

						<footer>
								<div class="story-footer-left">
										<div class="vote-buttons">
												<a class="button primary icon" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="1" csrf="<?=$_SESSION['csrf']?>">
														<img src='icons/arrow-up.svg' alt="Vote up">
												</a>
												<span type="likes">
														<?=getCommentLikes($comment['commentId'])?>
												</span>
												<a class="button primary icon" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="-1" csrf="<?=$_SESSION['csrf']?>">
														<img src='icons/arrow-down.svg' alt="Vote down">
												</a>
												<span type="dislikes">
														<?=getCommentDislikes($comment['commentId'])?>
												</span>
										</div>
								</div>
								<div class="story-footer-right">
										<a href="#<?=$comment['commentId']?>" csrf="<?=$_SESSION['csrf']?>"><?='Reply(' . sizeof($subComments) . ')'?></a>
								</div>
						</footer>

						<div class="replies">
								<?php foreach($subComments as $subComment)
										drawComment($subComment);
								?>
						</div>

				</div>
<?php } ?>