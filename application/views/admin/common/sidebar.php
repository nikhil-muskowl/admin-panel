<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>assets/AdminLTE/dist/img/AdminLTELogo.png" alt="Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $this->users_lib->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>assets/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->users_lib->name ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if ($sidebar): ?>
                    <?php foreach ($sidebar as $value) : ?>
                        <?php if (($value['children'])): ?>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link"><i class="nav-icon fa fa-bars"></i><p><?= $value['name'] ?><i class="right fa fa-angle-left"></i></p></a>
                                <ul class="nav nav-treeview">
                                    <?php foreach ($value['children'] as $children) : ?>
                                        <li class="nav-item">
                                            <a href="<?= $children['href'] ?>" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <?= $children['name'] ?>
                                            </a>
                                        </li>   
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a href="<?= $value['href'] ?>" class="nav-link">
                                    <i class="nav-icon fa <?= $value['icon'] ?>"></i>
                                    <p><?= $value['name'] ?></p>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>

                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?= base_url('dashboard/logout') ?>" class="nav-link">
                        <i class="nav-icon fa fa-lock"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>