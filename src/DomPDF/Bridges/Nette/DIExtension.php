<?php


namespace Holabs\DomPDF\Bridges\Nette;

use Holabs\DomPDF\Factory;
use Nette\DI\Helpers;
use Nette\DI\CompilerExtension;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/dompdf
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class DIExtension extends CompilerExtension {

	public $defaults = [
		'tempDir' => '%tempDir%/cache/DomPDF.Cache',
		'fontDir' => '%tempDir%/cache/DomPDF.Font',
		'fontCache' => '%tempDir%/cache/DomPDF.Font',
		'chroot' => NULL,
		'logOutputFile' => '%tempDir%/../log/dompdf.htm',
		'defaultMediaType' => NULL,
		'defaultPaperSize' => 'a4',
		'defaultPaperOrientation' => 'portrait',
		'defaultFont' => 'serif',
		'dpi' => 96,
		'fontHeightRatio' => 1.1,
		'isPhpEnabled' => FALSE,
		'isRemoteEnabled' => FALSE,
		'isJavascriptEnabled' => TRUE,
		'isHtml5ParserEnabled' => FALSE,
		'isFontSubsettingEnabled' => FALSE,
		'debugPng' => FALSE,
		'debugKeepTemp' => FALSE,
		'debugCss' => FALSE,
		'debugLayout' => FALSE,
		'debugLayoutLines' => TRUE,
		'debugLayoutBlocks' => TRUE,
		'debugLayoutInline' => TRUE,
		'debugLayoutPaddingBox' => TRUE,
		'pdfBackend' => 'CPDF',
		'pdflibLicense' => NULL,
	];

	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();
		$config = $this->prepareConfig();

		if (!is_dir($config['tempDir'])) {
			mkdir($config['tempDir'], 0777, TRUE);
		}

		if (!is_dir($config['fontDir'])) {
			mkdir($config['fontDir'], 0777, TRUE);
		}

		if (!is_dir($config['fontCache'])) {
			mkdir($config['fontCache'], 0777, TRUE);
		}

		$builder->addDefinition($this->prefix('factory'))
			->setFactory(Factory::class)
			->setArguments([$config]);
	}

	/**
	 * @return array
	 */
	protected function prepareConfig() {
		$this->validateConfig($this->defaults);
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		foreach ($config as $k => $v) {
			if ($v === NULL) {
				unset($config[$k]);
			}
		}

		return Helpers::expand($config, $builder->parameters);
	}

}
