<?php
require_once("BasicModel.php");
require_once("objects/ServiceObject.php");

class ServiceModel extends BasicModel {
    function countService(ServiceObject $similar) : int {
        $sql = "SELECT COUNT(*) AS total FROM tblservices ";
        $sql .= $this->createConditions($similar);
        $sql .= ";";
        $total = 0;
        if($result = $this->get($sql)){
            if($row = $result->fetch_array()) {
                $total = $row[0];
            }
        }
        return $total;
    }

    private function createConditions(ServiceObject $similar) {
        $out = "";
        if(!empty($similar->getServiceName())) {
            $search = $similar->getServiceName();
            $out .= "((service_name LIKE '%$search%') || (service_price LIKE '%$search%')) ";
        }
        if($out != "") {
            $out = "WHERE ".$out;
        }
        return $out;
    }

    function getServices(ServiceObject $similar, $page, $total) : array {
        $list = array();
        if($page <= 0) {
            $page = 1;
        }
        $at = ($page - 1) * $total;
        $sql = "SELECT * FROM tblservices ";
        $sql .= $this->createConditions($similar);
        $sql .= "LIMIT $at, $total;";
        $result = $this->get($sql);
        if($result->num_rows > 0) {
            while($user = $result->fetch_object('ServiceObject')) {
                array_push($list, $user);
            }
        }
        return $list;
    }

    function getServiceById($id) : ServiceObject {
        $user = null;
        $sql = "SELECT * FROM tblservices WHERE service_id=$id";
        $result = $this->get($sql);
        if($result->num_rows > 0) {
            $user = $result->fetch_object('ServiceObject');
        }
        return $user;
    }

    function delService(ServiceObject $item) : bool {
        $sql = "DELETE FROM tblservices WHERE service_id=?";
        if($stmt = $this->con->prepare($sql)) {
            $id = $item->getServiceId();
            $stmt->bind_param("i",$id);
            return $this->delV2($stmt);
        }
        return $this->del($sql);
    }

    function isExists(ServiceObject $item) : bool {
        $sql = "SELECT * FROM tblservices WHERE service_name='".$item->getServiceName()."';";
        $result = $this->get($sql);
        if($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    function addService(ServiceObject $item) : bool {

        if(!$this->isExists($item)) {

            $sql = "INSERT INTO tblservices(
                    service_name,service_price,service_description) VALUES(?,?,?)";
            $stmt = $this->con->prepare($sql);
            if($stmt) {
                $name = $item->getServiceName();
                $price = $item->getServicePrice();
                $description = $item->getServiceDescription();

                $stmt->bind_param(
                    "sss",
                    $name,
                    $price,
                    $description);
                
                return $this->addV2($stmt);
            }
        }
        return false;
    }

}