<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location:/hostay/admin/login.php");
} else {
    if(!isset($_SESSION["user"]["permission"]) || $_SESSION["user"]["permission"] < 1) {
        header("location:/hostay/admin/login.php?err=permis");
    }
}
//
$_SESSION["pos"] = "service";
$_SESSION["active"] = "serviceAdd";
//

require_once("../app/models/ServiceModel.php");
require_once("../libraries/Utilities.php");

if(isset($_POST["addService"])) {
    
    $serviceName = trim($_POST["txtServiceName"]);
    $price = trim($_POST["txtPrice"]);

    if(!empty($serviceName) && !empty($price))
    {
        $serviceModel = new ServiceModel();
        $serviceObject = new ServiceObject();

        $serviceObject->setServiceName($serviceName);
        $serviceObject->setServicePrice($price);
        $serviceObject->setServiceDescription($description);

        if(!$serviceModel->isExists($serviceObject)) {
            if($serviceModel->addService($serviceObject)) {
                header("location:/hostay/admin/addservice.php?suc=add");
            }else {
                header("location:/hostay/admin/addservice.php?err=add");
            }
        } else {
            header("location:/hostay/admin/addservice.php?err=exist");
        }
    } else {
        header("location:/hostay/admin/addservice.php?err=value");
    }
}

require_once("layouts/header.php");
require_once("layouts/Toast.php");
?>
<!--Start main page-->
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between">
      <h1>Thêm mới dịch vụ</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/hostay/admin/">Trang chủ</a></li>
          <li class="breadcrumb-item active">Thêm mới dịch vụ</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
		        <div class="card">
		            <div class="card-body">
                        <form action="" method="post" class="needs-validation" novalidate>
                            <div class="mb-3 mt-3 row">
                                <label for="serviceName" class="col-sm-3 col-form-label fw-bold">Tên dịch vụ</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control"
                                        id="serviceName"
                                        name="txtServiceName"
                                        placeholder="Tên dịch vụ"
                                        required>
                                    <div class="invalid-feedback">
                                        Hãy nhập tên dịch vụ
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="price" class="col-sm-3 col-form-label fw-bold">Giá</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control"
                                        id="price"
                                        name="txtPrice"
                                        placeholder="100.000"
                                        required>
                                    <div class="invalid-feedback">
                                        Hãy nhập giá dịch vụ
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-sm-3 col-form-label fw-bold">Mô tả</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                        class="form-control"
                                        id="description"
                                        name="txtDescription"
                                        placeholder="Mô tả">
                                </div>
                            </div>
                            
                            <div class="mb-3 row d-flex justify-content-center">
                                <button type="submit"
                                class="btn btn-primary col-md-2 col-sm-3 me-sm-3 mt-3"
                                name="addService">
                                    Thêm mới
                                </button>
                                <a class="btn btn-secondary col-md-2 col-sm-3 mt-3" href="">Xóa</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!--End main page-->
<?php
require_once("layouts/footer.php");
?>