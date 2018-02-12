<!-- Modal -->
<div class="modal fade" id="modPwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">重设学生密码</h4>
      </div>
      <div class="modal-body">
		<table class="table table-striped">
			<tbody>
		    	<tr>
					<td>身份证号</td>
					<td><input class="form-control" id="mdl-cardid"></td>
		    	</tr>
		    	<tr>
					<td>帐号密码</td>
         			<td><input type="password" class="form-control" id="mdl-password"></td>
		    	</tr>
		    	<tr>
					<td>密码确认</td>
         			<td><input type="password" class="form-control" id="mdl-pwd-confirm"></td>
		    	</tr>
			<tbody>
		</table>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" id="mod-confirm" class="btn btn-success">添加</button>
      </div>
    </div>
  </div>
</div>
