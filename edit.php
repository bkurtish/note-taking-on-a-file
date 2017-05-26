<?php 


require_once("classes/Note.php");
require_once("classes/NoteRepository.php");
$id = "";
$errors = false;
$note = null;
if($_SERVER['REQUEST_METHOD'] == "GET") {
	$id = $_GET['id'];
	$noteRepository = new bkurtish\as2\NoteRepository();
	$note = $noteRepository->getNoteByID($id);

}
else {
	$id = $_POST['id'];
	$title = trim($_POST['title']);
	$body = trim($_POST['body']);
	$author = trim($_POST['author']);
	$noteRepository = new bkurtish\as2\NoteRepository();
	$note = $noteRepository->getNoteByID($id);
	if(empty($title) || empty($body) || empty($author) || $note === null) {
		$errors = true;
	}
	else {
		$note->title = $title;
		$note->body = $body;
		$note->author = $author;
		$note->charCount = strlen($body);
		$note->date = date("Y-m-d H:i:s");
		$noteRepository->editNote($note);
		header("Location: viewnote.php?id=".$id);

	}
}
?>

<!DOCTYPE html>
<html lang="en">
<body background="./images/edit_back.png">
<head>
	<meta charset="UTF-8">
	<title>Edit note</title>
	<link rel="stylesheet" href="css/style1.css">
</head>
<body>
<?php if($note === null): ?>
	<p>No note found with the given ID</p>
<?php else: ?>
<h1 class="edittitle">Edit Note</h1>
<?php if($errors === true): ?>
	<p class="error">THERE WERE ERRORS IN YOUR SUBMISSION</p>
<?php endif; ?>
	<center><form method="post" action="edit.php" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<label class="title">Note Title*:</label> <input type="text" name="title" value="<?php echo $note->title; ?>">
		<br>
		<label class="body">Note Body*:</label> <textarea name="body"><?php echo $note->body; ?></textarea>
		<br>
		<label class="author">Note Author*:</label><input type="text" name="author" value="<?php echo $note->author; ?>">
		<br>
		<input type="submit" value="Edit Note">
		<input type="submit" value="Back">
	</form></center>	
<p class="muted"> * means a required field</p>
<?php endif; ?>
</body>
</html>