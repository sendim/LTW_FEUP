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


<?php
    include_once('../includes/session.php');
    include_once('../templates/layout.php');
    include_once('../templates/profile.php');

    // verify if user session is set
    if (!isset($_SESSION['username']))
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    
    drawLayout(function () {
        ?>
        <?php 
        $user = getUserProfile($_SESSION['username']);

        drawEditProfile($user);

    }, 'editProfile');
?>