<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <table class="table menuDinh" style="height: 100px;">
        <thead>
          <tr>
            <th scope="col">Thông tin</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">
              <img src="img/hoa/dạ yến thảo.jpg" alt="" width="70" height="70">
              <a href="https://sieuthihatgiong.vn/tu-van/ki-thuat-trong-hoa-da-yen-thao-bang-canh.html" class="fa-lgg">Kỹ thuật trồng hoa dạ yến thảo</a>
            </th>
          </tr>
          <tr>
            <th scope="row">
              <img src="img/hoa/Hoa phong lữ thảo.jpg" alt="" width="70" height="70">
              <a href="https://sieuthihatgiong.vn/tu-van/huong-dan-lam-no-hoa-theo-y-muon.html" class="fa-lgg">Hướng dẫn làm nở hoa theo ý muốn</a>
            </th>
          </tr>
          <tr>
            <th scope="row">
              <img src="img/gioithieu2.jpg" alt="" width="70" height="70">
              <a href="https://sieuthihatgiong.vn/tu-van/ki-thuat-trong-hoa-leo-tuong.html" class="fa-lgg">Kỹ thuật trồng hoa leo tường</a>
            </th>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th scope="col" class="pt-5">Danh mục</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">
              <div class="d-flex align-items-center">
                <i class='fas fa-seedling' style='color:#5eb11b; font-size: 1.5rem'></i>
                <a href="#" class="fa-lgg">Hạt Giống Hoa</a>
              </div>
            </th>
          </tr>
          <tr>
            <th scope="row">
              <div class="d-flex align-items-center">
                <i class='fas fa-seedling' style='color:#5eb11b; font-size: 1.5rem'></i>
                <a href="#" class="fa-lgg">Hạt giống rau</a>
              </div>
            </th>
          </tr>
          <tr>
            <th scope="row">
              <div class="d-flex align-items-center">
                <i class='fas fa-seedling' style='color:#5eb11b; font-size: 1.5rem'></i>
                <a href="#" class="fa-lgg p">Hạt giống củ</a>
              </div>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-sm-8">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/2.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/blog-img-02.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/hoa/dayenthao.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <div class="text-center p-5">
        <h1>Sản Phẩm Nổi Bật</h1>
      </div>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($products as $product) : ?>
          <div class="col-lg-4 col-sm-6">
            <div class="card h-100">
              <form method="post" action="index.php?page=home&act=buy">
                <img src="<?php echo $product['img_url']; ?>" class="card-img-top" alt="<?php echo $product['product_name']; ?>" width="200" height="250">
                <div class="card-body">
                  <h5 class="card-title text-center"><?php echo $product['product_name']; ?></h5>
                  <p class="card-text text-center"><?php echo $product['description']; ?></p>
                  <p class="card-text text-center">Giá: <?php echo number_format($product['price'], 0, '.', ','); ?> VNĐ</p>
                  <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>">
                  <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                </div>
                <div class="card-footer">
                  <small class="text-muted">
                    <div class="d-grid gap-2 d-md-block text-center text-center text-center">
                      <button type="submit" class="btn btn-success">Mua Ngay</button>
                    </div>
                  </small>
                </div>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <a href="#top" class="gotop"> <img src="img/up-arrow.png" width="60"></a>
</div>

<span class="p-5"></span>