<?php
namespace NeosMeetupHH\ToDoList\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosMeetupHH.ToDoList". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Item {

	/**
	 * @ORM\ManyToOne
	 * @var \NeosMeetupHH\ToDoList\Domain\Model\ToDoList
	 */
	protected $list;

	/**
	 * @var string
	 */
	protected $label;

	/**
	 * @var boolean
	 */
	protected $done = FALSE;

	/**
	 * @var \DateTime
	 */
	protected $createdAt;

	public function __construct() {
		$this->createdAt = new \DateTime('now');
	}

	/**
	 * @return ToDoList
	 */
	public function getList() {
		return $this->list;
	}

	/**
	 * @param ToDoList $list
	 */
	public function setList(ToDoList $list) {
		$this->list = $list;
	}

	/**
	 * @return string
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param string $label
	 * @return void
	 */
	public function setLabel($label) {
		$this->label = $label;
	}

	/**
	 * @return boolean
	 */
	public function isDone() {
		return $this->done;
	}

	/**
	 * @return void
	 */
	public function markAsDone() {
		$this->done = TRUE;
	}

	/**
	 * @return void
	 */
	public function markAsUnDone() {
		$this->done = false;
	}

}