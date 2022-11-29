<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand text-white">Capstone Management System</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="groups">Group Formation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bidding">Project Bidding</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link"><?php echo $_SESSION['user_id']; ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout">Logout</a>
        </li>
    </ul>
</nav>