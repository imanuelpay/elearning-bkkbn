<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"><?= $info['name'] ?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">E B</a>
        </div>
        <ul class="sidebar-menu">
            <?php foreach ($result_menu as $menu) { ?>
                <li <?= (isset($_GET['page']) && $_GET['page'] == $menu['slug']) ? 'class="active"' : '' ?>>
                    <a href="?page=<?= $menu['slug'] ?>" class="nav-link">
                        <i class="fas <?= $menu['icon'] ?>"></i>
                        <span><?= $menu['name'] ?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </aside>
</div>