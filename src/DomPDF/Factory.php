<?php


namespace Holabs\DomPDF;

use Dompdf\Options;
use Holabs\DomPDF;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/dompdf
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Factory {

	/** @var array|null */
	private $options;

	public function __construct(array $options = NULL) {
		$this->options = $options;
	}

	/**
	 * @return DomPDF
	 */
	public function create() {
		$options = new Options($this->options);
		return new DomPDF($options);
	}

}