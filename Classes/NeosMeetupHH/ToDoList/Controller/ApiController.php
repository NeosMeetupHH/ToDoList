<?php
namespace NeosMeetupHH\ToDoList\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosMeetupHH.ToDoList". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\TypoScript\View\TypoScriptView;
use NeosMeetupHH\ToDoList\Domain\Model\Item;
use NeosMeetupHH\ToDoList\Domain\Model\ToDoList;

class ApiController extends ActionController {

	const TS_PATH_ITEM = 'NeosMeetupHH/ToDoList/IndexController/index/application/content/list/content/itemRenderer';

	/**
	 * @var string
	 */
	protected $defaultViewObjectName = 'TYPO3\Flow\Mvc\View\JsonView';

	/**
	 * A list of IANA media types which are supported by this controller
	 *
	 * @var array
	 */
	protected $supportedMediaTypes = array('application/json');

	/**
	 * @var \TYPO3\Flow\Mvc\View\JsonView
	 */
	protected $view;

	/**
	 * @Flow\Inject
	 * @var \NeosMeetupHH\ToDoList\Domain\Repository\ItemRepository
	 */
	protected $itemRepository;

	/**
	 * Create a new list item
	 *
	 * @param string $label
	 * @param ToDoList $list
	 * @return void
	 */
	public function addAction($label, ToDoList $list) {
		$item = new Item();
		$item->setLabel($label);
		$item->setList($list);

		$typoScriptView = new TypoScriptView();
		$typoScriptView->setControllerContext($this->controllerContext);
		$typoScriptView->setTypoScriptPath(self::TS_PATH_ITEM);
		$typoScriptView->assign('item', $item);

		$this->itemRepository->add($item);
		$this->view->assign('value', array(
			'type' => 'success:add',
			'entity' => get_class($item),
			'view' => $typoScriptView->render()
		));
	}

	/**
	 * Update an existing list item
	 *
	 * @param Item $item
	 * @return void
	 */
	public function updateAction(Item $item) {
		$item->setList($list);
		$this->itemRepository->update($item);
		$this->view->assign('value', array(
			'type' => 'success:update',
			'entity' => get_class($item)
		));
	}

	/**
	 * Remove an existing list item
	 *
	 * @param Item $item
	 * @return void
	 */
	public function removeAction(Item $item) {
		$this->itemRepository->remove($item);
		$this->view->assign('value', array(
			'type' => 'success:remove',
			'entity' => get_class($item)
		));
	}

	/**
	 * Mark a list item as done
	 *
	 * @param Item $item
	 * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
	 */
	public function doAction(Item $item) {
		$item->markAsDone();
		$this->itemRepository->update($item);

		$this->view->assign('value', array(
			'type' => 'success:do',
			'entity' => get_class($item)
		));
	}

	/**
	 * Mark a list item as undone
	 *
	 * @param Item $item
	 * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
	 */
	public function undoAction(Item $item) {
		$item->markAsUnDone();
		$this->itemRepository->update($item);

		$this->view->assign('value', array(
			'type' => 'success:undo',
			'entity' => get_class($item)
		));
	}

}