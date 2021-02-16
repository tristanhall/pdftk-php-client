# README #

## Contribution guidelines ##

1. Update the version constant in the `ApiClient` class.
2. Update the version in `composer.json`
3. Tag the commit with the same version number.

## Requirements ##
* `php: >=7.4.0`
* `illuminate/support: >=5.0.0`
* `guzzlehttp/guzzle: ^7.2`
* `konekt/enum: ^3.1`
* `ext-json: *`

## Installing ##

`composer require minutemanservices/pdftk-php-client`

### Laravel Setup ###

`php artisan vendor:publish --provider=MinuteMan\PdftkClient\PdftkServiceProvider`

## Usage ##

### 1. Create a Document ### 

First, create a new instance of the `ApiClient` class and provide the URL of the PDFtk microservice API and your access key.
```php
$apiClient = new MinuteMan\PdftkClient\ApiClient($apiUrl, $apiKey);
```

Then, create an instance of `PdftkDocument` for each PDF you want to generate.

Pass the instance of the `ApiClient` class to the PDF document instance.

```php
$pdfDocument = new MinuteMan\PdftkClient\PdftkDocument($apiClient);
```

### Laravel ###

In Laravel, you can create a document instance without having to create an `ApiClient` instance.

```php
$pdfDocument = app()->make(MinuteMan\PdftkClient\PdftkDocument::class);
```

### 2. Provide the Source PDF ###

You must provide a PDF upon which the API will perform commands. You can do this in 1 of 3 ways:

#### Remote URL ####

```php
$sourcePdf = new MinuteMan\PdftkClient\PdfSources\RemoteUrl('https://www.google.com/');
$pdfDocument->setSourcePdf($sourcePdf);
```

#### Local File Path ####

```php
$sourcePdf = new MinuteMan\PdftkClient\PdfSources\File(__DIR__ . '/example.pdf');
$pdfDocument->setSourcePdf($sourcePdf);
```

#### Stream Resource ####

```php
$sourcePdf = new MinuteMan\PdftkClient\PdfSources\Stream(fopen('example.pdf'));
$pdfDocument->setSourcePdf($sourcePdf);
```

### 3. Specify a Command ###

You must specify a command for the PDFtk API to execute on the PDF.
Available Commands:

* FillForm
* Rotate
* Background
* Multibackground
* Stamp
* Multistamp

```php
$command = new MinuteMan\PdftkClient\Commands\FillForm(['first_name' => 'Jane']);
$pdfDocument->setCommand($command);
```

### 4. Configure Flags and Options (Optional) ###

```php
$pdfDocument->setFlatten();
$pdfDocument->setUserPw('123456');

// Method chaining is supported
$pdfDocument->setNeedAppearances()->setInputPw();
```

Unset a flag or option: `$pdfDocument->unsetFlatten();` or `$pdfDocument->unsetUserPw();`

### 5. Generate the PDF ###

Save the PDF as a file by providing an absolute path: `$pdfDocument->save(__DIR__ . '/finalized.pdf');`

You can also generate the PDF and return it as a stream resource: `$pdfDocument->getStream();`

## Options & Flags ##

Visit the PDFtk Server Manual to read about each individual flag: https://www.pdflabs.com/docs/pdftk-man-page/

### Available Flags ###

* `setInputPw()` / `unsetInputPw()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-input-pw
* `setEncrypt40bit()` / `unsetEncrypt40bit()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-output-enc-strength
* `setEncrypt128bit()` / `unsetEncrypt128bit()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-output-enc-strength
* `setFlatten()` / `unsetFlatten()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-output-flatten
* `setNeedAppearances()` / `unsetNeedAppearances()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-output-need-appearances
* `setCompress()` / `unsetCompress()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-compress
* `setUncompress()` / `unsetUncompress()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-compress
* `setKeepFirstId()` / `unsetKeepFirstId()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-keep-id
* `setKeepFinalId()` / `unsetKeepFinalId()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-keep-id
* `setDropXfa()` / `unsetDropXfa()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-drop-xfa

### Available Options ###
* `setAllow(string $permissions)` / `unsetAllow()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-output-enc-perms
* `setOwnerPw(string $password)` / `unsetOwnerPw()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-output-enc-owner-pw
* `setUserPw(string $password)` / `setUserPw()` – https://www.pdflabs.com/docs/pdftk-man-page/#dest-output-enc-user-pw

## Command Examples ##

### FillForm ###
```php
$command = new MinuteMan\PdftkClient\Commands\FillForm(['first_name' => 'Jane']);

if (!$command->hasField('last_name')) {
    $command->setField('last_name', 'Doe');
}

if ($command->hasField('fax')) {
    $command->unsetField('fax');
}

$pdfDocument->setCommand($command);
```

### Rotate ###
```php
$command = new MinuteMan\PdftkClient\Commands\Rotate();

$command->setRotation(180)       // Integer. Default: 0. Must be multiples of 90. Maximum: 270. Minimum: -270.
         ->setStartPage(1)       // Integer. Default: 0.
         ->setEndPage(10)        // Integer or null. Default: null. Null applies rotation to every page after the start page.
         ->setQualifier('even'); // String or null. Default: null. Values can be 'even', 'odd', or null.
         
$pdfDocument->setCommand($command);
```

### Stamp, Multistamp, Background, and Multibackground ###
```php
$command = new MinuteMan\PdftkClient\Commands\Stamp();
// OR $command = new MinuteMan\PdftkClient\Commands\Multistamp();
// OR $command = new MinuteMan\PdftkClient\Commands\Background();
// OR $command = new MinuteMan\PdftkClient\Commands\Multibackground();

// Set the PDF source that will be used as the stamp or background
$sourcePdf = new MinuteMan\PdftkClient\PdfSources\RemoteUrl('https://www.google.com/');
$command->setSourcePdf($sourcePdf);

// Assign the command to the document
$pdfDocument->setCommand($command);
```