<?php

namespace Drupal\Tests\example\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

class ExampleTest extends BrowserTestBase {

  protected $defaultTheme = 'stark';

  public function testFrontPage(): void {
    $this->drupalGet('/');

    $assert = $this->assertSession();
    $assert->statusCodeEquals(Response::HTTP_OK);
  }

  public function testAdminPage(): void {
    $this->drupalGet('/admin');

    $assert = $this->assertSession();
    $assert->statusCodeEquals(Response::HTTP_FORBIDDEN);
  }

  public function testAdminPageLoggedIn(): void {
    $user = $this->createUser(permissions: [
      'access administration pages',
      'administer site configuration',
    ]);

    $this->drupalLogin($user);

    $this->drupalGet('/admin');

    $this->assertSession()->statusCodeEquals(Response::HTTP_OK);
  }

}
