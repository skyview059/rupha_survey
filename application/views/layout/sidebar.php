<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <?php
                echo Modules::run('user/_menu');
                echo Modules::run('member/_menu');
                echo Modules::run('benefit/_menu');
                echo Modules::run('union/_menu');
                echo Modules::run('profile/_menu');

                echo Modules::run('sms/_menu');

                echo add_main_menu('Settings', 'settings', 'settings', 'fa-gear');
                echo add_main_menu('DB Backup & Restore', 'db_sync', 'db_sync', 'fa-hdd-o');
                echo Modules::run('module/menu');
                echo add_main_menu('Logout', 'logout', 'dashboard', 'fa-sign-out');
            ?>
        </ul>
    </section>
</aside>

<!-- Body Content Start -->
<div class="content-wrapper">
    <div id="ajaxContent">