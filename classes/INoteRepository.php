<?php 
namespace bkurtish\as2;

interface INoteRepository {
	public function getAllNotes();
	public function getNoteByID($id);
	public function addNote($note);
	public function deleteNoteByID($id);
	public function editNote($note);
}