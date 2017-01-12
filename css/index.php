<?php

require_once(realpath(dirname(__FILE__) . '/../app/init.php'));

if(isset($_GET['q'])) {
	
	$q = $_GET['q'];
	
	$query = $es->search([
		'body' => [
			'query' => [
				'bool' => [
					'should' => [['match' => ['title' => $q]],['match' => ['body' => $q]],['match' => ['keywords' => $q]]]
				]
			]
		]
	]);

	
	if($query['hits']['total'] >=1) {
		$results = $query['hits']['hits'];
	}
}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Search | ES</title>
		
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<form action="index.php" method="get" autocomplete="off">
			<label>
				<b>Search for something</b>
				<input type="text" name="q">
			</label>
			
			<input type="submit" value="Search">
		</form>
		
		<?php
		if(isset($results)) {
			foreach($results as $r) {
			?>
				<div class="result"><br><ol>
					<b>Title:</b><a href="#<?php echo $r['_id']; ?>"><?php echo $r['_source']['title']; ?></a>
					<br><b>Body:</b><p><?php echo substr($r['_source']['body'],0,450); ?> 
					<br><b>Associated Keywords:</b><div class="result-keywords"><?php echo implode(',', $r['_source']['keywords']); ?></div>
				</div>
			<?php
			}
		}
		?>
		
	</body>
</html> 
<!--This is a comment. Add this code on line 18 to get raw search-->
	<!--echo '<pre>', print_r($query), '</pre>';
	
	die();
	echo $r['_id']
	-->
