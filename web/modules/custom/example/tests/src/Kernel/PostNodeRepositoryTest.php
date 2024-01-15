<?php

namespace Drupal\Tests\example\Kernel;

use Drupal\example\Builder\PostBuilder;
use Drupal\example\Repository\PostNodeRepository;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\NodeInterface;

/**
 * @group lessons
 */
class PostNodeRepositoryTest extends EntityKernelTestBase {

  protected static $modules = ['node', 'example'];

  public function testPostsAreReturnedByCreatedDate(): void {
    // Arrange.
    PostBuilder::create()
      ->setCreatedDate('-1 week')
      ->setTitle('Post one')
      ->getPost();

    PostBuilder::create()
      ->setCreatedDate('-8 days')
      ->setTitle('Post two')
      ->getPost();

    PostBuilder::create()
      ->setCreatedDate('yesterday')
      ->setTitle('Post three')
      ->getPost();

    // Act.
    $postRepository = $this->container->get(PostNodeRepository::class);
    assert($postRepository instanceof PostNodeRepository);
    $nodes = $postRepository->findAll();

    // Assert.
    self::assertCount(3, $nodes);

    self::assertNodeTitlesAreSame(
      ['Post two', 'Post one', 'Post three'],
      $nodes,
    );
  }

  /**
   * @param array<int, string> $expectedTitles
   * @param array<int, NodeInterface> $nodes
   */
  private static function assertNodeTitlesAreSame(
    array $expectedTitles,
    array $nodes,
  ): void {
    self::assertSame(
      $expectedTitles,
      array_map(
        fn (NodeInterface $node) => $node->label(),
        $nodes
      )
    );
  }

}
