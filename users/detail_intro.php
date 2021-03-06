<?php
  session_start();
  if( $_SESSION['normal'] == "normal" ){
  }else{
    header("Location: ../index.php");
  }
  date_default_timezone_set('Asia/Shanghai');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>奖学金评审系统使用说明</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="../jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid" style="width:90%;">
  <hr>
  <h3 style="color:blue">奖学金评审系统使用说明</h3>
  <hr>
  <h4 style="color:blue">导航栏</h4>
  <p><span style="color:red">个人信息：</span>单击后查看或修改个人信息。 </p>
  <p><span style="color:red">申请状态：</span>查看已提交的一个或多个奖学金。表格中 "状态" 列显示文章的审核状态，其中未审核、待修改、已修改三种状态下点击对应文字可修改文章，待修改文章在提交修改后状态将变为已修改。</p>
  <p><span style="color:red">我的奖学金：</span>查看当前用户历年所获得的奖学金。 </p>
  <hr>
  <h4 style="color:blue">主表格</h4>
  <p>1、进入系统后主表格将显示 "添加" 和 "奖学金" 两个按钮。若有已录入的文章，操作列将显示 "删除" 和 "修改" 两个图标。 </p>
  <p>2、单击 "添加" 按钮进行<a href="#archivement">成果录入</a>。</p>
  <p>3、单击 "奖学金" 按钮并在下拉菜单中选择 "所有文章" 或 某一活动中的奖学金。</p>
  <p>&nbsp;&nbsp;3.1、单击 "所有文章" 将显示我的所有文章，包括已获得过奖学金的文章。已获奖或者正在参评的文章均不可删除。</p>
  <p>&nbsp;&nbsp;3.2、单击 某一具体奖学金，将显示我的可参与评选该奖学金的所有文章，操作列将出现 "选择" 按钮，表格第一行将增加一个蓝色 "提交" 按钮。勾选具体的奖学金，单击提交，将参评文章提交到系统。提交后仍可重新选择并再次提交。</p>
  <hr>
  <h4 style="color:blue" id="archivement">成果录入</h4>
  <p><span style="color:red">期刊/专利：</span>期刊需要填写期刊名，并在下拉菜单中选择，系统将根据期刊名读取分区分数，不包含在下拉菜单的期刊其分区分数将设为 0； 专利请填写 “发明专利”、“实用专利”、“PCT 专利” 或 “其他专利”。 </p>
  <p><span style="color:red">文章/专利标题：</span>填写具体文章或专利的标题。</p>
  <p><span style="color:red">DOI：</span>填写具体文章的 DOI 号或专利号。</p>
  <p><span style="color:red">作者总数：</span>填写文章或专利总的作者数。</p>
  <p><span style="color:red">署名顺序：</span>填写你在文章或专利中的作者署名顺序。一作的成果权重 1.0；共同一作的成果，排名第一的权重计 0.5，其他作者均分另外 0.5。</p>
  <p><span style="color:red">第一单位文章：</span>参评奖学金的发表成果须以苏州纳米所为第一单位，加工平台奖学金和华灿奖学金可放宽至通讯作者为纳米所导师，第一单位不做要求。</p>
  <p><span style="color:red">共同一作作者总数：</span>填写文章总的共同一作作者数。</p>
  <hr>
  <h4 style="color:red">特别说明：</h4>
  <p>1、成果中研究生为第二作者且导师为第一作者的成果视同研究生为第一作者。此种情况，请在署名顺序一栏填写“1”。</p>
  <p>2、同一级别或同一奖项奖学金申请，科研成果不得重复使用。</p>
  <p>3、国家奖学金硕士阶段和博士阶段可各申请一次，但成果不得重复使用。</p>
  <p>4、联培生和课题组自招生只能参评所级奖学金。</p>
  <p>5、成果录入的专利需为授权专利。</p>
  <hr>
</div>
</body>
</html>
