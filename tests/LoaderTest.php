<?php

namespace alcamo\xml_conf;

use PHPUnit\Framework\TestCase;

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

        $conf = $loader->createFromXmlPathnameIfNotExistsAndLoad(
            $targetFilename,
            $examplePathname,
            $xsdPathname,
            $pathname
        );

        $this->assertSame($targetPathname, $pathname);
        $this->assertNotNull($conf->documentElement->{'dc:created'});
        $this->assertSame('FOO', $conf->foo);
        $this->assertSame(42, $conf->bar->baz);
    }
}
