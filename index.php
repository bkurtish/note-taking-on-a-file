<?php 
date_default_timezone_set('America/Chicago');
$day = date ('l, F j, Y - H:i:s');

require_once("classes/Note.php");
require_once("classes/NoteRepository.php");

$noteRepository = new bkurtish\as2\NoteRepository();
$notes = $noteRepository->getAllNotes();
$notes = array_reverse($notes);

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
<h1 class="page-heading">My Notes</h1>
<p class="new-note"><a href="create.php">ADD NEW NOTE</a></p>
<div class="note-container">
	<?php foreach($notes as $note): ?>
		<div class="note" style="background-image: url(./images/note_bac.jpg); height: 185px; width: 100%; border-radius:25px; padding:10px;">
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
	<?php endforeach; ?>
	
</div>
<?php

?>
</body>
</html>