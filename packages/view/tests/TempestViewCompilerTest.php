<?php

namespace Tempest\View\Tests;

use PHPUnit\Framework\TestCase;
use Tempest\Container\GenericContainer;
use Tempest\Core\AppConfig;
use Tempest\View\Elements\ElementFactory;
use Tempest\View\Elements\GenericElement;
use Tempest\View\Parser\TempestViewLexer;
use Tempest\View\Parser\TempestViewParser;
use Tempest\View\ViewConfig;

final class TempestViewCompilerTest extends TestCase
{
    public function test_falsy_attribute(): void
    {
        $html = '<table border="0"></table>';

        $tokens = new TempestViewLexer($html)->lex();
        $ast = new TempestViewParser($tokens)->parse();

        $elementFactory = new ElementFactory(
            appConfig: new AppConfig(),
            viewConfig: new ViewConfig(),
            container: new GenericContainer(),
        )->withIsHtml(true);

        $element = $elementFactory->make($ast[0]);

        $this->assertSame($html, $element->compile());
    }
}
