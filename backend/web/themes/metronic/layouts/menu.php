<?php
use yii\bootstrap\Nav;

?>


<div class="page-sidebar navbar-collapse collapse">

    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->


    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
        data-slide-speed="200" style="padding-top: 20px">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <li class="sidebar-toggler-wrapper hide">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler">
                <span></span>
            </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <li class="sidebar-search-wrapper">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
            <form class="sidebar-search  " action="#" method="POST">
                <?php /*
                <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                </a>
                */ ?>
                <div class="input-group">
                    <?php /*
                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                    */?>
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>

        <?php
        foreach ($this->params['mainMenu'] as $item) {
            if ($item) {
                if (isset ($item['children']) AND is_array($item['children'])) {
                    $countChildren = 0;
                    foreach ($item['children'] as $child) {
                        if ($child) $countChildren++;
                    }
                    if ($countChildren == 0) continue;
                    ?>
                    <li class="nav-item   <?php if (isset($item['active']) AND $item['active']) echo "active open" ?>">
                        <a class="active nav-link nav-toggle"
                           href="<?php echo isset($item['url']) ? $item['url'] : 'javascript:;' ?>">
                            <i class="<?php echo $item['icon'] ?>"></i>
                            <span class="title"><?php echo \yii\helpers\Html::decode($item['name']) ?></span>
                            <?php if (isset($item['children']) AND is_array($item['children']) AND count($item['children']) != 0): ?>
                                <?php if(isset($item['active']) AND $item['active']) { ?>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                <?php } else { ?>
                                    <span class="arrow"></span>
                                <?php } ?>
                            <?php endif; ?>
                        </a>

                        <ul class="sub-menu">
                            <?php foreach ($item['children'] as $children): ?>
                                <li class="nav-item  <?php if(isset($children['active']) AND $children['active']) echo 'active open' ?>">
                                    <a href="<?php echo isset($children['url']) ? $children['url'] : 'javascript:;' ?>"
                                       class="nav-link nav-toggle">
                                        <i class="<?= $children['icon'] ?>"></i>
                                        <span class="title"><?= \yii\helpers\Html::decode($children['label']) ?></span>

                                        <?php if (isset($children['children']) AND is_array($children['children']) AND count($children['children']) != 0): ?>
                                            <?php if(isset($children['active']) AND $children['active']) { ?>
                                            <span class="selected"></span>
                                            <span class="arrow open"></span>
                                            <?php } else { ?>
                                            <span class="arrow"></span>
                                            <?php } ?>
                                        <?php endif; ?>
                                    </a>

                                    <?php if (isset($children['children']) AND is_array($children['children']) AND count($children['children']) != 0): ?>
                                        <ul class="sub-menu ">
                                            <?php foreach ($children['children'] as $little_children): ?>
                                                <li class="nav-item <?php if (isset($little_children['active']) AND $little_children['active']) echo "active open"; ?>">

                                                    <a href="<?php echo isset($little_children['url']) ? $little_children['url'] : 'javascript:;' ?>"
                                                       class="nav-link ">
                                                        <i class="<?= $little_children['icon'] ?>"></i>
                                                        <?= \yii\helpers\Html::decode($little_children['label']) ?>
                                                    </a>
                                                </li>

                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php
                } else {
                    if (isset($item['url'])) {
                        ?>
                        <li <?php if (isset($item['active']) AND $item['active']) echo 'class="active"' ?> >
                            <a href="<?php echo $item['url'] ?>">
                                <i class="<?php echo $item['icon'] ?>"></i>
                                <span class="title"><?php echo $item['name']; ?></span>
                                <?php if (isset($item['active']) AND $item['active']) echo '<span class="selected"></span>' ?>
                            </a>
                        </li>
                        <?php
                    }
                }
            }
        }
        ?>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
