<?php

namespace alcamo\xml_conf;

use alcamo\conf\FileParserInterface;
use alcamo\dom\psvi\Document;

/**
 * @brief Parser for XML files
 *
 * @date Last reviewed 2026-06-22
 */
class XmlFileParser implements FileParserInterface
{
    public const DOCUMENT_CLASS = Document::class;

    private $documentClass_; ///< string

    public function __construct(?string $documentClass = null)
    {
        $this->documentClass_ = $documentClass ?? static::DOCUMENT_CLASS;
    }

    public function getDocumentClass(): string
    {
        return $this->documentClass_;
    }

    public function parse(string $pathname, ?int $flags = null)
    {
        return ($this->documentClass_)::newFromPathname($pathname);
    }
}
