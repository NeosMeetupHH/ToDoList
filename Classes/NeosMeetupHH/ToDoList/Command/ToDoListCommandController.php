<?php
namespace NeosMeetupHH\ToDoList\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosMeetupHH.ToDoList". *
 *                                                                        *
 *                                                                        */

use NeosMeetupHH\ToDoList\Domain\Model\Item;
use NeosMeetupHH\ToDoList\Domain\Model\ToDoList;
use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class ToDoListCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \NeosMeetupHH\ToDoList\Domain\Repository\ToDoListRepository
	 */
	protected $toDoListRepository;

	/**
	 * Install fixtures for ToDoList
	 *
	 * @return void
	 */
	public function fixturesCommand() {
		$activeToDoList = new ToDoList();

		for ($i = 1; $i <= 3; $i++) {
			$item = new Item();
			$item->setLabel('Item #' . $i);
			$activeToDoList->addItem($item);
		}

		$this->toDoListRepository->add($activeToDoList);

		$this->outputLine('Successfully created fixtures');
	}

}