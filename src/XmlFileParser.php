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
    public const DOC_CLASS = Document::class;

    private $docClass_; ///< string

    public function __construct(?string $docClass = null)
    {
        $this->docClass_ = $docClass ?? static::DOC_CLASS;
    }

    public function parse(string $path, ?int $flags = null)
    {
        return ($this->docClass_)::newFromUri(
            (new FileUriFactory())->create($path)
        );
    }
}
