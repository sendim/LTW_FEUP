<?php
include_once '../database/db_user.php';
include_once '../database/db_comment.php';
include_once '../database/db_story.php';

function drawSimpleComment($comment)
{
  $username = getUserUsername($comment['userId']);
  $text = $comment['text'];
  $publishedDate = gmdate('F j, g:i a, Y', $comment['published']);
  ?>
		<div id="<?=$comment['commentId']?>" class="comment story-card bg-white">
			<p>
				<a href="profile.php?username=<?=$username?>">@<?=$username?></a>
				<?=' ' . htmlspecialchars($text)?>
				<?='<small>' . $publishedDate . '</small>'?>
			</p>
	<?php
}

function drawComment($comment, $picked = false)
{
    /**
     * Draws the comment section.
     */
    $username = getUserUsername($comment['userId']);
    $text = $comment['text'];
    $subComments = getCommentsOfComment($comment['commentId']);
    $storyId = getCommentStoryId($comment['commentId']);
	$author = getCommentAuthor($comment['commentId']);
	$downButton = "button primary icon";
	$upButton = "button primary icon";
	if($picked){
		if(getUserCommentVote($comment['commentId'], $_SESSION['username']) > 0)
			$upButton = "button primary upVote icon";
		else
			$downButton = "button primary downVote icon";
	}

    drawSimpleComment($comment)
    ?>
			<hr/>
 			<footer>
				<div class="story-footer-left">
					<div class="comment vote-buttons">
						<button id="upButton" class="<?=$upButton?>" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="1" csrf="<?=$_SESSION['csrf']?>">
							<img src='icons/arrow-up.svg' alt="Vote up">
						</button>
						<span type="likes">
							<?=getCommentLikes($comment['commentId'])?>
						</span>
							<button id="downButton" class="<?=$downButton?>" commentId="<?=$comment['commentId']?>" username="<?=$_SESSION['username']?>" vote="-1" csrf="<?=$_SESSION['csrf']?>">
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
					$picked = userVotedComment($subComment['commentId'], $_SESSION['username']);
					drawComment($subComment, $picked); } ?>
			</div>
 		</div>
<?php } ?>
