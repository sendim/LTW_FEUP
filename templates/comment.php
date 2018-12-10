<?php 
		include_once('../database/db_user.php');
		include_once('../database/db_comment.php');

		function drawSimpleComment($comment) {
			$username = getUserUsername($comment['userId']);
			$text = $comment['text'];
			
			?>
				<div class="comment story-card bg-white" id="<?=$comment['commentId']?>">   
					<p>
						<a href="profile.php?username=<?=$username?>">@<?=$username?></a>
						<?= ' ' . $text ?>
					</p>
				
			<?php 
		}


		function drawComment($comment) {
		/**
		 * Draws the comment section.
		 */ 
				$username = getUserUsername($comment['userId']);
				$text = $comment['text'];
				$subComments = getCommentsOfComment($comment['commentId']);
				$storyId = getCommentStoryId($comment['commentId']);

				drawSimpleComment($comment)
		?>  									
						<hr/>
 						<footer>
								<div class="story-footer-left">
										<div class="vote-buttons">
												<button class="button primary icon" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="1" csrf="<?=$_SESSION['csrf']?>">
														<img src='icons/arrow-up.svg' alt="Vote up">
												</button>
												<span type="likes">
														<?=getCommentLikes($comment['commentId'])?>
												</span>
												<button class="button primary icon" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="-1" csrf="<?=$_SESSION['csrf']?>">
														<img src='icons/arrow-down.svg' alt="Vote down">
												</button>
												<span type="dislikes">
														<?=getCommentDislikes($comment['commentId'])?>
												</span>
										</div>
								</div>
								<div class="story-footer-right">
										<a href="#<?=$comment['commentId']?>" storyId="<?=$storyId?>" csrf="<?=$_SESSION['csrf']?>"><?='Reply(' . sizeof($subComments) . ')'?></a>
								</div>
						</footer>
 						<div class="replies">
								<?php foreach($subComments as $subComment)
										drawComment($subComment);
								?>
						</div>
 				</div>
<?php 

} ?>
