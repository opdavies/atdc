<?php

namespace Drupal\example\Repository;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

final class PostNodeRepository {

  public function __construct(
    private EntityTypeManagerInterface $entityTypeManager,
  ) {
  }

  /**
   * @return array<int, NodeInterface>
   */
  public function findAll(): array {
    $nodeStorage = $this->entityTypeManager->getStorage('node');
    $nodes = $nodeStorage->loadMultiple();

    uasort($nodes, function (NodeInterface $a, NodeInterface $b): int {
      return $a->getCreatedTime() <=> $b->getCreatedTime();
    });

    return array_values($nodes);
  }

}
