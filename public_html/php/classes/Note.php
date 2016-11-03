<?php
class Note {

	private $noteContent;
	private $noteNoteTypeId;
	private $noteStudentId;
	private $noteId;

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
		if (noteId <= 0) {
			throw(new \RangeException("nodeId can't be 0 or negative."));
		}

		$this->noteId = $noteId;
	}

	/**
	 * @param mixed $noteNoteTypeId
	 */
	public function setNoteNoteTypeId($noteNoteTypeId) {
		$this->noteNoteTypeId = $noteNoteTypeId;
	}

	/**
	 * @param mixed $noteStudentId
	 */
	public function setNoteStudentId($noteStudentId) {
		$this->noteStudentId = $noteStudentId;
	}


}