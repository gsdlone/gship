<?php
  include "../conn.php";
  $sql = "SELECT id,journal,title,doi,nauthors,seq,ifactor,weight,coaffi,coauthor,award,status FROM journals WHERE idcard='".mysql_real_escape_string($_SESSION['cardid'])."'";
  $result=mysql_query($sql,$con);
  $total=0.0;
  $count = 0;
  $firstot = 0.0;
  $firstmax = 0.0;
  if(mysql_num_rows($result)>0){
    while($row=mysql_fetch_assoc($result)){
      $count++;
      $sql = "SELECT journal,ifactor FROM impact where journal='{$row['journal']}'"; 
      $res=mysql_query($sql);
      if( $r = mysql_fetch_assoc($res) ){
        $row['ifactor'] = $r['ifactor'];
      } else {
        $row['ifactor'] = 0;
      }
      $total=$total+$row['ifactor']*$row['weight'];
	  if($row['weight'] == 1){
        $firstot=$firstot+$row['ifactor']*$row['weight'];
        if($row['ifactor'] > $firstmax){
		  $firstmax = $row['ifactor'];
		}
	  }
      $idr="tr".$count;
      echo "<tr id='{$idr}'>";
      echo "<td id='{$row['id']}'>{$count}</td>";
      echo "<td>{$row['journal']}</td>";
      echo "<td>{$row['title']}</td>";
      echo "<td><a href='https://doi.org/{$row['doi']}' target='_blank'>{$row['doi']}</a></td>";
      echo "<td>{$row['seq']}/{$row['nauthors']}</td>";
      $idx = "jstatus".$count;
      echo "<p id=$idx style='display:none'>{$row['award']}</p>";
      $idx = "jstatusx".$count;
      echo "<p id=$idx style='display:none'>{$row['status']}</p>";
      //if (strpos($row['status'], 'T') !== false) {
      if ( strlen($row['status']) > 0 ) {
        $disabled = "disabled";
      } else {
        $disabled = "";
      }
      $idx = "if".$count;
      if ( $row['ifactor'] == 0 ) {
        echo "<td id=$idx style='color:red'>{$row['ifactor']}</td>";
      } else {
        echo "<td id=$idx>{$row['ifactor']}</td>";
      }
      $idx = "w".$count;
      echo "<td id=$idx>{$row['weight']}</td>";
      echo "<td style='display:none'>{$row['coaffi']}</td>";
      echo "<td style='display:none'>{$row['coauthor']}</td>";
      $idy="btnCheck".$count;
      $idz="btnSel".$count;
      $ndy="btn-delete".$count;
      $ndz="btn-edit".$count;
      echo ' <td>
        <button type="button" id="'.$ndy.'" class="btn btn-default btn-small btn-delete glyphicon glyphicon-trash" data-toggle="modal" data-target="#confirmDelete" data-id="'.$row['id'].'" data-count="'.$count.'" '.$disabled.'></button>
        <button type="button"  id="'.$ndz.'" class="btn btn-default btn-small btn-edit glyphicon glyphicon-pencil" data-toggle="modal"></button>
        <button type="button" id="'.$idz.'" class="btn btn-default btn-select btn-small" style="display:none"><input id="'.$idy.'" type="checkbox" unchecked style="display:inline;"/>选择</button>
      </td>';
      echo "</tr>";
    }
  }
  echo "<tr>";
  echo " 
    <td colspan=9>
      加权影响因子：<span id='totalIF'>$total</span>; 一作影响因子：$firstot; 一作最高影响因子：$firstmax
    </td>";
  echo "</tr>";
  echo "<p id='ntrs' style='display:none'>{$count}</p>";
?>
