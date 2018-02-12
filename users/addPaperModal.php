<div class="modal fade" id="addpaper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">成果录入</h4>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item">1、<kbd style="background-color: #9383b5">期刊/专利</kbd>
            期刊请输入期刊名，并在下拉菜单中选择，不包含在下拉菜单的期刊影响因子将设为 0；
            专利请填写 “发明专利”、“实用专利”、“PCT 专利” 或 “其他专利”。
          </li>
          <li class="list-group-item">2、<kbd style="background-color: #9383b5">文章/专利 标题</kbd>
            填写具体文章或专利的标题。
          </li>
          <li class="list-group-item">3、<kbd style="background-color: #9383b5">DOI/专利号</kbd>
            填写正确的 DOI 号或专利号，将用于奖学金的审核。
          </li>
        </ul>
	  <div id="paper-id"></div>
          <div class="form-group" id="prefetch">
            <label>期刊/专利：</label>
            <input type="text" class="typeahead form-control" id="journal" name="journal" placeholder="">
          </div>
          <div class="form-group">
            <label>文章/专利 标题：</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="">
          </div>
          <div class="form-group">
            <label>DOI/专利号：</label>
            <input type="text" class="form-control" id="doi" name="doi" placeholder="文章 DOI 号">
          </div>
          <div class="form-group">
            <label>作者总数：</label>
            <input type="text" class="form-control" id="nauthors" name="nauthors" placeholder="输入一个正整数">
          </div>
          <div class="form-group">
            <label>署名顺序：</label>
            <input type="text" class="form-control" id="seq" name="seq" placeholder="输入一个正整数">
          </div>
          <div class="checkbox">
		  <label style="padding: 0px;"><input type="checkbox" id="coaffi" name="coaffi"/>&nbsp;第一单位文章</label>
          </div>
          <div class="checkbox">
		  <label style="padding: 0px;"><input type="checkbox" id="coauthor" name="coauthor"/>&nbsp;我是共同一作作者</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" id="submit" name="submit" class="btn btn-success">保存</button>
      </div>
    </div>
  </div>
</div>
