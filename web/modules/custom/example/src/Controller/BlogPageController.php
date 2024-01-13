<?php

namespace Drupal\example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\example\Repository\PostNodeRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BlogPageController extends ControllerBase {

  public function __construct(
    private PostNodeRepository $postNodeRepository,
  ) {
  }

  public function __invoke(): array {
    $nodes = $this->postNodeRepository->findAll();

    $build = [];
    $build['content']['#theme'] = 'item_list';
    foreach ($nodes as $node) {
      $build['content']['#items'][] = $node->label();
    }

    return $build;
  }

  public static function create(ContainerInterface $container): self {
    return new self(
      $container->get(PostNodeRepository::class),
    );
  }

}
