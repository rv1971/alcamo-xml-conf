<?php

namespace alcamo\xml_conf;

use alcamo\uri\FileUriFactory;

/**
 * @brief Trait for configuration document classes
 *
 * @date Last reviewed 2026-01-22
 */
trait ConfDocumentTrait
{
    public static function createDefaultConfDocument(
        string $docPath,
        ?string $xsdPath = null
    ) : self {
        $fileUriFactory = new FileUriFactory();

        $doc = self::newFromUri($fileUriFactory->create($docPath));

        $doc->formatOutput = true;

        if (isset($xsdPath)) {
            $doc->documentElement->setAttributeNS(
                self::XSI_NS,
                'schemaLocation',
                $doc->documentElement->namespaceURI,
                $fileUriFactory->create($xsdPath)
            );
        }

        return $doc;
    }
}
