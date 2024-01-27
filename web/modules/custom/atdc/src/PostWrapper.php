<?php

namespace Drupal\atdc;

use Drupal\node\NodeInterface;

final class PostWrapper {

  /**
   * @throws \InvalidArgumentException
   */
  public function __construct(private NodeInterface $post) {
    if ($post->bundle() !== 'post') {
      throw new \InvalidArgumentException();
    }
  }

  public function getType(): string {
    return $this->post->bundle();
  }

}
