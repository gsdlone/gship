<div class="modal fade" id="modalDelJXJ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">删除奖学金</h4>
  </div>
  <div class="modal-body">
    <?php
      include "../conn.php";
      $sql = "SELECT award FROM students";
      $res = mysql_query($sql);
      $nrows = 0;
      $bakaward = array();
      while($row=mysql_fetch_row($res)){
        $nrows++;
        $bakaward[$nrows] =  $row[0];
      }
      $sql = "SELECT * FROM jxjkinds";
      $res = mysql_query($sql);
      $ntotal = -1;
      while($row=mysql_fetch_row($res)){
        if($row[4]==0){
         $flag = 0;
         for ($i=1; $i<=$nrows; $i++) {
           if ( strpos($bakaward[$i],$row[1]."|") === false ) {
           } else {
             $flag = 1;
           }
         }
         if ( $flag == 0 ) {
          $ntotal++;
          $id = "del".$row[0];
          $idx = "delx".$ntotal;
          $idy = "dely".$row[0];
          echo "<p style='display:none' id='{$idx}'>$row[0]</p>";
          echo "<div class='checkbox' style='display:block'>
            <label id='$idy'><input type='checkbox' id='{$id}'/>{$row[1]}</label>
          </div>";
         }
        }
      }
      echo "<p style='display:none' id='ndel'>$ntotal</p>";
    ?>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="submit" id="delJXJ" name="delJXJ" class="btn btn-success">提交</button>
  </div>
</div>
</div>
</div>
