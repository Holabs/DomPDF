<?php


namespace Holabs;

use Dompdf\Dompdf as OriginalDompdf;
use Nette\Application\IResponse;
use Nette\Http\IRequest;
use Nette\Http\IResponse as INetteResponse;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/dompdf
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class DomPDF extends OriginalDompdf implements IResponse {


	/**
	 * Sends response to output.
	 * @param IRequest       $httpRequest
	 * @param INetteResponse $httpResponse
	 * @return void
	 */
	function send(IRequest $httpRequest, INetteResponse $httpResponse) {

		$this->render();
		$httpResponse->setContentType('application/pdf');
		if (strpos($httpRequest->getHeader('User-Agent'), 'MSIE') != FALSE) {
			$httpResponse->setHeader('Pragma', 'private');
			$httpResponse->setHeader('Cache-control', 'private');
			$httpResponse->setHeader('Accept-Ranges', 'bytes');
			$httpResponse->setExpiration('- 5 years');
		}
		echo $this->output();
	}
}