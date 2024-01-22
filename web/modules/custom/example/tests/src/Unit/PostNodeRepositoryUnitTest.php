<?php

namespace Drupal\Tests\example\Unit;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\example\Repository\PostNodeRepository;
use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

/**
 * @group lessons
 */
final class PostNodeRepositoryUnitTest extends UnitTestCase {

  /** @test */
  public function it_returns_posts(): void {
    $node1 = $this->createMock(NodeInterface::class);
    $node1->method('bundle')->willReturn('post');
    $node1->method('getCreatedTime')->willReturn(strtotime('-1 week'));
    $node1->method('label')->willReturn('Post one');

    $node2 = $this->createMock(NodeInterface::class);
    $node2->method('bundle')->willReturn('post');
    $node2->method('getCreatedTime')->willReturn(strtotime('-8 days'));
    $node2->method('label')->willReturn('Post two');

    $node3 = $this->createMock(NodeInterface::class);
    $node3->method('bundle')->willReturn('post');
    $node3->method('getCreatedTime')->willReturn(strtotime('yesterday'));
    $node3->method('label')->willReturn('Post three');

    $nodeStorage = $this->createMock(EntityStorageInterface::class);
    $nodeStorage->method('loadByProperties')->willReturn([$node1, $node2, $node3]);

    $entityTypeManager = $this->createMock(EntityTypeManagerInterface::class);
    $entityTypeManager->method('getStorage')->with('node')->willReturn($nodeStorage);

    $repository = new PostNodeRepository($entityTypeManager);

    $posts = $repository->findAll();

    self::assertContainsOnlyInstancesOf(NodeInterface::class, $posts);

    $titles = array_map(
      fn (NodeInterface $node) => $node->label(),
      $posts,
    );

    self::assertCount(3, $titles);
    self::assertSame(
      ['Post two', 'Post one', 'Post three'],
      $titles,
    );
  }

}
