<?php function draw_login() {
/**
 * Draws the login section.
 */ ?>
    <section id="login" class="container bg-white">

        <header>
          <h2>Login</h2>
        </header>

        <hr />

        <form method="post" action="../actions/action_login.php">
          <div class="form-input">
            <label>Username</label>
            <input type="text" name="username" placeholder="username" required>
          </div>

          <div class="form-input">
            <label>Password</label>
            <input type="password" name="password" placeholder="password" required>
          </div>

          <button class="button primary" type="submit">
            Login
          </button>
        </form>

        <small>
          Don't have an account? <a href="signup.php">Signup!</a>
        </small>
    
    </section>
<?php } ?>

<?php function draw_signup() {
/**
 * Draws the signup section.
 */ ?>
  <section id="signup" class="container bg-white">

    <header>
      <h2>Signup</h2>
    </header>

    <hr />

    <form method="post" action="../actions/action_signup.php">
      <div class="form-input">
        <label>Full name</label>
        <input type="text" name="fullName" placeholder="Full name" required>
      </div>
      <div class="form-input">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" required>
      </div>
      <div class="form-input">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <div class="form-input">
        <label>Description</label>
        <textarea name="description" placeholder="Description"></textarea>
      </div>
      
      <button class="button primary" type="submit">Signup</button>
    </form>

    <small>
      Already have an account? <a href="login.php">Login!</a>
    </small>

  </section>
<?php } ?>