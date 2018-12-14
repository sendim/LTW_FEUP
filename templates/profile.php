<?php 
    include_once('../includes/session.php');
    include_once('../database/db_user.php');
    include_once('../templates/story.php');
    include_once('../templates/comment.php');

    function drawHeaderProfile($profile) {
        $profileLink = "profile.php?username=" . $profile['username'];
        ?>
        <div id="profile">
            <header id="profile-header" class="container header">
                <header class="container">
                    <div id="profile-header-photo">
                        <?php 
                            $image = getUserProfilePhoto($profile['username']);
                            if ($image != null) { ?>
                                <a href="../images/originals/<?=$image['imageId']?>.jpg">
                                    <img class="profile-pic responsive" src="../images/thumbnails/<?=$image['imageId']?>.jpg">
                                </a>
                            <?php
                            } else { ?>
                                <img src="../images/thumbnails/default.jpg">
                            <?php }
                        ?>
                    </div>

                    <div id="profile-header-user">
                        <a href=<?=$profileLink?>>
                            <h2><?=$profile['name']?></h2>
                        </a>
                            <small><?='@'.$profile['username']?></small>
                    </div>

                    <div id="profile-header-points">
                        <img src="icons/star.svg" alt="Points">
                        <span type="points"><?=$profile['points']?></span>
                    </div>
                </header>

                <hr/>
                
                <div class="container">
                    <?=   $profile['description']  ?>
                </div>
            </header>
        </div>
    <?php 
}

    
    function drawProfile($profile) { 
    /**
    * Draws the login section.
    */        
        $comments = getUserComments($profile['username']);
        $stories = getUserStories($profile['username']);
        drawHeaderProfile($profile);
    ?>
        <div id="profile">
          
            <section id="stories">
                <div id="stories-header" class="section-header">
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
                <div id="comments-header" class="section-header">
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

    function drawEditProfile($profile) {
    /**
     * Draws the login section.
     */ ?>
        <section id="editProfile" class="container bg-white">
    
            <header>
              <h2>Edit profile</h2>
            </header>
    
            <hr/>
    
            <form id="edit-profile-form" method="post" action="../actions/action_editProfile.php" onsubmit="return (validate());">
                <div class="form-input">
                    <label>New name</label>
                    <input type="text" name="name" placeholder="name" value=<?= $profile['name'] ?> >
                </div>

                <div class="form-input">
                    <label>New username</label>
                    <input type="text" name="username" placeholder="username" value=<?= $profile['username'] ?>>
                </div>
        
                <div class="form-input">
                    <label>New password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="form-input">
                    <label>New description</label>
                    <input type="text" name="description" placeholder="description" value=<?= $profile['description'] ?>>
                </div>
  
                <button class="button primary" type="submit">
                    Save changes
                </button>
            </form>

            <hr />

            <form action="../actions/action_imageUpload.php" method="post" enctype="multipart/form-data">
                <div class="form-input">
                    <label>Picture</label>
                    <small>Warning: current profile picture will be overwritten!</small>
                    <input type='file' name='image' accept='image/jpeg'>
                    <input type='hidden' name='title' value='profile'/>
                    <input type="submit" value="Upload image">
                </div>
            </form>

            <a href="../actions/action_deleteAccount.php">
                <button class="button primary">Delete account</button>
            </a>
        </section>


<script>
function validate() {
    const form = document.getElementById("edit-profile-form");
    let r = true;

    if (form.name.value === ""){
        r = form.name.value !== "";
    } 

    if (form.username.value === ""){
        r = form.username.value !== "";
    } 

    if (form.password.value === ""){
        r = form.password.value !== "";
    } 

    if (form.description.value === ""){
        r = form.description.value !== "";
    } 

    if (r == false)
        alert("It is necessary to fill all fields.");

    return r;
}
</script>
<?php } ?>
