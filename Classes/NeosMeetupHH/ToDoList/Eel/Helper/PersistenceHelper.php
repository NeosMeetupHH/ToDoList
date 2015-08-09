<?php
namespace NeosMeetupHH\ToDoList\Eel\Helper;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosMeetupHH.ToDoList". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Eel\ProtectedContextAwareInterface;
use TYPO3\TYPO3CR\Domain\Model\NodeInterface;

/**
 * Persistence helpers for Eel contexts
 *
 */
class PersistenceHelper implements ProtectedContextAwareInterface {

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * Returns the (internal) identifier for the object
     *
     * @param $object
     * @return mixed
     */
    public function identity($object) {
        return $this->persistenceManager->getIdentifierByObject($object);
    }

    /**
     * All methods are considered safe
     *
     * @param string $methodName
     * @return boolean
     */
    public function allowsCallOfMethod($methodName) {
        return TRUE;
    }
}
