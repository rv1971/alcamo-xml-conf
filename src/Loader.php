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
}
