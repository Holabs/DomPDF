<?php


namespace Holabs\DomPDF\Bridges\Nette;

use Holabs\DomPDF\Factory;
use Nette\DI\Helpers;
use Nette\DI\Extensions\ExtensionsExtension;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/dompdf
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class DIExtension extends ExtensionsExtension {

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



	/**
'tempDir'|||'temp_dir'
'fontDir'|||'font_dir'
'fontCache'|||'font_cache'
'chroot'
'logOutputFile'|||'log_output_file'
'defaultMediaType'|||'default_media_type'
'defaultPaperSize'|||'default_paper_size'
'defaultPaperOrientation'|||'default_paper_orientation'
'defaultFont'|||'default_font'
'dpi'
'fontHeightRatio'|||'font_height_ratio'
'isPhpEnabled'|||'is_php_enabled'|||'enable_php'
'isRemoteEnabled'|||'is_remote_enabled'|||'enable_remote'
'isJavascriptEnabled'|||'is_javascript_enabled'|||'enable_javascript'
'isHtml5ParserEnabled'|||'is_html5_parser_enabled'|||'enable_html5_parser'
'isFontSubsettingEnabled'|||'is_font_subsetting_enabled'|||'enable_font_subsetting'
'debugPng'|||'debug_png'
'debugKeepTemp'|||'debug_keep_temp'
'debugCss'|||'debug_css'
'debugLayout'|||'debug_layout'
'debugLayoutLines'|||'debug_layout_lines'
'debugLayoutBlocks'|||'debug_layout_blocks'
'debugLayoutInline'|||'debug_layout_inline'
'debugLayoutPaddingBox'|||'debug_layout_padding_box'
'pdfBackend'|||'pdf_backend'
'pdflibLicense'|||'pdflib_license'
'adminUsername'|||'admin_username'
'adminPassword'|||'admin_password'
	 **/

}