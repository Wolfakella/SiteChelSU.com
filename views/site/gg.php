<?php
	echo '<div class="col-lg-3"><table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Студенты</th>
    </tr>
  </thead>';
foreach ($student as $value){
 echo "<tr>";
  echo "<td>".$value."</td>";
}
echo '</table></div>'
?>
