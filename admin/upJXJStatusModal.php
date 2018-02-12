<div class="modal fade" id="modalUpJXJStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">更改奖学金状态</h4>
  </div>
  <div class="modal-body">
  <?php
    include "../conn.php";
    $sql = "SELECT * FROM jxjkinds";
    $res=mysql_query($sql);
    $ntotal = -1;
    while($row=mysql_fetch_row($res)){
      if($row[3]==0){
        $stat = "开启";
      }elseif($row[3]==1){
        $stat = "关闭";
      }
      if($row[4]==0){
        $statx = "未入档";
      }elseif($row[4]==1){
        $statx = "已入档";
      }
      if($row[4]==0){ //未入档
        $ntotal++;
        $ids="ujxj".$ntotal;
        $idx="ujxjx".$ntotal;
        $pids="pjxj".$ntotal;
        $pidx="pjxjx".$ntotal;
        $pidy="jid".$ntotal;
        echo "<label>{$row[1]}：</label>";
        echo "<div class='checkbox' style='display:inline'>";
        echo "<label><input type='checkbox' id='{$ids}' name='{$ids}'/>开启&nbsp;&nbsp;&nbsp;</label>";
        echo "</div>";
        echo "<div class='checkbox' style='display:inline'>";
        echo "<label><input type='checkbox' id='{$idx}' name='{$idx}'/>入档</label>";
        echo "</div>";
        echo "<p style='display:none' id='{$pids}'>$stat</p>";
        echo "<p style='display:none' id='{$pidx}'>$statx</p>";
        echo "<p style='display:none' id='{$pidy}'>$row[0]</p>";
        echo "<br>";
      }
    }
    echo "<p style='display:none' id='ujxjs'>$ntotal</p>";
  ?>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="submit" id="submitStatus" name="submitStatus" class="btn btn-success">提交</button>
  </div>
</div>
</div>
</div>
