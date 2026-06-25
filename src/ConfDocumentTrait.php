<?php

namespace alcamo\xml_conf;

use alcamo\uri\FileUriFactory;

/**
 * @brief Trait for configuration document classes
 *
 * @date Last reviewed 2026-06-22
 */
trait ConfDocumentTrait
{
    /**
     * @brief Create a default configuration document
     *
     * @param $defaultPathname Pathname of default file. Must be well-formed
     * but does not need to be valid. This method makes a valid document out
     * of it.
     *
     * @param $xsdPathname Pathname of XSD file to validate configuration
     * file. If specified, create an `xsi:schemaLocation` attribute.
     *
     * Create a `dc:created` attribute in the document element.
     */
    public static function createDefaultConfDocument(
        string $docPathname,
        ?string $xsdPathname = null
    ): self {
        $fileUriFactory = new FileUriFactory();

        $doc = self::newFromUri($fileUriFactory->create($docPathname));

        if (isset($xsdPathname)) {
            $doc->documentElement->setAttributeNS(
                self::XSI_NS,
                'xsi:schemaLocation',
                $doc->documentElement->namespaceURI . ' '
                . $fileUriFactory->create($xsdPathname)
            );
        }

        $doc->documentElement
            ->setAttributeNS(self::DC_NS, 'dc:created', date('c'));

        return $doc;
    }

    /**
     * @brief Call __get
     *
     * This leaves complete freedom to implement __get() a needed. For
     * instance, __get() might evaluate different parts of the configuration
     * file dpeneding on the option.
     */
    public function __isset(string $optionName): bool
    {
        return $this->__get($optionName) !== null;
    }

    /// Register the document element's namespace as XPath prefix `c`
    protected function afterLoad(): void
    {
        parent::afterLoad();

        $this->formatOutput = true;

        $this->getXPath()
            ->registerNamespace('c', $this->documentElement->namespaceURI);
    }
}
