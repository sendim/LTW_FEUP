<?php 
	include_once('../includes/session.php');
	include_once('../database/db_story.php');
	include_once('../database/db_channel.php');
	include_once('../templates/comment.php');

	function drawStory($story) {
	/**
	* Draws a story section.
	*/
		$storyLink = "story.php?id=" . $story['storyId'];
		$publishedDate = gmdate('F j, g:i a, Y', $story['published']);

		$author = getStoryAuthor($story['storyId']);
		$channel = getChannelTitle($story['channelId']);
		$nrComments = countStoryComments($story['storyId']);
	?>
		<div class="story-card bg-white">
			<header>
				<a href=<?=$storyLink?>>
					<h1>
						<?=$story['title']?>
					</h1>
				</a>
				<?php
					echo '<small>'.$publishedDate.'</small>';
				?>
			</header>

			<div class="story-body">
				<p><?=$story['text']?></p>
			</div>

			<hr/>

			<footer>
				<div class="story-footer-left">
					<div class="vote-buttons">
						<button class="button primary icon" storyId="<?=$story['storyId']?>" username="<?=$_SESSION['username']?>" vote="1" csrf="<?=$_SESSION['csrf']?>">
							<img src='icons/arrow-up.svg' alt="Vote up">
						</button>
						<span type="likes">
							<?=getStoryLikes($story['storyId'])?>
						</span>
						<button class="button primary icon" storyId="<?=$story['storyId']?>" username="<?=$_SESSION['username']?>" vote="-1" csrf="<?=$_SESSION['csrf']?>">
							<img src='icons/arrow-down.svg' alt="Vote down">
						</button>
						<span type="dislikes">
							<?=getStoryDislikes($story['storyId'])?>
						</span>
					</div>
					<div class="signature">
						by <a href="profile.php?username=<?=$author?>">@<?=$author?></a>
						at channel <a href="channel.php?title=<?=$channel?>"><?=$channel?></a>
					</div>
				</div>
				<div class="story-footer-right">
					<a href="<?=$storyLink?>">
					<?php
						echo $nrComments;
						if ($nrComments > 1)
							echo ' comments';
						else
							echo 'comment';
						?>
					</a>
				</div>
			</footer>
						
		</div>

<?php } 

	function drawStoryPage($story) {
	/**
	* Draws a story page section.
	*/
		$publishedDate = gmdate('F j, g:i a, Y', $story['published']);
		
		$author = getStoryAuthor($story['storyId']);
		$comments = getStoryComments($story['storyId']);
		$channel = getChannelTitle($story['channelId']);
	?>
		<div id="story-page">
			<header class="container bg-white">
				<h1>
					<?=$story['title']?>
				</h1>
			
				<?php
					echo '<small>'.$publishedDate.'</small>';
				?>

				<div id="story-description">
					<p><?=$story['text']?></p>
				</div>

				<div class="signature">
					by <a href="profile.php?username=<?=$author?>">@<?=$author?></a>
					at channel <a href="channel.php?title=<?=$channel?>"><?=$channel?></a>
				</div>
			</header>

			 <section id ="comments">
				<div id="comments-header" class="section-header">
					<form>
						<input id="comment-input" name="text" placeholder="Write a comment..." required>
						<input type="hidden" name="storyId" value="<?=$story['storyId']?>">
						<input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
						<button id="send-comment-button" class="button primary">Send</button>
					</form>
				  
					<hr/>

				  <button class="button secondary">Order</button>
			   </div>

				<div id="comments-list">
					<?php
						if ($comments) {
							foreach($comments as $comment)
								drawComment($comment);
						} else { ?>
							<div class="container bg-white">No comments yet.</div> 
						<?php } ?>
				</div>
			</section>

		</div>
<?php } ?>