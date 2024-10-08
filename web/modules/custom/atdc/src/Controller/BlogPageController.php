<?php

namespace Drupal\atdc\Controller;

use Drupal\atdc\Repository\PostNodeRepository;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class BlogPageController extends ControllerBase {

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
