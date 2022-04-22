<?php
    include "init.php";
    if (isset($_GET['bp'])){
        $id_bo_phan = $_GET['bp'];
        $m = $_GET['m'];
        $y = $_GET['y'];
    }
    else die();
    $sql= "select * from Danh_sach where ID_BP = '$id_bo_phan'";
    $result = $connect->query($sql);
    
    $sql1= "select * from Chuc_vu where 1";
    $result1 = $connect->query($sql1);
    $i=0;
    while($row1 = $result1->fetch_assoc()){
        $ID_CV[$i] = $row1['ID_CV'];
        $Ten_CV[$ID_CV[$i]] = $row1['Ten_CV'];
        $i++;
    }
    
    while ($row = $result->fetch_assoc()){
        getProfile($row['ID'],$m,$y);
    }
    
    function getProfile($id,$m,$y){
        $connect = $GLOBALS['connect'];
        $sql= "select * from Danh_sach where ID = '$id'";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
        $id_bo_phan = $row["ID_BP"];
        $cong = 0;
        $so_lan_muon = 0;
        $sql1= "select * from Diem_danh where ID = '$id'";
        $result1 = $connect->query($sql1);
        while ($row1 = $result1->fetch_assoc()){
            if (intval(date('m',strtotime($row1['Ngay_diem_danh']))) == $m && 
            intval(date('Y',strtotime($row1['Ngay_diem_danh']))) == $y){
                $cong++;
                if (timeSubtr($row1['Gio_diem_danh'],"08:00:00") != -1){
                    $so_lan_muon++;
                }
            }
        }
        echo "<tr style='cursor: pointer;' id='".$row['ID']."' onclick='loadUserProfile(this.id)'>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Ho'] . "</td>";
        echo "<td>" . $row['Ten'] . "</td>";
        echo "<td>" . TenCV($row['ID_CV']) . "</td>";;
        echo "<td class='text-center'>" . $cong . "</td>";
        echo "<td class='text-center'>" . $so_lan_muon . "</td>";
        echo "</tr>";
    }
    function TenCV($idcv){
        return $GLOBALS['Ten_CV'][$idcv];
    }
    function timeSubtr($time1,$time2){
        /* time1 - time2 */
        $result = strtotime($time1) - strtotime($time2);
        if ($result < 0)
            return -1;
        else
            return round($result/60);
    }
?>