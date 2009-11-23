<?php
/**
 * This is a file of the caretaker project.
 * Copyright 2008 by n@work Internet Informationssystem GmbH (www.work.de)
 * 
 * @Author	Thomas Hempel 		<thomas@work.de>
 * @Author	Martin Ficzel		<martin@work.de>
 * @Author	Patrick Kollodzik	<patrick@work.de> 
 * @Author	Tobias Liebig   	<mail_typo3.org@etobi.de>
 * @Author	Christopher Hlubek	<hlubek@networkteam.com>
 * 
 * $Id$
 */

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008 Martin Ficzel <ficzel@work.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class tx_caretaker_TestgroupNode extends tx_caretaker_AggregatorNode {
	
	/**
	 * Constructor 
	 * 
	 * @param integer $uid
	 * @param string $title
	 * @param tx_caretaker_AbstractNode $parent
	 * @param boolean $hidden
	 */
	public function __construct($uid, $title, $parent, $hidden=0){
		parent::__construct($uid, $title, $parent, 'Testgroup',$hidden );
	}

	/**
	 * Get the caretaker node id of this node
	 * return string
	 */
	public function getCaretakerNodeId(){
		$instance = $this->getInstance();
		return 'instance_'.$instance->getUid().'_testgroup_'.$this->getUid();
	}

	/**
	 * (non-PHPdoc)
	 * @see caretaker/trunk/classes/nodes/tx_caretaker_AggregatorNode#findChildren()
	 */
	protected function findChildren ($show_hidden=false){
		
			// read subgroups
		$node_repository = tx_caretaker_NodeRepository::getInstance();
		$subgroups = $node_repository->getTestgroupsByParentGroupUid($this->uid, $this , $show_hidden );
			// read instances
		$tests = $node_repository->getTestsByGroupUid($this->uid, $this, $show_hidden);
			// save
		$children = array_merge($subgroups, $tests);
		return $children;
	}



}

?>