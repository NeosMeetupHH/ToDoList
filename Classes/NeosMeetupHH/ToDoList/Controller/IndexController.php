<?php
namespace NeosMeetupHH\ToDoList\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosMeetupHH.ToDoList". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;

class IndexController extends ActionController {

	/**
	 * @var string
	 */
	protected $defaultViewObjectName = 'TYPO3\TypoScript\View\TypoScriptView';

	/**
	 * @var \TYPO3\TypoScript\View\TypoScriptView
	 */
	protected $view;

	/**
	 * @Flow\Inject
	 * @var \NeosMeetupHH\ToDoList\Domain\Repository\ToDoListRepository
	 */
	protected $toDoListRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$toDoList = $this->toDoListRepository->findActive();
		$this->view->assign('list', $toDoList);
	}

}