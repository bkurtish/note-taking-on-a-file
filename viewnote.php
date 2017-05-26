<?php 
require_once("classes/Note.php");
require_once("classes/NoteRepository.php");

$id = $_GET['id'];
$noteRepository = new bkurtish\as2\NoteRepository();
$note = $noteRepository->getNoteByID($id);

?>
<!doctype html>
<html>
<body background="./images/back_img.jpg">
<head>
	<meta charset="utf=8">
	<title>Note App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php 
if($note === null): ?>
	<p>No note found with the given ID</p>
<?php else: ?>
<div class="note-container">
	<div class="note">
		<h3 class="note-title"><a href="viewnote.php?id=<?php echo $note->id; ?>"><?php echo $note->title; ?></a></h3>

					<div class="icon2">
			<a class="icon" href="edit.php?id=<?php echo $note->id; ?>"><img src="images/edit.png"/></a>
			<a class="icon" href="delete.php?id=<?php echo $note->id; ?>"><img src="images/delete.png"/></a>
			</div>
			<h5 class="note-author">Author: <?php echo $note->author; ?></h5>
		<div class="note-body-full">
			<?php echo $note->body; ?>
		</div>
		<div class="note-additional-info">
			<p>Note body character count: <?php echo $note->charCount; ?></p>
			<p>Note last modified on: <?php echo $note->date; ?></p>
		</div>
	</div>
</div>
<?php endif; ?>
	<p class="new-note1"><a href="index.php">BACK TO MY NOTES</a></p>
</body>
</html>