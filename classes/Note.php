<?php 

namespace bkurtish\as2;

class Note 
{
	public $id;
	public $title= '';
	public $body= '';
	public $date;
	public $charCount;
	public $author;

	public function __construct() {
		$this->id = uniqid();
		$this->date = date("Y-m-d H:i:s");
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getBody()
	{
		return $this->body;
	}


	public function setBody($body)
	{
		$this->body = $body;
		$this->charCount = strlen($body);
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
	}
}