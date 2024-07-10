<?php
session_start();
if(!isset($_SESSION["user"])) {
    header("location:/hostay/admin/login.php");
} else {
    if(!isset($_SESSION["user"]["permission"]) || $_SESSION["user"]["permission"] < 1) {
        header("location:/hostay/admin/login.php?err=permis");
    } else {
        if(!isset($_GET["id"]) || $_GET["id"] <= 0 || !is_numeric($_GET["id"])) {
            header("location:/hostay/admin/service.php?err=value");
        } else {
            if($_SESSION["user"]["id"] != $_GET["id"]) {
                require_once("../app/models/ServiceModel.php");
                $serviceModel = new ServiceModel();
                $service = $serviceModel->getServiceById($_GET["id"]);
                if($service != null){
                    
                        $result = $serviceModel->delService($service);

                        if($result) {
                            header("location:/hostay/admin/service.php?suc=del");
                        } else {
                            header("location:/hostay/admin/service.php?err=del");
                        }
                    
                } else {
                    header("location:/hostay/admin/service.php?err=noexist");
                }
            } else {
                header("location:/hostay/admin/service.php?err=notok");
            }
        }
    }
}
?>