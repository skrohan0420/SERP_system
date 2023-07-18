<body id="page-top">
    <style>
        li{
            cursor: pointer;
        }
        
    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
                <div class="sidebar-brand-text mx-3">SERP - System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('search') ?>" style="background-color:<?=@$search ? '#f8f9fc': ''?>">
                    <i class="fa fa-search" style="color:<?=@$search ? '#224abe': ''?>"></i>
                    <span style="color:<?=@$search ? '#224abe': ''?>">search</span>
                </a>
            </li>
 
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('add/domain') ?>" style="background-color:<?=@$add_domain ? '#f8f9fc': ''?>">
                    <i class="fa fa-plus" style="color:<?=@$add_domain ? '#224abe': ''?>"></i>
                    <span style="color:<?=@$add_domain ? '#224abe': ''?>">add domain</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('rankings') ?>" style="background-color:<?=@$rankings ? '#f8f9fc': ''?>">
                    <i class="fa fa-list" style="color:<?=@$rankings ? '#224abe': ''?>"></i>
                    <span style="color:<?=@$rankings ? '#224abe': ''?>">rankings</span>
                </a>
            </li>








            






     



            <!-- Divider -->
            <hr class="sidebar-divider">



         

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->