<?php 


require_once("classes/Note.php");
require_once("classes/NoteRepository.php");

$noteBody = '';
$noteTitle = '';
$noteAuthor = '';

$noteTitle = isset($_POST['title']) ? trim($_POST['title']) : '';
$noteBody = isset($_POST['body']) ? trim($_POST['body']) : '';
$noteAuthor = isset($_POST['author']) ? trim($_POST['author']) : '';

//Validate form fields
$formIsValid = true;
$titleErr = '';
$bodyErr = '';
$authorErr = '';

if (empty($noteTitle)){
    $formIsValid = false;
    $titleErr = '<span style="color: #f00;">Title is required!</span>';
}
if (empty($noteBody)){
    $formIsValid = false;
    $bodyErr = '<span style="color: #f00;">Body is required!</span>';
}
if (empty($noteAuthor)){
    $formIsValid = false;
    $authorErr = '<span style="color: #f00;">Author is required!</span>';
}

?>

<!DOCTYPE html>
<html lang="en">
<body background="./images/back_img.jpg">
<head>
	<meta charset="UTF-8">
	<title>Add new note</title>
	<link rel="stylesheet" href="css/style1.css">
</head>
<center><body>
	<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
			<?php if ($formIsValid): ?>
				<?php
					$newNote = new bkurtish\as2\Note();
					$newNote->setTitle($noteTitle);
					$newNote->setBody($noteBody);
					$newNote->setAuthor($noteAuthor);
					$noteRepository = new bkurtish\as2\NoteRepository();
					$noteRepository->addNote($newNote);

				?>
		        <div class="new-note-created"><h1>New Note Created</h1></div>
		        <div class="new-note-created-body"><p>Title: <?php print htmlspecialchars($noteTitle); ?></p>
		        <div class="new-note-created-body-body"><p>Body: <?php print htmlspecialchars($noteBody); ?></p></div>
		        <p>Author: <?php print htmlspecialchars($noteAuthor); ?></p></div>
		        <div class="showallnotes"><h3><a href="index.php">Show All Notes</a></h3></div>
		    <?php else: ?>
				<h1>Create New Note</h1>
				<form action="create.php" method="post">
				<label>Note Title:</label> <input type="text" name="title" value="<?php print $noteTitle; ?>">
				<?php print $titleErr; ?> <br>
				<label>Note Body:</label> <textarea type="text" name="body" value="<?php print $noteBody; ?>"></textarea>
				<?php print $bodyErr; ?> <br>
				<label>Note Author:</label> <input type="text" name="author" value="<?php print $noteAuthor; ?>">
				<?php print $authorErr; ?>
								
				<input type="submit" value="Submit">
			</form>
		<?php endif; ?>
<?php else: ?>
	<div class="create-image"><img src="./images/edittitle.png" /></div>
	<div class="create-note"><h1>Create New Note</h1></div>
	<form method="post" action="create.php">
		<label>Note Title*:</label> <input type="text" name="title">
		<br>
		<label>Note Body*:</label> <textarea name="body"></textarea>
		<br>
		<label>Note Author*:</label> <input type="text" name="author">
	<input type="submit" value="Save Note">
	<input type="button" onclick="history.back();" value="Back">
	</form>		
	<p class="muted"> * means a required field</p>
<?php endif; ?>
</body>
</center>
</html>