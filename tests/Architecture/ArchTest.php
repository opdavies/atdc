<?php

namespace Tests\Architecture;

use Drupal\Core\Controller\ControllerBase;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class ArchTest {

  public function test_classes_should_be_final(): Rule {
    return PHPat::rule()
      ->classes(Selector::inNamespace('Drupal\atdc'))
      ->shouldBeFinal();
  }

  public function test_controllers_should_extend_ControllerBase(): Rule {
    return PHPat::rule()
      ->classes(Selector::inNamespace('Drupal\atdc\Controller'))
      ->shouldExtend()
      ->classes(Selector::classname(ControllerBase::class));
  }

  public function test_controllers_should_have_the_Controller_suffix(): Rule {
    return PHPat::rule()
      ->classes(Selector::inNamespace('Drupal\atdc\Controller'))
      ->shouldBeNamed(
        classname: '/Controller$/',
        regex: TRUE,
      );
  }

}
