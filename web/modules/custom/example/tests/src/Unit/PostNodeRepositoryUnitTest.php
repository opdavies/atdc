<?php

namespace Drupal\Tests\example\Unit;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\example\Repository\PostNodeRepository;
use Drupal\Tests\UnitTestCase;

/**
 * @group lessons
 */
final class PostNodeRepositoryUnitTest extends UnitTestCase {

  /** @test */
  public function it_returns_posts(): void {
    $repository = new PostNodeRepository(
      $this->createMock(EntityTypeManagerInterface::class),
    );
  }

}
