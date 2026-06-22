<?php

namespace alcamo\xml_conf;

use alcamo\conf\Loader as BaseLoader;

/**
 * @brief Configuration file loader using alcamo::xml_conf::XmlFileParser as
 * default parser
 *
 * @date Last reviewed 2026-06-22
 */
class Loader extends BaseLoader
{
    /// Default file parser class
    public const DEFAULT_FILE_PARSER_CLASS = XmlFileParser::class;

    /// Create a loader for a document class
    public static function newFromDocumentClass(string $class): self
    {
        return new self(null, new XmlFileParser($class));
    }

    /**
     * @brief If there is no file, copy a default file to the default
     * directory; then load it
     *
     * @param $targetFilename File to look for as input to
     * alcamo::conf::XdgFileFinder::find().
     *
     * @param $defaultPathname Pathname of default file.
     *
     * @param $xsdPathname Pathname of XSD file to validate configuration file.
     *
     * @param [out] $pathname If a new file has been created, pathname of the
     * new file, else `null`.
     *
     * @param $flags If $flags & alcamo::conf::LoaderInterface::CONFIDENTIAL,
     * ensure that only the user can access the new file.
     *
     * @return Parsed file content.
     */
    public function createFromXmlPathnameIfNotExistsAndLoad(
        string $targetFilename,
        string $defaultPathname,
        ?string $xsdPathname = null,
        ?string &$pathname = null,
        ?int $flags = null
    ) {
        return $this->createIfNotExistsAndLoad(
            $targetFilename,
            function () use ($defaultPathname, $xsdPathname) {
                return (
                    $this->getFileParser()->getDocumentClass()
                )::createDefaultConfDocument(
                    $defaultPathname,
                    $xsdPathname
                )->saveXML();
            },
            $pathname,
            $flags
        );
    }
}
