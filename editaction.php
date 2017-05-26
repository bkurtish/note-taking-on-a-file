<?php

require_once("classes/NoteRepository.php");

$id = $_POST['id'];
$title = trim($_POST['title']);
$body = trim($_POST['body']);
$author = trim($_POST['author']);
if(empty($title) || empty($body) || empty($author)) {
	session_start();
	$_SESSION['errors'] = true;
	header("Location: edit.php?id=".$id);
}
else {
	$noteRepository = new bkurtish\as2\NoteRepository();
	$note = $noteRepository->getNoteByID($id);
	$note->title = $title;
	$note->body = $body;
	$note->author = $author;
	$note->charCount = strlen($body);
	$note->date = date("Y-m-d H:i:s");
	$noteRepository->editNote($note);
	header("Location: index.php");

}

?>