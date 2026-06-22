<?php

namespace alcamo\xml_conf;

use alcamo\conf\FileParserInterface;
use alcamo\dom\psvi\Document;
use alcamo\uri\FileUriFactory;

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

    public function parse(string $path, ?int $flags = null)
    {
        return ($this->documentClass_)::newFromUri(
            (new FileUriFactory())->create($path)
        );
    }
}
