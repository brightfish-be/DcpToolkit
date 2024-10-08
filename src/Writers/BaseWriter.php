<?php

namespace Brightfish\DcpToolkit\Writers;

use Brightfish\DcpToolkit\Exceptions\InputInvalidException;
use Brightfish\DcpToolkit\Exceptions\InputMissingException;
use Brightfish\DcpToolkit\Exceptions\OutputFailedException;
use DOMDocument;
use SimpleXMLElement;

final class BaseWriter
{
    private SimpleXMLElement $contents;

    private string $Issuer = 'Brightfish';

    private string $Creator = 'Spottix Renamer';

    private array $templates;

    public function __construct()
    {
        $templateFolder = __DIR__.'/templates';
        $xmlFiles = glob("$templateFolder/*.xml");
        foreach ($xmlFiles as $xmlFile) {
            $xmlName = basename($xmlFile, '.xml');
            $this->templates[$xmlName] = $xmlFile;
        }
    }

    /**
     * @throws InputMissingException
     */
    public function loadFromFile(string $filename): static
    {
        if (! file_exists($filename)) {
            throw new InputMissingException("File not found: [$filename]");
        }
        $this->contents = simplexml_load_file($filename);

        return $this;
    }

    /**
     * @throws InputMissingException
     */
    public function loadFromTemplate(string $name): static
    {
        if (! isset($this->templates[$name])) {
            throw new InputMissingException("Template not found: [$name]");
        }
        $this->contents = simplexml_load_file($this->templates[$name]);

        return $this;
    }

    public function loadFromText(string $text): static
    {
        $this->contents = simplexml_load_string($text);

        return $this;
    }

    /**
     * @throws OutputFailedException
     * @throws InputInvalidException
     */
    public function saveToFile(string $filename): bool
    {
        if (! isset($this->contents)) {
            throw new InputInvalidException('No contents to export');
        }
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = true;
        $dom->formatOutput = true;
        $dom->loadXML($this->contents->asXML());
        file_put_contents($filename, $dom->saveXML());
        if (! file_exists($filename) || filesize($filename) == 0) {
            throw new OutputFailedException("Could not create output file [$filename]");
        }

        return true;
    }
}
