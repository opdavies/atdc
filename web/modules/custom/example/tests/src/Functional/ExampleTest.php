<?php

namespace Drupal\Tests\example\Functional;

use Drupal\Tests\BrowserTestBase;

class ExampleTest extends BrowserTestBase {

  protected $defaultTheme = 'stark';

  public function testBasic(): void {
    self::assertTrue(TRUE);
  }

}
