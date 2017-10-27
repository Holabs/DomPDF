Holabs/DomPDF
===============

[DomPDF](https://github.com/dompdf/dompdf) bridge for Nette framework



Installation
------------

**Requirements:**
 - php 5.6+
 - [Nette Framework](https://github.com/nette/nette)
 - [dompdf/dompdf](https://github.com/dompdf/dompdf)
 
```sh
composer require holabs/dompdf
```

Configuration
-------------
```yaml
extensions:
	holabs.dompdf: Holabs\DomPDF\Bridges\Nette\DIExtension

holabs.dompdf:
	defaultPaperSize: 'a4'
	# Same params as \Dompdf\Options.
	#Look at \Holabs\DomPDF\Bridges\Nette\DIExtension for default values
```

Using
-----
Usage is same as classic Dompdf but there is factory and response interface

Your **Presenter** now can looks like this:

```php
<?php

namespace App\Presenters;

use Holabs\DomPDF\Factory;
use Nette\Application\UI\Presenter;


class PDFPresenter extends Presenter {

	/** @var Factory */
	public $dompdfFactory;

	public function actionDefault() {

		$document = $this->dompdfFactory->create();
		
		$this->sendResponse($document);
	}

}
```