<?php

namespace Brightfish\DcpToolkit\Parsers;

use Brightfish\DcpToolkit\Exceptions\InputMissingException;
use SimpleXMLElement;

class BaseParser
{
    protected SimpleXMLElement $xml;

    /**
     * @throws InputMissingException
     */
    public function __construct(string $file)
    {
        if (! file_exists($file)) {
            throw new InputMissingException("File not found: [$file]");
        }
        $this->xml = simplexml_load_file($file);
    }

    public function getXml(): SimpleXMLElement
    {
        return $this->xml;
    }

    public function Id(): string
    {
        return (string) $this->xml->Id ?? '';
    }

    public function AnnotationText(): string
    {
        return (string) $this->xml->AnnotationText ?? '';
    }

    public function ContentTitleText(): string
    {
        return (string) $this->xml->ContentTitleText ?? '';
    }

    public function IssueDate(): string
    {
        return (string) $this->xml->IssueDate ?? '';
    }

    public function Issuer(): string
    {
        return (string) $this->xml->Issuer ?? '';
    }

    public function Creator(): string
    {
        return (string) $this->xml->Creator ?? '';
    }
}
