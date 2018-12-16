<?php
include_once '../database/db_user.php';
include_once '../database/db_comment.php';

function drawSimpleComment($comment)
{
    $username = getUserUsername($comment['userId']);
    $text = $comment['text'];

    ?>
				<div id="<?=$comment['commentId']?>" class="comment story-card bg-white">
					<p>
						<a href="profile.php?username=<?=$username?>">@<?=$username?></a>
						<?=' ' . $text?>
					</p>

			<?php
}

function drawComment($comment)
{
    /**
     * Draws the comment section.
     */
    $username = getUserUsername($comment['userId']);
    $text = $comment['text'];
    $subComments = getCommentsOfComment($comment['commentId']);
    $storyId = getCommentStoryId($comment['commentId']);
    $author = getCommentAuthor($comment['commentId']);

    drawSimpleComment($comment)
    ?>
						<hr/>
 						<footer>
								<div class="story-footer-left">
										<div class="comment vote-buttons">
												<button class="button primary icon" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="1" csrf="<?=$_SESSION['csrf']?>">
														<img src='icons/arrow-up.svg' alt="Vote up">
												</button>
												<span type="likes">
														<?=getCommentLikes($comment['commentId'])?>
												</span>
												<button class="button primary icon" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="-1" csrf="<?=$_SESSION['csrf']?>">
														<img src='icons/arrow-down.svg' alt="Vote down">
												</button>
										</div>
								</div>
								<div class="story-footer-right">
									<?php if ($author == $_SESSION['username']) {?>
										<a href="../actions/action_deleteComment.php?commentId=<?=$comment['commentId']?>&csrf=<?=$_SESSION['csrf']?>">
											<button class="button secondary">Delete comment</button>
										</a>
									<?php }?>
									<a href="#<?=$comment['commentId']?>" storyId="<?=$storyId?>" csrf="<?=$_SESSION['csrf']?>"><?='Replies(' . sizeof($subComments) . ')'?></a>
								</div>
						</footer>
 						<div class="replies">
								<?php foreach ($subComments as $subComment) {
        drawComment($subComment);
    }

    ?>
						</div>
 				</div>
<?php

}?>
