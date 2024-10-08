<?php

namespace Drupal\Tests\atdc\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

class ExampleTest extends BrowserTestBase {

  protected $defaultTheme = 'stark';

  protected static $modules = ['node'];

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

  public function testContent(): void {
    $this->drupalGet('/node/1');
    $this->assertSession()->statusCodeEquals(Response::HTTP_NOT_FOUND);

    $this->createContentType(['type' => 'page']);
    $this->createNode(['type' => 'page']);

    // var_dump($this->getSession()->getPage()->getContent());

    $this->drupalGet('/node/1');
    $this->assertSession()->statusCodeEquals(Response::HTTP_OK);
  }

}
