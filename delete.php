<?php 


require_once("classes/Note.php");
require_once("classes/NoteRepository.php");
$id = "";
$errors = false;
$note = null;
$noteRepository = new bkurtish\as2\NoteRepository();
if($_SERVER['REQUEST_METHOD'] == "GET") {
	$id = $_GET['id'];
	$note = $noteRepository->getNoteByID($id);
}
else {
	$id = $_POST['id'];
	$noteRepository->deleteNoteByID($id);
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit note</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="note-container">
	<div class="note">
		<h3 class="note-title"><a href="viewnote.php?id=<?php echo $note->id; ?>"><?php echo $note->title; ?></a></h3>
			<h5 class="note-author">Author: <?php echo $note->author; ?></h5>
		<div class="note-body">
			<?php echo $note->body; ?>
		</div>
		<div class="note-additional-info">
			<p>Note body character count: <?php echo $note->charCount; ?></p>
			<p>Note last modified on: <?php echo $note->date; ?></p>
		</div>
	</div>
</div>
	<center><div class="yesno"><form method="post" action="delete.php">
	<h3>Are you sure you want to delete this note?</h3>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" value="Yes">
	</form>
	<a href="viewnote.php?id=<?php echo $id; ?>"><button class="nobutton">No</button></a>
	</div></center>
</body>
</html>