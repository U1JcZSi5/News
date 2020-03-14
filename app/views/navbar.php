<header>
    <ul>
        <li><a href="<?php echo BASE_URL . 'route=home'; ?>">Home</a></li>
        <?php if (\libs\Session::sessionExists('username')) : ?>
            <li>
                <a href="#">
                    <?php echo \libs\Session::getSession('username'); ?>
                </a>
                <ul>
                    <?php if (\libs\Session::sessionExists('admin')) : ?>
                        <li><a href="<?php echo BASE_URL . 'route=dashboard' ?>">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL . 'route=logout' ?>" class="logout">Logout</a></li>
                </ul>
            </li>
        <?php else : ?>
            <li><a href="<?php echo BASE_URL . 'route=register' ?>">Sign Up</a></li>
            <li><a href="<?php echo BASE_URL . 'route=login' ?>">Login</a></li>
        <?php endif; ?>
    </ul>
</header>