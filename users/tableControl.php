<th colspan=8 style="background: #dcf0d6;">
  <div class="btn-group tabCtrl">
    <button type="button" id="btn_add" class="btn btn-default" data-toggle="modal">添加</button>
    <button type="button" id="btn_update" class="btn btn-info" style="display:none;">提交</button>
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span id="btnJXJSel">奖学金</span><span>&nbsp;&nbsp;</span><span class="caret"></span>
    </button>

    <ul class="dropdown-menu">
      <?php
        // level = 0: 国家级
        // level = 1: 院级
        // level = 2: 校级
        // level = 3: 所级 
	$level=array(0,1,1,1,2,2,3,3);
        include "../conn.php";
        $sql = "SELECT skind, readway, national FROM users WHERE cardid='".mysql_real_escape_string($_SESSION['cardid'])."'";
        $res = mysql_query($sql);
        while($row = mysql_fetch_row($res)){
          $skind = $row[0];
          $readway = $row[1];
          $national = $row[2];
        }

        $sql = "SELECT * FROM jxjkinds";
        $res=mysql_query($sql);
        $ntotal = 0;
        echo "<p id='li1' style='display:none'>x</p>";
        echo "<li class='seljxj'><a href=#>1. 所有文章</a></li>";
        while( $row = mysql_fetch_row($res) ){
          if($row[3]==0 && $row[4]==0){
            if ( $skind == "联培生" || $skind == "课题组自招生" ) {
              if ( $level[$row[2]] == 3 ) { // 所级
                $ntotal++;
                $idn = $ntotal+1;
                $id = 'li'.$idn;
                $levelid = 'level'.$idn;
                echo "<p id='{$id}' style='display:none'>{$row[2]}</p>";
                echo "<p id='{$levelid}' style='display:none'>{$level[$row[2]]}</p>";
                echo "<li class='seljxj'><a href=#>{$idn}. {$row[1]}</a></li>";
              }
            } else if ( $skind = "本所生" ) {
              if ( $level[$row[2]] == 0 && $national == $readway ) {
                $flag = 1;
              } else if ( $level[$row[2]] == 0 && $national == "博士" ) {
                $flag = 1; // 已在博士阶段获得过国奖奖学金，则无论 readway 如何修改，无法再次评选国奖
              } else {
                $flag = 0;
              }

              if ( $flag == 0 ) {
                $ntotal++;
                $idn = $ntotal+1;
                $id = 'li'.$idn;
                $levelid = 'level'.$idn;
                echo "<p id='{$levelid}' style='display:none'>{$level[$row[2]]}</p>";
                echo "<p id='{$id}' style='display:none'>{$row[2]}</p>";
                echo "<li class='seljxj'><a href=#>{$idn}. {$row[1]}</a></li>";
              }
            }
          }
        }
        echo "<p id='nlis' style='display:none'>{$ntotal}</p>";
      ?>
    </ul>

  </div>
</th>
