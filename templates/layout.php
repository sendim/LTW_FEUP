<?php function draw_layout($draw_content){ ?>

<style>

  header {
    background-color: #E8E9EB;
  }

  body {
    background-color: #E0DFD5;
    margin: 0;
  }

  header {
    padding: 8px;
    display: flex;
  }

  header h1 {
    margin-bottom: 0;
    margin-top: 0;
    width: 80%;
    flex: 80%;
  }

  header button {
    flex: 20%;
  }

  #row {
    display: flex;
  }

  nav {
    background-color: #313638;
    color: white;
    min-height: 100px;
    padding: 8px;
    min-width: 20%;
    flex: 20%;
  }

  nav ul {
    list-style-type: none;
    padding-left: 8px;
  }
  
  nav ul li {
    margin-bottom: 12px;
  }

  nav ul li a {
    color: white;
    text-decoration: none;
  }

  #search {
    padding: 8px;
  }

  #search input#search-website {
    background-color: transparent;
    border: solid 1px rgba(232, 233, 235, 0.5);
    height: 30px;
    border-radius: 4px;
    width: 100%;
    padding: 6px;
  }

  .content {
    padding: 12px;
    flex: 80%;
  }

</style>

<!DOCTYPE html>
<html lang="en-US">
  <body>
    <header>
      <h1>The Fusion Network</h1>
      <button>Login</button>
    </header>

    <div id="row">
      <nav>
        <div id="search">
          <input id="search-website"  name="search-website" placeholder="Search stories, comments..."/>
        </div>
        <ul>
          <li>
            <a href="#">Feed</a>
          </li>
          <li>
            <a href="#">Channels</a>
          </li>
          <li>
            <a href="#">Profile</a>
          </li>
        </ul>
      </nav>
      <div class="content">
          <?php $draw_content(); ?>
      </div>
    </div>
  
 </body>
</html>

<?php }?>