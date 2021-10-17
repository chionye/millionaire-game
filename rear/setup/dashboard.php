<?php
require_once ("../../database/connect.php");
// if(isset($_POST['getChart'])){
// 	$y10 = date('Y')-10;
// 	$from_ = new DateTime("$y10-01-01 00:00:00");
// 	$to_ = new DateTime(date("Y-m-d H:i:s"));
// 	$from = $from_->format('Y-m-d H:i:s');
// 	$to = $to_->format('Y-m-d H:i:s');
// 	$row = array();
// 	$pgquery = $db->query("SELECT DISTINCT YEAR(date_admitted) AS year, COUNT(id) as num FROM students WHERE DATE(date_admitted) between '$from' and '$to' GROUP BY year ORDER BY year ASC") or die($db->error);
// 	while($rowview = $pgquery->fetch_assoc()){
// 		$row[] = $rowview;
// 	}
// 	echo json_encode($row);
// 	die();
// }else{

// 	$build1 = array(['Schools','school'], ['Students','people'], ['Teachers','person_outline'],['Officers','contact_phone']);
// 	$query1 = "SELECT COUNT(id) as num FROM schools
// 		UNION SELECT COUNT(id) as num FROM students
// 		UNION SELECT COUNT(id) as num FROM teachers
// 		UNION SELECT COUNT(id) as num FROM support_officer
// 	";
// 	$con1 = $db->query($query1) or die($db->error);
// 	$c = 0;

// 	while($row = $con1->fetch_assoc()){
// 		$build1[$c][2] = empty($row['num']) ? 0 : $row['num'] ;
// 		$c++;
// 	}
// 	foreach($build1 as $l => $g){
// 		$build1[$l][2] = !isset($build1[$l][2]) ? 0 : $build1[$l][2];
// 	}
// 	$query2 = "SELECT 
// 	schools.id, schools.name, count(students.id) as num_student,  count(teachers.id) as num_teacher ,count(class.id) as num_class
// 		FROM schools 
// 		LEFT JOIN students ON students.school_id=schools.id 
// 		LEFT JOIN teachers ON teachers.school_id=schools.id
// 		LEFT JOIN class ON class.school_id=schools.id
// 	GROUP BY schools.id" 
// 	;
// 	$con2 = $db->query($query2) or die($db->error);
// 	$c = 0;
// 	if($con2->num_rows > 0){
// 		while($row = $con2->fetch_assoc()){
// 			$row['name'] = strtolower($row['name']);
// 			$tats[] = $row;
// 		}
// 	}else{
// 		$tats = array();
// 	}
	
	
// }
//echo json_encode($build1);
?>

<div class="" style="background-color: #ecf0f5; min-height: 100vh">
	<div class="dashboard">
		<div class="row">
			<!-- <?php// foreach($build1 as $c => $item){?> -->
			<div class="col s3">
				<div class="info-box hoverable pointer">
				<span class="info-box-icon  <?=$_color[$c+2]?>"><img style="height: 70px" class="iconPad" src="icons/<?php echo $item[1]; ?>.svg" /></span>
				<div class="info-box-content">
				  <span class="info-box-text">Total Number of <?=0//$item[0]?></span>
				  <span class="info-box-number"><?=3//$item[2]?></span>
				</div>
			  </div>
			</div>
			<!-- <?php// } ?> -->
		</div>
		<div class="graph row ">
			<canvas id="myChart" style="width:100%; height: 400px !important;background: gray;"></canvas>
			<h4>Accounting Chart</h4>
		</div>
		<div class="stats row ">
			<div class="white stat-title"><b>Stats per School</b></div>
			<div class="table-holder">
				<table class="stats white bordered">
					<thead>
						<th style="padding-right: 20px">S/N</th>
						<th>School List</th>
						<th>Total no of students</th>
						<th>Total no of Teachers</th>
						<th>Total no of Classes</th>
					</thead>
					<tbody>
				
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>









<script>

$(document).ready(function(){
	$.post('setup/dashboard.php',{'getChart':true},function(response){
		var ctx = $('#myChart');
		var data = isJson(response);
		if(data !== false){ 
			var labels = [];
			var dat = [];
			if(!data){data = [];}
			if(data.length == 1){labels.push(parseInt(data[0].year)-parseInt(1));dat.push(0);}
			else if(data.length == 0){
				var d = new Date();
				var n = d.getFullYear()
				for(var i=1; i<=2; i++){
					labels.push(parseInt(n )-parseInt(i));dat.push(0);
				}
			}
			$.each(data, function(key, value){
				dat.push(value.num);
				labels.push(value.year);
			});
			var chart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: labels,
					datasets: [{
						label: "Number of admitted students",
						backgroundColor: '#1B74DA',
						borderColor: 'orange',
						data: dat,
					}]
				},
				options: {}
			});
		}else{console.log(response)}
	});
});
function isJson(str) {
	if(!str){
		return false;
	}else{
		try {
			var data = JSON.parse(str);
			var type = typeof(data);
			if(type.toLowerCase() !== 'object'){
				return false;
			}else{return data;}
		} catch (e) {
			//alert(e)
			return false;
		}
	}
}
</script>