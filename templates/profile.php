<?php 
    include_once('../includes/session.php');
    include_once('../database/user.php');
    include_once('../templates/story.php');
    include_once('../templates/comment.php');

    function draw_profile($profile) { 
        $comments = get_user_comments($_SESSION['username']);
        $stories = get_user_stories($_SESSION['username']);
        ?> 
        <div id="profile">

            <header id="profile-header" class="container bg-white">
                <header>
                    <div id="profile-header-photo">
                        <?php 
                            $image = get_user_profile_photo($profile['username']); 
                            if ($image != null) { ?>
                                <a href="../images/originals/<?=$image['id']?>.jpeg">
                                    <img src="../images/thumbnails/<?=$image['id']?>.jpeg" width="200" height="200">
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
                        <?=$profile['points']?>
                    </div>
    
                </header>

                <hr />
                
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
                            foreach($stories as $story) {
                                draw_story($story);
                            }
                        } else { ?>
                            <div class="container bg-white"> No stories yet. </div>
                            <?php
                        } 
                    ?>
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
                            foreach($comments as $comment) {
                                draw_comment($comment);
                            } 
                        } else {
                            ?>
                            <div class="container bg-white"> No comments yet. </div>
                            <?php
                        }
                    ?>
                </div>
            </section>
            
        </div>

<?php } 

    function draw_editProfile() {
    /**
     * Draws the login section.
     */ ?>
        <section id="editProfile" class="container bg-white">
    
            <header>
              <h2>Edit profile</h2>
            </header>
    
            <hr />
    
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

            <form action="../actions/action_upload.php" method="post" enctype="multipart/form-data">
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