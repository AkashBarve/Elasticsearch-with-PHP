<?php

require_once(realpath(dirname(__FILE__) . '/../app/init.php'));


if(!empty($_POST)) {
	
	if(isset($_POST['title'], $_POST['body'], $_POST['keywords'])) {
	
		$title = $_POST['title'];
		$body = $_POST['body'];
		$keywords = explode(',', $_POST['keywords']);

		$indexed = $es->index([
			'index' => 'articles',
			'type' => 'article',
			
			'body' => [
				'title' => $title,
				'body' => $body,
				'keywords' => $keywords
			]
		]);
		
		if($indexed) {
			print_r($indexed);
		}
	}
}

?>


<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Add | ES</title>
		
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
	<b> Add data to the index</b>
		<form action="add.php" method="post" autocomplete="off">
			<label>
				Title
				<input type="text" name="title">
			</label>
			<p>
			<label>
				Body
				<textarea name="body" rows="8"></textarea>
			</label>
			<p>
			<label>
				Keywords
				<input type="text" name="keywords" placeholder="comma, separated">
			</label>
			
			<input type="submit" value="Add">
		</form>
	</body>
</html>