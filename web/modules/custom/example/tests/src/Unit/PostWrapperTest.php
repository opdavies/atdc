<?php

namespace Drupal\Tests\example\Unit;

use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

/**
 * @group lessons
 */
final class PostWrapperTest extends UnitTestCase {

  /** @test */
  public function it_wraps_a_post(): void {
    $node = $this->createMock(NodeInterface::class);

    self::assertInstanceOf(NodeInterface::class, $node);
    self::assertSame('post', $node->bundle());
  }

}
