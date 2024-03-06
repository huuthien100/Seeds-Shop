<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hạt Giống Cây Trồng</title>
  <link rel="icon" href="img/logo_top.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <?php
  session_start();

  use App\Controllers\UserController;
  use App\Models\UserModel;

  $userController = new UserController(new UserModel($pdo));
  $isLoggedIn = $userController->isLogged();
  if ($isLoggedIn) {
    if (isset($_SESSION['user_id'])) {
      $user_identifier = $_SESSION['user_id'];
    } else {
      echo 'Người dùng chưa đăng nhập!';
    }
    $accessLevel = $userController->getAccess($user_identifier);
  }
  ?>
  <nav class="navbar navbar-expand-lg custom-footer">
    <div class="container">
      <a class="navbar-brand ms-2" href="index.php?page=home"><img src="img/logo_.png" style="height:60px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link fs-5" href="index.php?page=about">Giới thiệu</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
              Sản phẩm
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Hạt giống hoa</a></li>
              <li><a class="dropdown-item" href="#">Hạt giống rau</a></li>
              <li><a class="dropdown-item" href="#">Hạt giống củ</a></li>
            </ul>
          </li>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
          </form>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=cart"><i class="fa fa-shopping-cart fs-2" aria-hidden="true"></i></a>
          </li>
          <li class="nav-item">
            <div class="dropdown">
              <a href="#" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false"><i class="nav-link fa fa-user fs-2"></i></a>
              <ul class="dropdown-menu bg-body-tertiary dropdown-menu-lg-end" style="z-index: 10000;">
                <?php if ($isLoggedIn) { 
                  $subnav = true?>
                  <li><a class="dropdown-item" href="index.php?page=logout">Đăng xuất</a></li>
                <?php } else { $subnav = false?>
                  <li><a class="dropdown-item" href="index.php?page=register">Đăng ký</a></li>
                  <li><a class="dropdown-item" href="index.php?page=login">Đăng nhập</a></li>
                <?php } ?>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php
  if ($isLoggedIn && $subnav === true && $accessLevel === 1) {
  ?>
    <nav class="navbar navbar-expand-lg custom-footer">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=mProducts"><i class="fas fa-box-open fs-1"></i> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=mUsers"><i class="fas fa-users fs-1 "></i> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=mOrders"><i class="fas fa-file-alt fs-1"></i> </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php } ?>