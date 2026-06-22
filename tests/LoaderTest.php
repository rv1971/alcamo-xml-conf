<?php

namespace alcamo\xml_conf;

use PHPUnit\Framework\TestCase;

class ConfDocument extends AbstractConfDocument
{
}

class LoaderTest extends TestCase
{
    public function testCreateFromXmlPathnameIfNotExistsAndLoad(): void
    {
        $configHome = __DIR__;

        putenv("XDG_CONFIG_HOME=$configHome");

        $targetFilename = 'conf.xml';

        $examplePathname =
            $configHome . DIRECTORY_SEPARATOR . 'example-conf.xml';

        $alcamoPath = $configHome . DIRECTORY_SEPARATOR . 'alcamo';

        $targetPathname = $alcamoPath . DIRECTORY_SEPARATOR . $targetFilename;

        $xsdPathname = $configHome . DIRECTORY_SEPARATOR . 'conf.xsd';

        if (file_exists($targetPathname)) {
            unlink($targetPathname);
        }

        $loader = new Loader(null, new XmlFileParser(ConfDocument::class));

        $data = $loader->createFromXmlPathnameIfNotExistsAndLoad(
            $targetFilename,
            $examplePathname,
            $xsdPathname,
            $pathname
        );

        $this->assertSame($targetPathname, $pathname);
        $this->assertSame('bar', $data['foo']->value);
        $this->assertNotNull($data->documentElement->{'dc:created'});
    }
}
