<?php
  $sql = "SELECT * FROM users WHERE cardid='".mysql_real_escape_string($_SESSION['cardid'])."'";
  $infox=mysql_query($sql);
  $pinfo=mysql_fetch_row($infox);
?>
<div class="modal fade" id="register" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">编辑个人资料</h4>
          </div>
          <div class="modal-body" style="padding: 15px 0px 0px 0px">
        <table id="reg-table" class="table table-hover" style="table-layout:fixed">
          <tbody>
            <tr>
              <td width="20%"><span class="red"></span>姓名</td>
              <td><input class="form-control" id="reg-name-mdl" <?php echo "value='{$pinfo[2]}'"?>></td>
            </tr>
            <tr>
              <td><span class="red" ></span>手机/电话</td>
              <td><input class="form-control" id="reg-phone-mdl" <?php echo "value='{$pinfo[3]}'"?>></td>
            </tr>
            <tr>
              <td><span class="red"></span>组别</td>
              <td><input class="form-control" id="reg-telp-mdl" <?php echo "value='{$pinfo[4]}'"?>></td>
            </tr>
            <tr>
              <td><span class="red"></span>邮箱</td>
              <td><input class="form-control" id="reg-email-mdl" <?php echo "value='{$pinfo[5]}'"?>></td>
            </tr>
            <tr>
              <td><span class="red"></span>攻读专业</td>
              <td><input class="form-control" id="reg-major-mdl" <?php echo "value='{$pinfo[6]}'"?>></td>
            </tr>
            <tr>
              <td><span class="red"></span>攻读方式</td>
              <td><input class="form-control" id="reg-readway-mdl" <?php echo "value='{$pinfo[7]}'"?>></td>
            </tr>
            <tr>
              <td><span class="red"></span>指导教师</td>
              <td><input class="form-control" id="reg-teacher-mdl" <?php echo "value='{$pinfo[8]}'"?>></td>
            </tr>
            <tr>
              <td><span class="red"></span>入学年份</td>
              <td><input class="form-control" id="reg-year-mdl" <?php echo "value='{$pinfo[9]}'"?>></td>
            </tr>
          </tbody>
        </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-success" id="upconfirm">修改</button>
          </div>
      </div>
  </div>
</div>
