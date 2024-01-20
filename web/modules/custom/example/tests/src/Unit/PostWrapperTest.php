<?php

namespace Drupal\Tests\example\Unit;

use Drupal\example\PostWrapper;
use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

/**
 * @group lessons
 */
final class PostWrapperTest extends UnitTestCase {

  /** @test */
  public function it_wraps_a_post(): void {
    $node = $this->createMock(NodeInterface::class);
    $node->method('bundle')->willReturn('post');

    $wrapper = new PostWrapper($node);

    self::assertInstanceOf(NodeInterface::class, $node);
    self::assertSame('post', $node->bundle());

    self::assertSame('post', $wrapper->getType());
  }

}
