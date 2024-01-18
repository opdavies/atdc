<?php

namespace Drupal\Tests\example\Kernel\Builder;

use Drupal\example\Builder\PostBuilder;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\NodeInterface;

/**
 * @group lessons
 */
final class PostBuilderTest extends EntityKernelTestBase {

  protected static $modules = [
    // Core.
    'node',
    'taxonomy',

    // Custom.
    'example_test',
  ];

  /** @test */
  public function it_returns_a_published_post(): void {
    $node = PostBuilder::create()
      ->setTitle('test')
      ->isPublished()
      ->getPost();

    self::assertInstanceOf(NodeInterface::class, $node);
    self::assertSame('post', $node->bundle());
    self::assertTrue($node->isPublished());
  }

  /** @test */
  public function it_returns_an_unpublished_post(): void {
    $node = PostBuilder::create()
      ->setTitle('test')
      ->isNotPublished()
      ->getPost();

    self::assertInstanceOf(NodeInterface::class, $node);
    self::assertSame('post', $node->bundle());
    self::assertFalse($node->isPublished());
  }

  /** @test */
  public function it_returns_a_post_with_tags(): void {
    $this->installConfig(modules: [
      'example_test',
    ]);

    $node = PostBuilder::create()
      ->setTitle('test')
      ->getPost();

    self::assertInstanceOf(NodeInterface::class, $node);
    self::assertSame('post', $node->bundle());

    $tags = $node->get('field_tags')->referencedEntities();
    self::assertCount(3, $tags);
  }

}
