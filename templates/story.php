<?php
include_once '../includes/session.php';
include_once '../database/db_story.php';
include_once '../database/db_channel.php';
include_once '../templates/comment.php';

function drawStory($story, $picked = false)
{
    /**
     * Draws a story section.
     */
    $storyLink = "story.php?id=" . $story['storyId'];
    $publishedDate = gmdate('F j, g:i a, Y', $story['published']);

    $author = getStoryAuthor($story['storyId']);
    $channel = getChannelTitle($story['channelId']);
		$nrComments = countStoryComments($story['storyId']);
		$storyImg = getStoryImage($story['storyId']);

		$downButton = "button primary icon";
		$upButton = "button primary icon";
		if ($picked){
			if(getUserVote($story['storyId'], $_SESSION['username']) > 0)
				$upButton = "button primary upVote icon";
			else
				$downButton = "button primary downVote icon";
		}
    ?>
		
		<div class="story-card bg-white">
			<header>
				<a href=<?=$storyLink?>>
					<h1>
						<?=htmlspecialchars($story['title'])?>
					</h1>
				</a>
				<?= '<small>' . $publishedDate . '</small>'; ?>
			</header>

			<?php if ($storyImg != null) {?>
				<img src="../images/thumbnails/<?=$storyImg?>.jpg">
			<?php }?>

			<div class="story-body">
				<p><?=htmlspecialchars($story['text'])?></p>
			</div>

			<hr/>

			<footer>
				<div class="story-footer-left">
					<div class="story vote-buttons">
						<button id="upButton" class="<?=$upButton?>" storyId="<?=$story['storyId']?>" username="<?=$_SESSION['username']?>" vote="1" csrf="<?=$_SESSION['csrf']?>">
							<img src='icons/arrow-up.svg' alt="Vote up">
						</button>
						<span type="likes">
							<?=getStoryLikes($story['storyId'])?>
						</span>
						<button id="downButton" class="<?=$downButton?>" storyId="<?=$story['storyId']?>" username="<?=$_SESSION['username']?>" vote="-1" csrf="<?=$_SESSION['csrf']?>">
							<img src='icons/arrow-down.svg' alt="Vote down">
						</button>
					</div>
					<div class="signature">
						by <a href="profile.php?username=<?=$author?>">@<?=$author?></a>
						at channel <a href="channel.php?title=<?=$channel?>"><?=$channel?></a>
					</div>
				</div>
				<div class="story-footer-right">
						<?php if ($author == $_SESSION['username']) {?>
							<a href="../actions/action_deleteStory.php?storyId=<?=$story['storyId']?>&csrf=<?=$_SESSION['csrf']?>">
								<button class="button secondary">Delete story</button>
							</a>
						<?php }?>
					<a href="<?=$storyLink?>">
					<?php echo $nrComments;
						if ($nrComments == 1) {
								echo ' comment';
						} else {
								echo ' comments';
						} ?>
					</a>
				</div>
			</footer>

		</div>

<?php }

function drawStoryPage($story)
{
    /**
     * Draws a story page section.
     */
    $publishedDate = gmdate('F j, g:i a, Y', $story['published']);

    $author = getStoryAuthor($story['storyId']);
    $comments = getStoryComments($story['storyId']);
    $channel = getChannelTitle($story['channelId']);
    $storyImg = getStoryImage($story['storyId']);
    ?>
		<div id="story-page">
			<header class="container header">
				<h1>
					<?=htmlspecialchars($story['title'])?>
				</h1>

				<?='<small>' . $publishedDate . '</small>'?>;

				<?php if ($author == $_SESSION['username']) {?>
					<a href="../actions/action_deleteStory.php?storyId=<?=$story['storyId']?>&csrf=<?=$_SESSION['csrf']?>">
						<button class="button secondary">Delete story</button>
					</a>
				<?php }?>

				<div id="story-description">
					<p><?=htmlspecialchars($story['text'])?></p>
				</div>

				<?php if ($storyImg != null) {?>
					<a href="../images/originals/<?=$storyImg?>.jpg">
						<img src="../images/thumbnails/<?=$storyImg?>.jpg">
					</a>
				<?php }?>

				<div class="signature">
					by <a href="profile.php?username=<?=$author?>">@<?=htmlspecialchars($author)?></a>
					at channel <a href="channel.php?title=<?=$channel?>"><?=htmlspecialchars($channel)?></a>
				</div>
			</header>

			 <section id ="comments">
				<div id="comments-header" class="section-header">
					<form method="post">
						<input id="comment-input" name="text" placeholder="Write a comment..." required>
						<input type="hidden" name="storyId" value="<?=$story['storyId']?>">
						<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
						<button id="send-comment-button" class="button primary">Send</button>
					</form>

			   </div>

				<div id="comments-list">
					<?php 
						if ($comments) {
							foreach ($comments as $comment) {
								$picked = userVotedComment($comment['commentId'], $_SESSION['username']);
								drawComment($comment, $picked);
							}
    				} else {?>
							<div class="container bg-white">No comments yet.</div>
						<?php } ?>
				</div>
			</section>
		</div>
<?php } ?>