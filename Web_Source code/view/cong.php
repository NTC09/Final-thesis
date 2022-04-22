<?php
    include "init.php";
    if(isset($_GET["m_user_id"])){
        if ($_SESSION["Quan_ly"] == true)
            $user_id = $_GET["m_user_id"];
        else die();
    }
    else 
        $user_id = $_SESSION['user_id'];
    $month = $_GET['m'];
    $year = $_GET['y'];
    
    tableLoad($month, $year);
    function tableLoad($month, $year){
        echo "
        <table class='table table-hover table-sm overflow-auto'>
            <tr>
              <th scope='col'>Ngày</th>
              <th scope='col'>Thứ</th>
              <th scope='col'>Công</th>
              <th scope='col'>Thời gian có mặt</th>
              <th scope='col'>Số phút đi muộn</th>
            </tr>
        <tbody id='tableBody'>";
        $list=array();
        $thu = array();
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month){       
                $list[]=date('Y-m-d', $time);
                $thu[]=dayConv(date('D', $time));
            }
        }
        $length =  count($thu);
        include "init.php";
        $user_id = $GLOBALS['user_id'];
        
        for ($i = 0; $i < $length; $i++){
            echo "<tr>";
            echo "<td >". dateConv($list[$i]) ."</th>";
            echo "<td>". $thu[$i] ."</th>";
            $date = $list[$i];
            $sql= "select * from Diem_danh where ID = '$user_id' and Ngay_diem_danh = '$date'";
            $result = $connect->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<td><i class=\"fa fa-check\" style=\"color:#299438\"></th>";
                echo "<td>". $row['Gio_diem_danh']. "</th>";
                echo "<td>". timeSubtr($row['Gio_diem_danh'],"08:00:00"). "</th>";
            }
            else{
                $t=time();
                $curdate = date("Y-m-d",$t);
                if ($list[$i] <= $curdate)
                    echo "<td><i class=\"fa fa-remove\" style=\"color:#DB4035\"></th>";
                else
                    echo "<td></th>";
                echo "<td></th>";
                echo "<td></th>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    function dayConv($date){
        switch ($date){
            case "Mon": return "Thứ Hai";
            case "Tue": return "Thứ Ba";
            case "Wed": return "Thứ Tư";
            case "Thu": return "Thứ Năm";
            case "Fri": return "Thứ Sáu";
            case "Sat": return "Thứ Bảy";
            case "Sun": return "Chủ Nhật";
        }
    }
    function dateConv($date){
        $str = "";
        $str = date("d",strtotime($date));
        $str = $str ."/";
        $str = $str .date("m",strtotime($date));
        $str = $str ."/";
        $str = $str .date("Y",strtotime($date));
        return $str;
    }
    function timeSubtr($time1,$time2){
        /* time1 - time2 */
        $result = strtotime($time1) - strtotime($time2);
        if ($result < 0)
            return 0;
        else
            return round($result/60);
    }
?>
        