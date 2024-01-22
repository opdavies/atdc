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
    $nodeStorage = $this->createMock(EntityStorageInterface::class);

    $entityTypeManager = $this->createMock(EntityTypeManagerInterface::class);
    $entityTypeManager->method('getStorage')->with('node')->willReturn($nodeStorage);

    $repository = new PostNodeRepository($entityTypeManager);

    $repository->findAll();
  }

}
