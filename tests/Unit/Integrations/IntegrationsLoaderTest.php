<?php

namespace DDTrace\Tests\Unit\Integrations;

use DDTrace\Integrations\IntegrationsLoader;
use PHPUnit\Framework;

final class CurlHeadersMapTest extends Framework\TestCase
{
    const FRAMEWORKS = [
        'laravel',
        'symfony',
    ];

    public function testWeDidNotForgetToRegisterALibraryForAutoLoading()
    {
        $expected = $this->normalize(glob(__DIR__ . '/../../../src/DDTrace/Integrations/*', GLOB_ONLYDIR));
        $expectedButFrameworks = array_diff($expected, $this->normalize(self::FRAMEWORKS));
        $autoLoaded = $this->normalize(array_keys(IntegrationsLoader::LIBRARIES));

        // If this test fails you need to add an entry to IntegrationsLoader::LIBRARIES array.
        $this->assertEquals(array_values($expectedButFrameworks), array_values($autoLoaded));
    }

    /**
     * Normalizes integrations folders/names to a simplified format suitable for easy comparison.
     *
     * @param array $array_map
     * @return array
     */
    private function normalize(array $array_map)
    {
        return array_map(function ($entry) {
            if (strrpos($entry, '/')) {
                $name = substr($entry, strrpos($entry, '/') + 1);
            } else {
                $name = $entry;
            }
            return strtolower($name);
        }, $array_map);
    }
}
