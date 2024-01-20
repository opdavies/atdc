<?php

namespace Drupal\example;

use Drupal\node\NodeInterface;

final class PostWrapper {

  public function __construct(private NodeInterface $post) {
  }

  public function getType(): string {
    return $this->post->bundle();
  }

}
