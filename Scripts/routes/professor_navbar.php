<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand text-white">Capstone Management System</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="console">Console</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="algorithm">Algorithm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="projects">Projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="connect_canvas">Connect Canvas</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link"><?php echo $_SESSION['instructor_id']; ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout">Logout</a>
        </li>
    </ul>
</nav>