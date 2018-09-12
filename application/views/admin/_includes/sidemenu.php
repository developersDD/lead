
<?php $this->load->view('admin/_includes/header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar">
                <div class="page-sidebar  sidebar-nav">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul id="menu" class="page-sidebar-menu">
                        <li class="<?= $parent_menu=='dashboard'?'active':''; ?>">
                            <a href="<?= base_url('admin/dashboard'); ?>">
                                <i class="icon-Dashboard" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="<?= $parent_menu=='user_management'?'active':''; ?>">
                            <a href="<?= base_url('admin/users'); ?>">
                                <i class="icon-Users" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                <span class="title">Users</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="<?= $child_menu=='users'?'active':''; ?>">
                                    <a href="<?= base_url('admin/users'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                        <span class="icon-User-List"></span>
                                        User List
                                    </a>
                                </li>
                                <li class="<?= $child_menu=='add_new_user'?'active':''; ?>">
                                    <a href="<?= base_url('admin/users/add'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                        <span class="icon-Add-User"></span>
                                        Add New User
                                    </a>
                                </li>
                                <li class="<?= $child_menu=='user_category'?'active':''; ?>">
                                    <a href="<?= base_url('admin/user/category'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                       <span class="icon-User-category"></span>
                                        User Category
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="<?= $parent_menu=='branch_management'?'active':''; ?>">
                            <a href="<?= base_url('admin/branches'); ?>">
                                <i class="icon-Users" data-name="branches" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                <span class="title">Branches</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="<?= $child_menu=='branches'?'active':''; ?>">
                                    <a href="<?= base_url('admin/branches'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                        <span class="icon-User-List"></span>
                                        Branch List
                                    </a>
                                </li>
                                <li class="<?= $child_menu=='add_new_branch'?'active':''; ?>">
                                    <a href="<?= base_url('admin/branches/add'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                        <span class="icon-Add-User"></span>
                                        Add New Branch
                                    </a>
                                </li>
                                <li class="<?= $child_menu=='user_category'?'active':''; ?>">
                                    <a href="<?= base_url('admin/user/category'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                        <span class="icon-User-category"></span>
                                        User Category
                                    </a>
                                </li>
                            </ul>
						</li>
						
						<li class="<?= $parent_menu=='inventory_management'?'active':''; ?>">
                            <a href="<?= base_url('admin/branches'); ?>">
                                <i class="icon-Users" data-name="branches" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                <span class="title">Inventory</span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="<?= $child_menu=='products'?'active':''; ?>">
                                    <a href="<?= base_url('admin/inventory'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                        <span class="icon-User-List"></span>
                                        Product List
                                    </a>
                                </li>
                                <li class="<?= $child_menu=='add_new_product'?'active':''; ?>">
                                    <a href="<?= base_url('admin/inventory/add'); ?>">
                                        <!-- <i class="fa fa-angle-double-right"></i> -->
                                        <span class="icon-Add-User"></span>
                                        Add New Product
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </section>
            <!-- /.sidebar -->
        </aside>
