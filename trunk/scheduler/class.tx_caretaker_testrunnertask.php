<?php

class tx_caretaker_TestrunnerTask extends tx_scheduler_Task {

	private $node_id;


	public function setNodeId($id){
		$this->node_id = $id;
	}

	public function getNodeId(){
		return $this->node_id;
	}

	public function execute() {

		$node_repository = tx_caretaker_NodeRepository::getInstance();
		$node = $node_repository->id2node($this->node_id);

		if (!$node)return false;

		$notifier = new tx_caretaker_CliNotifier();
		$node->setNotifier($notifier);

		$node->updateTestResult();

		$success = true;
		
		return $success;
	}

	public function getAdditionalInformation() {
		// return $GLOBALS['LANG']->sL('LLL:EXT:scheduler/mod1/locallang.xml:label.email') . ': ' . $this->email;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/caretaker/scheduler/class.tx_caretaker_testrunnertask.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/caretaker/scheduler/class.tx_caretaker_testrunnertask.php']);
}

?>