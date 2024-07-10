<?php
function serviceTable($items) {
    $out = '<table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên dịch vụ</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col" colspan="3">Thực hiện</th>
                    </tr>
                </thead>
            <tbody>';
    foreach($items as $item) {
        $out .= serviceRow($item);
    }
    $out .= '</tbody></table>';
    return $out;
}

function serviceRow(ServiceObject $item) {
    $out = '<tr>';
    $out .= '<th scope="row" class="align-middle">'.$item->getServiceId().'</th>';
    $out .= '<th scope="row" class="align-middle">'.$item->getServiceName().'</th>';
    $out .= '<td scope="row" class="align-middle">'.$item->getServicePrice().'</td>';
    $out .= '<td scope="row" class="align-middle">'.$item->getServiceDescription().'</td>';
    // $out .= '<td class="align-middle">
    // <a class="btn btn-primary btn-sm" href="/hostay/admin/user.php?id='.$item->getId().'">
    //     <i class="bi bi-eye"></i>
    // </a>
    // </td>';
    $out .= '<td class="align-middle">
    <a class="btn btn-success btn-sm" href="/hostay/admin/employeedata.php?id='.$item->getServiceId().'">
        <i class="bi bi-pencil-square"></i>
    </a>
    </td>';
    if(($_SESSION["user"]["id"] != $item->getServiceId())
        && ($_SESSION["user"]["permission"] >= $item->getServiceId())) {
        $out .= '<td class="align-middle">
        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delUser'.$item->getServiceId().'">
            <i class="bi bi-trash"></i>
        </button>
        </td>';
    } else {
        $out .= '<td class="align-middle">
        <a class="btn btn-danger btn-sm disabled" href="#">
            <i class="bi bi-trash"></i>
        </a>
        </td>';
    }
    $out .= viewDel($item);
    $out .= '</tr>';
    return $out;
}
function viewDel($item) {
    $out = '<div class="modal fade" id="delUser'.$item->getServiceId().'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
    $out .= '<div class="modal-dialog">';
    $out .= '<div class="modal-content">';
    $out .= '<div class="modal-header">';
    $out .= '<h1 class="modal-title fs-5" id="staticBackdropLabel">Xóa tài khoản</h1>';
    $out .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    $out .= '</div><div class="modal-body">';
    $out .= 'Bạn có chắc chắn muốn xóa tài khoản: '.$item->getServiceId();
    $out .= '</div><div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="exitDel">Thoát</button>
                <a href="/hostay/actions/servicedel.php?id='.$item->getServiceId().'" class="btn btn-danger">Xóa</a>
            </div></div></div></div>';
    return $out;
}
?>