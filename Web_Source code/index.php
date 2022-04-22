<?php
    include "php/init.php";
    include "php/loginhandle.php";
?>
<!DOCTYPE html>
<html>
<head>
    <base target="_parent">
    <link rel="shortcut icon" href="img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    
    <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Font Awesome -->
    <link ref="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body id="body-pd">
    <!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <?php if(isset($_SESSION['logged'])){ ?>
  <nav id="sidebarMenu" class="d-lg-block sidebar bg-white collapse" style="">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple active" 
       style="" onclick="loadpage(this.id)" id="spin.php">
            <i class="fas fa-fw me-3 iconify" data-icon="uiw:dashboard"></i>
            <span>Main dashboard</span>
        </a>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple"
        onclick="loadpage(this.id)" id="view/bcc.php">
            <i class="fas fa-fw me-3 iconify" data-icon="bi:calendar-check"></i>
            <span>Bảng chấm công</span>
        </a>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple"
        onclick="loadpage(this.id)" id="view/dmk.php">
            <i class="fas fa-fw me-3 iconify" data-icon="fluent:key-32-regular"></i>
            <span>Đổi mật khẩu</span>
        </a>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple" style=""
        onclick="loadpage(this.id)" id="view/ttcn.php">
            <i class="fas fa-fw me-3 iconify" data-icon="gg:info"></i>
            <span>Thông tin cá nhân</span>
        </a>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple"
        onclick="loadpage(this.id)" id="view/dsnv.php">
            <i class="fas fa-fw me-3 iconify" data-icon="jam:task-list"></i>
            <span>Danh sách nhân viên</span>
        </a>
        <?php if(isset( $_SESSION["Quan_ly"]) && $_SESSION["Quan_ly"] == true){ ?>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple"
        onclick="loadpage(this.id)" id="view/qlnv.php">
            <i class="fas fa-fw me-3 iconify" data-icon="eos-icons:admin-outlined"></i>
            <span>Quản lý nhân viên</span>
        </a>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple"
        onclick="loadpage(this.id)" id="view/tnv.php">
            <i class="fas fa-fw me-3 iconify" data-icon="fluent:people-add-20-regular"></i>
            <span>Thêm nhân viên</span>
        </a>
        <a href="javascript:void(0)" class="list-group-item list-group-item-action py-2 ripple"
        onclick="loadpage(this.id)" id="view/cam.php">
            <i class="fas fa-fw me-3 iconify" data-icon="ri:live-fill"></i>
            <span>Camera</span>
        </a>
        <?php } ?>
      </div>
    </div>
  </nav>
  <?php }?>
  <!-- Sidebar -->
  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button class="navbar-toggler collapsed" type="button" data-mdb-toggle="collapse" 
      data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" 
      aria-label="Toggle navigation" id="navButton">
        <i class="fas iconify" data-icon="typcn:th-menu"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="/">
        <img src="img/logo.png" height="20" alt="" loading="lazy"/>
        <span class="">HOME</span>
      </a>
      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <!-- Notification dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" 
          id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <i class="fas iconify" data-icon="bxs:bell-ring"></i>
            <span class="badge rounded-pill badge-notification bg-danger">0</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Thông báo mới</a></li>
            <li><a class="dropdown-item" href="#">Thông báo cá nhân</a></li>
            <li>
              <a class="dropdown-item" href="#">Thông báo công ty</a>
            </li>
          </ul>
        </li>

        <!-- Icon dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" 
          href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <i class="flag-vietnam flag m-0"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="#"><i class="flag-vietnam flag"></i>Việt Nam
                <i class="fa fa-check text-success ms-2"></i></a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="poland flag"></i>Polski</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="china flag"></i>中文</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="japan flag"></i>日本語</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="germany flag"></i>Deutsch</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="france flag"></i>Français</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="spain flag"></i>Español</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="russia flag"></i>Русский</a>
            </li>
            <li>
              <a class="dropdown-item" href="#"><i class="portugal flag"></i>Português</a>
            </li>
          </ul>
        </li>

        <!-- Avatar -->
        <?php if(isset($_SESSION['logged'])){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" 
          href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
             <i class="iconify" data-icon="ic:round-account-circle"></i>
            <span class="ms-1 me-1">
                <?php if (isset($_SESSION["Ten"])) echo $_SESSION["Ten"];?>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" 
          data-popper-placement="null" data-mdb-popper="none">
            <li><a class="dropdown-item" href="#"  
              onclick="loadpage('view/ttcn.php')">Thông tin cá nhân</a></li>
            <li><a class="dropdown-item" href="#">Cài đặt</a></li>
            <li><a class="dropdown-item" href="php/logout.php">Đăng xuất</a></li>
          </ul>
        </li>
        <?php }?>
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->
<!--Main layout-->
<?php if(isset($_SESSION['logged'])){ ?>
<main style="margin-top: 58px; margin-bottom: 0px;  height: (100vh - 58px);">
    <div id="maincontent">
    </div>
</main>
<?php } else include "php/login.php" ?>
<!--Main layout-->
<script>
    function loadpage(page){
        spinner();
        const nodes = document.getElementsByClassName("list-group-item");
        for (let i = 0; i < nodes.length; i++) {
            nodes[i].classList.remove("active");
        }
        const bt = document.getElementById("navButton");
        if(!bt.classList.contains("collapsed")){
            bt.click();
        }
        const setactive = document.getElementById(page);
        setactive.classList.add("active");
        $("#maincontent").load(page);
    }
</script>
</body>
</html>
<script src="js/hidefooter.js"></script>