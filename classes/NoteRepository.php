<?php

namespace bkurtish\as2;

require_once("INoteRepository.php");

class NoteRepository implements INoteRepository {

	private $filename = "data.txt";
	public function getNoteByID($id) {
		$allNotes = $this->getAllNotes();
		foreach($allNotes as $note) {
			if($id===$note->id) {
				return $note;
			}
		}
		return null;
	}

	public function getAllNotes() {
		$myfile = fopen($this->filename, "r") or die("Unable to open file!");
		$stringData = fread($myfile,filesize($this->filename));
		$result = json_decode($stringData);
		return $result;
	}

	public function addNote($note) {
		$note->title = htmlspecialchars($note->title);
		$note->body = htmlspecialchars($note->body);
		$allNotes = $this->getAllNotes();
		$allNotes[] = $note;
		$this->serializeAndWriteNotes($allNotes);
	}

	public function editNote($note) {
		$note->title = htmlspecialchars($note->title);
		$note->body = htmlspecialchars($note->body);
		$allNotes = $this->getAllNotes();
		for($i=0;$i<count($allNotes);$i++) {
			if($note->id === $allNotes[$i]->id) {
				$allNotes[$i] = $note;
				break;
			}
		}
		$this->serializeAndWriteNotes($allNotes);
	}

	public function deleteNoteByID($id) {
		$allNotes = $this->getAllNotes();
		for($i=0; $i<count($allNotes); $i++) {
			if($id === $allNotes[$i]->id) {
				unset($allNotes[$i]);
				break;
			}
		}
		$this->serializeAndWriteNotes($allNotes);
	}

	private function serializeAndWriteNotes($notes) {
		$serializedNotes = json_encode($notes);
		$myfile = fopen($this->filename, "w") or die("Unable to open file!");
		fwrite($myfile,$serializedNotes);
	}
}