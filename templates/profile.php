<?php 
    include_once('../includes/session.php');
    include_once('../database/db_user.php');
    include_once('../templates/story.php');
    include_once('../templates/comment.php');

    function drawProfile($profile) { 
    /**
    * Draws the login section.
    */        
        $comments = getUserComments($profile['username']);
        $stories = getUserStories($profile['username']);
    ?>
        <div id="profile">

            <header id="profile-header" class="container bg-white">
                <header>
                    <div id="profile-header-photo">
                        <?php 
                            $image = getUserProfilePhoto($profile['username']);
                            if ($image != null) { ?>
                                <a href="../images/originals/<?=$image['imageId']?>.jpeg">
                                    <img src="../images/thumbnails/<?=$image['imageId']?>.jpeg" width="200" height="200">
                                </a>
                            <?php
                            } else { ?>
                                <img src="../images/thumbnails/default.jpeg" width="200" height="200">
                            <?php }
                        ?>
                    </div>

                    <div id="profile-header-user">
                        <h2><?=$profile['name']?></h2>
                        <small><?='@'.$profile['username']?></small>
                    </div>

                    <div id="profile-header-points">
                        <img src="icons/star.svg" alt="Points">
                        <span type="points"><?=$profile['points']?></span>
                    </div>
                </header>

                <hr/>
                
                <?php echo '<p>' . $profile['description'] . '</p>'; ?>
            </header>

            <section id="stories">
                <div id="stories-header" class="container section-header">
                    Stories
                    <button class="button secondary">Order by date</button>
                </div>

                <div id="stories-list">
                    <?php
                        if ($stories) {
                            foreach($stories as $story)
                                drawStory($story);
                        } else { ?>
                            <div class="container bg-white">No stories yet.</div>
                        <?php } ?>
                </div>
            </section>

            <section id ="comments">
                <div id="comments-header" class="container section-header">
                    Comments
                    <button class="button secondary">Order by date</button>
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
<?php }

    function drawEditProfile() {
    /**
     * Draws the login section.
     */ ?>
        <section id="editProfile" class="container bg-white">
    
            <header>
              <h2>Edit profile</h2>
            </header>
    
            <hr/>
    
            <form method="post" action="../actions/action_editProfile.php">
                <div class="form-input">
                    <label>New name</label>
                    <input type="text" name="name" placeholder="name">
                </div>

                <div class="form-input">
                    <label>New username</label>
                    <input type="text" name="username" placeholder="username">
                </div>
        
                <div class="form-input">
                    <label>New password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="form-input">
                    <label>New description</label>
                    <input type="text" name="description" placeholder="description">
                </div>
  
                <button class="button primary" type="submit">
                    Save changes
                </button>
            </form>

            <form action="../actions/action_imageUpload.php" method="post" enctype="multipart/form-data">
                <div class="form-input">
                    <label>Picture</label>
                    <small>Warning: current profile picture will be overridden!</small>
                    <input type="file" name="image">
                    <input type='hidden' name='title' value='profile'/>
                    <input type="submit" value="Upload image">
                </div>
            </form>

        </section>
<?php } ?>