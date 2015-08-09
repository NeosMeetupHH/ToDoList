<?php
namespace NeosMeetupHH\ToDoList\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosMeetupHH.ToDoList". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Flow\Entity
 */
class ToDoList {

    /**
     * @var ArrayCollection<Item>
     * @ORM\OneToMany(mappedBy="list",cascade={"persist"})
     * @ORM\OrderBy({"createdAt" = "ASC"})
     */
    protected $items;

    public function __construct() {
        $this->items = new ArrayCollection();
    }

    /**
     * Add a new list item
     *
     * @param Item $item
     */
    public function addItem(Item $item) {
        $item->setList($this);
        $this->items->add($item);
    }

    /**
     * Get all list items
     *
     * @return ArrayCollection
     */
    public function getItems() {
        return $this->items;
    }

}