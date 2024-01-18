<?php

namespace Drupal\Tests\example\Kernel\Builder;

use Drupal\example\Builder\PostBuilder;
use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\node\NodeInterface;

/**
 * @group lessons
 */
final class PostBuilderTest extends EntityKernelTestBase {

  protected static $modules = ['node'];

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

}
