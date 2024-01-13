<?php

namespace Drupal\Tests\example\Kernel;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\example\Repository\PostNodeRepository;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\NodeInterface;
use Drupal\Tests\node\Traits\NodeCreationTrait;

class PostNodeRepositoryTest extends EntityKernelTestBase {

  use NodeCreationTrait;

  protected static $modules = ['node', 'example'];

  public function testPostsAreReturnedByCreatedDate(): void {
    // Arrange.
    $this->createNode([
      'title' => 'Post one',
      'created' => (new DrupalDateTime('-1 week'))->getTimestamp(),
      'type' => 'post',
    ]);

    $this->createNode([
      'title' => 'Post two',
      'created' => (new DrupalDateTime('-8 days'))->getTimestamp(),
      'type' => 'post',
    ]);

    $this->createNode([
      'title' => 'Post three',
      'created' => (new DrupalDateTime('yesterday'))->getTimestamp(),
      'type' => 'post',
    ]);

    // Act.
    $postRepository = $this->container->get(PostNodeRepository::class);
    assert($postRepository instanceof PostNodeRepository);
    $nodes = $postRepository->findAll();

    // Assert.
    self::assertCount(3, $nodes);

    self::assertSame(
      ['Post two', 'Post one', 'Post three'],
      array_map(
        fn (NodeInterface $node) => $node->label(),
        $nodes
      )
    );
  }

}
