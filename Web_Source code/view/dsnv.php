<?php
    include "init.php";
    $user_id = $_SESSION['user_id'];
    
    $sql= "select * from Danh_sach where ID = '$user_id'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    $id_bo_phan = $row["ID_BP"];
    
    
    $sql2= "select * from Danh_sach where ID_BP = '$id_bo_phan'";
    $result2 = $connect->query($sql2);
    
    $sql3= "select * from Danh_sach where 1";
    $result3 = $connect->query($sql3);
    
    $page = 1;
    $page_size = 10;
    
    ?>
<div class="modal fade modal-fullscreen" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Thông tin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid" id="profileMDbody">
            
        </div>
      </div>
      <div class="modal-footer">
        <div class="text-center">
          <!--button type="button" class="btn btn-primary fade" id="hiddenButton" data-bs-toggle="modal" data-bs-target="#messModal"></button-->
          <button type="button" class="btn btn-primary text-center" data-bs-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!----------------------------------------------------------------------------->
<div class="p-3">
  <div class="card">
  <h4 class="text-center p-3">Danh sách nhân viên</h4>
    <div id="myTable" class="table-responsive">
    <table class="table table-hover table-sm">
      <thead>
        <tr class="">
          <th scope="col" style=" overflow: auto;">ID</th>
          <th scope="col" style=" overflow: auto;">Họ</th>
          <th scope="col" style=" overflow: auto;">Tên</th>
          <th scope="col" style=" overflow: auto;">Điện thoại</th>
          <th scope="col" style=" overflow: auto;">Email</th>
          <th scope="col" style=" overflow: auto;">Địa chỉ</th>
        </tr>
      </thead>
      <tbody>
            <?php
                while($row2 = mysqli_fetch_array($result2)) {
                    echo "<tr id='".$row2['ID']."'>";
                    echo "<td>" . $row2['ID'] . "</td>";
                    echo "<td>" . $row2['Ho'] . "</td>";
                    echo "<td>" . $row2['Ten'] . "</td>";
                    echo "<td>" . $row2['Dien_thoai'] . "</td>";
                    echo "<td>" . $row2['Email'] . "</td>";
                    echo "<td>" . $row2['Dia_chi'] . "</td>";
                    echo "</tr>";
                }
            ?>
      </tbody>
    </table>
    </div>
    <ul class="pagination justify-content-center mt-3">
      <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </div>
</div>
<script>
    var page = <?php echo $page?>;
    var row_count = 0;
    var page_size = <?php echo $page_size?>;
    
    var page_item_1 = 0;
    var page_item_2 = 0;
    var page_item_3 = 0;
    /*************************************/
    page_item_2 = page;
    if (page > 1)
        page_item_1 = page - 1;
    else 
        page_item_1 = 0;
    if (page < Math.ceil (row_count / page_size))
        page_item_3 = page + 1;
    else 
        page_item_3 = 0;    
        
    function next(){
        if (page < Math.ceil (row_count / page_size))
            page = page + 1;
    }
    function pre(){
        if(page > 1)
            page = page - 1;
    }
    /*************************************/
</script>