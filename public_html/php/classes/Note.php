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
	 * @throws Exception
	 * @throws TypeError
	 */
	public function __construct(string $newNoteContent, int $newNoteNoteTypeId, int $newNoteStudentId, int $newNoteId) {
		try {
			$this->setNoteContent($newNoteContent);
			$this->setNoteId($newNoteId);
			$this->setNoteNoteTypeId($newNoteNoteTypeId);
			$this->setNoteStudentId($newNoteStudentId);
		} catch(InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
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
	 * @param string $newNoteContent
	 */
	public function setNoteContent(string $newNoteContent) {
		$this->noteContent = $newNoteContent;
	}

	/**
	 * @param int $newNoteId
	 */
	public function setNoteId(int $newNoteId) {
		if($newNoteId <= 0) {
			throw(new \RangeException("nodeId can't be 0 or negative."));
			$this->noteId = $newNoteId;
		}
	}

	/**
	 * @param int $newNoteNoteTypeId
	 */
	public function setNoteNoteTypeId(int $newNoteNoteTypeId) {
		if($newNoteNoteTypeId < 0) {
			throw(new \RangeException("Note Type Id can't be negative."));
		}
		$this->noteNoteTypeId = $newNoteNoteTypeId;
	}

	/**
	 * @param int $newNoteStudentId
	 */
	public function setNoteStudentId(int $newNoteStudentId) {
		if($newNoteStudentId < 0) {
			throw(new \RangeException("Note Type Id can't be negative."));

		}
		$this->noteStudentId = $newNoteStudentId;
	}
}