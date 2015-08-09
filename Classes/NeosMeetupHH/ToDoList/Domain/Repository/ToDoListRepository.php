<?php
namespace NeosMeetupHH\ToDoList\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosMeetupHH.ToDoList". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class ToDoListRepository extends Repository {

    /**
     * Get the active list - it's the first found for now
     *
     * @return \NeosMeetupHH\ToDoList\Domain\Model\ToDoList
     */
	public function findActive() {
        return $this->findAll()->getFirst();
    }

}