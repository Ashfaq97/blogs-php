 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">My Page</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/comp440/login.php">Login</a>
        <a class="nav-link" href="/comp440/signup.php">Signup</a>
        <a class="nav-link" href="/comp440/blogs.php">Blogs</a>
        <div class="postBlog">
            <?php
            include 'partials/_dbconnect.php';

            session_start();

                $username = $_SESSION['username'];
                if ($_SESSION['loggedin'] == true && $username == $_SESSION['username']) {
                ?><a class="nav-link" href="user_home.php" >Post a blog</a><?php
                }
            ?>
        </div>

        <a class="nav-link" href="/comp440/q1_positiveComments.php">Query 1</a>
        <a class="nav-link" href="/comp440/q2_mostBlogs.php">Query 2</a>
        <a class="nav-link" href="/comp440/q3_usersFollowed.php">Query 3</a>
        <a class="nav-link" href="/comp440/q4_neverPosted.php">Query 4</a>
        <a class="nav-link" href="/comp440/q5_negativeComments.php">Query 5</a>
        <a class="nav-link" href="/comp440/q6_noNegativeComments.php">Query 6</a> 

      </div>
    </div>
  </div>
</nav>