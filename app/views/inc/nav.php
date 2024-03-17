<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo BURL;?>home/index">Home</a>
        </li>
        <li>
            <a href="<?php echo BURL;?>home/about">About</a>
        </li>
        <li>
            <a href="<?php echo BURL;?>home/projects">Projects</a>
        </li>
        <li>
            <a href="<?php echo BURL;?>home/blog">Blog</a>
        </li>
        <li>
            <a href="<?php echo BURL;?>home/contact">Contact</a>
        </li>
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])):?>
            <a href="<?php echo BURL?>user/logout">Log out</a>
            <?php else:?>
            <a href="<?php echo BURL?>user/login">Login</a>
            <?php endif;?>
        </li>
    </ul>

</nav>