<?php
    include "init.php";
?>
<div class="p-3">
<div class="card">
  <h5 class="text-center p-3">Bảng chấm công</h5>
  <div class="row justify-content-center align-items-center">
    <div class="col col-auto align-middle" style="-min-width: 4rem">
      <label for="curmonth" class="control-label">Tháng:</label>
    </div>
    <div class="col col-auto">
      <select id="curmonth" class="form-select" onchange="dateSelect()" style="height:35.27px">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>
    </div>
    <div class="col col-auto" style="-min-width: 3rem">
      <label for="curyear" class="control-label">Năm:</label>
    </div>
    <div class="col-1" style="min-width: 7rem">
      <div class="input-group">
        <input type="number" class="form-control" value="0" name="curyear" id="curyear" 
        onkeyup="dateSelect()" onchange="dateSelect()"/>
      </div>
    </div>
  </div>
  <div id="myTable" class="table-responsive m-0 p-0">

  </div>
</div>
</div>
<script type="text/javascript" src="/js/script.js">
</script>
<script>
    defaultTime();
    defaultTable();
</script>