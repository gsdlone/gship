<!-- Modal -->
<div class="modal fade" id="addIF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">更新分区分数</h4>
      </div>
      <div class="modal-body">
		<form id="import-IF-form" action="uploadIF.php" method="post" enctype="multipart/form-data">
			<input type="file" name="file" id="import-IF-file" class="filestyle" data-buttonText="浏览" data-buttonBefore="true"><br>
		</form>
		<div id="IF-display"></div>
		<a href="lookif.php" target="_blank" class="btn btn-default btn-success">查看当前分区分数</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" id="IF-confirm" class="btn btn-success">添加</button>
      </div>
    </div>
  </div>
</div>
