<?php
class Note {
	/**
	 * @var string $noteContent
	 */
	private $noteContent;

	/**
	 * @var int noteNoteTypeId
	 */
	private $noteNoteTypeId;
	/**
	 * @var int $noteStudentId
	 */
	private $noteStudentId;
	/**
	 * @var int $noteId
	 */
	private $noteId;

	/**
	 * Note constructor.
	 * @param string $newNoteContent
	 * @param int $newNoteNoteTypeId
	 * @param int $newNoteStudentId
	 * @param int $newNoteId
	 */
	public function __construct(string $newNoteContent, int $newNoteNoteTypeId, int $newNoteStudentId, int $newNoteId) {
		try {
			$this->setNoteContent($newNoteContent);
			$this->setNoteId($newNoteId);
			$this->setNoteNoteTypeId($newNoteNoteTypeId);
			$this->setNoteStudentId($newNoteStudentId);
		}
	}

	/**
	 * @return mixed
	 */
	public function getNoteContent() {
		return $this->noteContent;
	}

	/**
	 * @return mixed
	 */
	public function getNoteId() {
		return $this->noteId;
	}

	/**
	 * @return mixed
	 */
	public function getNoteNoteTypeId() {
		return $this->noteNoteTypeId;
	}

	/**
	 * @return mixed
	 */
	public function getNoteStudentId() {
		return $this->noteStudentId;
	}

	/**
	 * @param mixed $noteContent
	 */
	public function setNoteContent($noteContent) {
		$this->noteContent = $noteContent;
	}

	/**
	 * @param mixed $noteId
	 */
	public function setNoteId($noteId) {
		if ($noteId <= 0) {
			throw(new \RangeException("nodeId can't be 0 or negative."));
		}

		$this->noteId = $noteId;
	}

	/**
	 * @param mixed $noteNoteTypeId
	 */
	public function setNoteNoteTypeId($noteNoteTypeId) {
		if ($noteNoteTypeId < 0) {
			throw(new \RangeException("Note Type Id can't be negative."));
		}
		$this->noteNoteTypeId = $noteNoteTypeId;
	}

	/**
	 * @param mixed $noteStudentId
	 */
	public function setNoteStudentId($noteStudentId) {
		if ($noteStudentId < 0) {
			throw(new \RangeException("Note Type Id can't be negative."));
		$this->noteStudentId = $noteStudentId;
	}


}