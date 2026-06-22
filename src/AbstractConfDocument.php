<?php

namespace alcamo\xml_conf;

use alcamo\dom\psvi\Document;

/**
 * @brief Base class for configuration document classes
 *
 * @date Last reviewed 2026-01-22
 */
abstract class AbstractConfDocument extends Document implements
    ConfDocumentInterface
{
    use ConfDocumentTrait;
}
