<?php

namespace Drupal\Tests\example\Unit;

use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\Tests\UnitTestCase;

/**
 * @group lessons
 */
final class PostWrapperTest extends UnitTestCase {

  /** @test */
  public function it_wraps_a_post(): void {
    $node = new Node(
      entity_type: 'post',
      values: [],
    );

    self::assertInstanceOf(NodeInterface::class, $node);
  }

}
