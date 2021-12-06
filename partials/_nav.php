 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">My Page</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/comp440_login_page/login.php">Login</a>
        <a class="nav-link" href="/comp440_login_page/signup.php">Signup</a>
        <a class="nav-link" href="/comp440_login_page/blogs.php">Blogs</a>
        <div class="postBlog">
            <?php
                $username = $_SESSION['username'];
                if ($_SESSION['loggedin'] == true && $username == $_SESSION['username']) {
                ?><a class="nav-link" href="blogs.php" >Post a blog</a><?php
                }
            ?>
        </div>
      </div>
    </div>
  </div>
</nav>