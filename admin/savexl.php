<?php
session_start();
if (!isset($_SESSION['admin'])){
    header('Content-Type:text/html; charset=UTF-8');
    echo "错误!没有权限!";
    exit(0);
}

include_once("../conn.php");
$jxjname = $_GET['jxjname'];

include_once 'PHPExcel/PHPExcel.php';
include_once 'PHPExcel/PHPExcel/Writer/Excel5.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("dicp");
$objPHPExcel->getProperties()->setLastModifiedBy("dicp");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
 

$sql = "SELECT * FROM students";
$res = mysql_query($sql);

$np = 0;
$ap = array(); // students

while($row=mysql_fetch_row($res)){
  $np++;
  $ap[$np] = $row;
}

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3.2);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8.8);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5.8);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5.8);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5.8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8.8);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5.8);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(46);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8.0);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8.0);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(11);

$line = 0;
for ($j=1; $j<=$np; $j++) {
	$jxjs = explode("|",$ap[$j][2]);
    $nif = explode("|",$ap[$j][3]);

    $n = count($jxjs) - 1;
    for ( $i=0; $i<$n; $i++ ) {
	    if($jxjs[$i] == $jxjname ) {
            $sql = "SELECT * FROM users WHERE cardid='".mysql_real_escape_string($ap[$j][1])."'";
            $res = mysql_query($sql);
            $row = mysql_fetch_row($res);

		    $line++;
			$objPHPExcel->getActiveSheet()->mergeCells("A${line}:M${line}");
			$objPHPExcel->getActiveSheet()->SetCellValue("A${line}", "奖学金申报候选人成果统计($row[4])");
			$objPHPExcel->getActiveSheet()->getStyle("A${line}")->getFont()->setSize(18);  
            $objPHPExcel->getActiveSheet()->getStyle("A${line}")->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle("A${line}")->getFont()->setName('黑体');
			$objPHPExcel->getActiveSheet()->getStyle("A${line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("A${line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

			$line++;
			$objPHPExcel->getActiveSheet()->SetCellValue("A${line}", "序号");
			$objPHPExcel->getActiveSheet()->SetCellValue("B${line}", "姓名");
			$objPHPExcel->getActiveSheet()->SetCellValue("C${line}", "入学年份");
			$objPHPExcel->getActiveSheet()->SetCellValue("D${line}", "攻读类别");
			$objPHPExcel->getActiveSheet()->SetCellValue("E${line}", "专业");
			$objPHPExcel->getActiveSheet()->SetCellValue("F${line}", "指导教师");
			$objPHPExcel->getActiveSheet()->mergeCells("G${line}:H${line}");
			$objPHPExcel->getActiveSheet()->SetCellValue("G${line}", "论文(成果)名称");
			$objPHPExcel->getActiveSheet()->SetCellValue("I${line}", "作者署名顺序/作者总数");
			$objPHPExcel->getActiveSheet()->SetCellValue("J${line}", "发表刊物[名称,doi]");
			$objPHPExcel->getActiveSheet()->SetCellValue("K${line}", "文章分区分数(按最新分区分数计算)");
			$objPHPExcel->getActiveSheet()->SetCellValue("L${line}", "按作者排序比例");
			$objPHPExcel->getActiveSheet()->SetCellValue("M${line}", "分区分数(按照作者署名顺序计算)");
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:M${line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:M${line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:M${line}")->getFont()->setSize(10);  
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:M${line}")->getFont()->setName('Times New Roman');  
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:M${line}")->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:M${line}")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I${line}")->getFont()->setSize(9);  
			$objPHPExcel->getActiveSheet()->getStyle("K${line}")->getFont()->setSize(8);  
			$objPHPExcel->getActiveSheet()->getStyle("M${line}")->getFont()->setSize(8);  


			$line++;
			//			$sqlj = "SELECT COUNT(*) FROM journals WHERE idcard='".mysql_real_escape_string($ap[$j][1])."'";
			//            $resj = mysql_query($sqlj);
			//            $rowj = mysql_fetch_row($resj);
			$sqlj = "SELECT award FROM journals WHERE idcard='".mysql_real_escape_string($ap[$j][1])."'";
			$resj = mysql_query($sqlj);
			$npaper = 0;
			while($rowj = mysql_fetch_row($resj)){
				$x = explode("|", $rowj[0]);
				$ntmp = count($x) - 1;
  				for ( $k=0; $k<$ntmp; $k++ ) {
    				if( $x[$k] == $jxjname ) {
						$npaper++;
    				}
  				}
			}

			//			$npaper = $rowj[0];
			$nend = $line + $npaper + 1;
			$objPHPExcel->getActiveSheet()->mergeCells("A${line}:A${nend}");
			$objPHPExcel->getActiveSheet()->mergeCells("B${line}:B${nend}");
			$objPHPExcel->getActiveSheet()->mergeCells("C${line}:C${nend}");
			$objPHPExcel->getActiveSheet()->mergeCells("D${line}:D${nend}");
			$objPHPExcel->getActiveSheet()->mergeCells("E${line}:E${nend}");
			$objPHPExcel->getActiveSheet()->mergeCells("F${line}:F${nend}");

			for($k = $line; $k <= $nend; $k++){
				$objPHPExcel->getActiveSheet()->getStyle("A${k}:M${k}")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			}

			$ntmp = $nend - 1;
			$objPHPExcel->getActiveSheet()->mergeCells("H${ntmp}:L${ntmp}");
			$objPHPExcel->getActiveSheet()->mergeCells("H${nend}:M${nend}");

			$objPHPExcel->getActiveSheet()->SetCellValue("A${line}", "${j}");
			$objPHPExcel->getActiveSheet()->SetCellValue("B${line}", "$row[2]");
			$objPHPExcel->getActiveSheet()->SetCellValue("C${line}", "$row[9]"); // year
			$objPHPExcel->getActiveSheet()->SetCellValue("D${line}", "$row[7]"); // type
			$objPHPExcel->getActiveSheet()->SetCellValue("E${line}", "$row[6]"); // major
			$objPHPExcel->getActiveSheet()->SetCellValue("F${line}", "$row[8]"); // teacher
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:F${line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:F${line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("A${line}:F${line}")->getAlignment()->setWrapText(true);


			$ncount = 0;			
			$sqlj = "SELECT * FROM journals WHERE idcard='".mysql_real_escape_string($ap[$j][1])."'";
			$resj = mysql_query($sqlj);
			$sumifact = 0;
			$firstifact = 0;
			while($rowj = mysql_fetch_row($resj)){
				$x = explode("|", $rowj[11]);
				$ntmp = count($x) - 1;
  				for ( $k=0; $k<$ntmp; $k++ ) {
    				if( $x[$k] == $jxjname ) {
					  $ncount++;
			   		  $objPHPExcel->getActiveSheet()->SetCellValue("G${line}", "${ncount}"); // id
			   		  $objPHPExcel->getActiveSheet()->SetCellValue("H${line}", "$rowj[3]");  // title
			   		  $objPHPExcel->getActiveSheet()->SetCellValue("I${line}", "$rowj[7]/$rowj[6]");
			   		  $objPHPExcel->getActiveSheet()->SetCellValue("J${line}", "$rowj[2],$rowj[4]"); // name, doi
			
					  $sqlk = "SELECT ifactor FROM impact WHERE journal='$rowj[2]'";
					  $resk = mysql_query($sqlk);
					  $rowk = mysql_fetch_row($resk);

		  			  $tmp = sprintf("%.3f", $rowk[0]);
			   		  $objPHPExcel->getActiveSheet()->SetCellValue("K${line}", "$tmp");  // ifact

		  			  $tmp = sprintf("%.1f", $rowj[10]);
			   		  $objPHPExcel->getActiveSheet()->SetCellValue("L${line}", "$tmp"); // rate

					  $tmp = $rowj[10] * $rowk[0];
		  			  $tmp = sprintf("%.3f", $tmp);

					  $sumifact   = $sumifact   + $tmp;
					  if($rowj[10] == 1){
						  $firstifact = $firstifact + $tmp;
					  }
			   		  $objPHPExcel->getActiveSheet()->SetCellValue("M${line}", "$tmp"); // rate * ifact

					  $objPHPExcel->getActiveSheet()->getStyle("G${line}:M${line}")->getAlignment()->setWrapText(true);
					  $objPHPExcel->getActiveSheet()->getStyle("G${line}:M${line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					  $objPHPExcel->getActiveSheet()->getStyle("G${line}:M${line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					  $objPHPExcel->getActiveSheet()->getStyle("G${line}:M${line}")->getFont()->setSize(9);  
					  $objPHPExcel->getActiveSheet()->getStyle("G${line}:M${line}")->getFont()->setName('Times New Roman');  
					  $line++;
    				}
  				}
			}

			$tmp = sprintf("%.3f", $sumifact);
   		    $objPHPExcel->getActiveSheet()->SetCellValue("H${line}", "文章总分区分数=$tmp");

			$tmp = sprintf("%.3f", $firstifact);
   		    $objPHPExcel->getActiveSheet()->SetCellValue("M${line}", "第一作者文章分区分数=$tmp");
		    $objPHPExcel->getActiveSheet()->getStyle("H${line}:M${line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("H${line}:M${line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("H${line}:M${line}")->getFont()->setSize(10);  
			$objPHPExcel->getActiveSheet()->getStyle("H${line}:M${line}")->getFont()->setName('Times New Roman');  
			$objPHPExcel->getActiveSheet()->getStyle("H${line}:M${line}")->getAlignment()->setWrapText(true);

			$line = $nend;

   		    $objPHPExcel->getActiveSheet()->SetCellValue("G${line}", "所获奖励");
		    $objPHPExcel->getActiveSheet()->getStyle("G${line}")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("G${line}")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle("G${line}")->getFont()->setSize(10);  
			$objPHPExcel->getActiveSheet()->getStyle("G${line}")->getFont()->setName('Times New Roman');  
			$objPHPExcel->getActiveSheet()->getStyle("G${line}")->getAlignment()->setWrapText(true);			
		}
	}
}

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");
header("Content-Disposition:attachment;filename=${jxjname}.xls");
header("Content-Transfer-Encoding:binary");
$objWriter->save("php://output");
?>
