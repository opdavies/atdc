<?php

namespace Drupal\atdc\Repository;

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
    $nodes = $nodeStorage->loadByProperties([
      'status' => TRUE,
      'type' => 'post',
    ]);

    uasort($nodes, function (NodeInterface $a, NodeInterface $b): int {
      return $a->getCreatedTime() <=> $b->getCreatedTime();
    });

    return array_values($nodes);
  }

}
