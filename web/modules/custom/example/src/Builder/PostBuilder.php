<?php

namespace Drupal\example\Builder;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;

final class PostBuilder {

  private ?DrupalDateTime $created = NULL;

  private string $title;

  public static function create(): self {
    return new self();
  }

  public function isNotPublished(): self {
    return $this;
  }

  public function isPublished(): self {
    return $this;
  }

  public function setCreatedDate(string $time = 'now'): self {
    $this->created = new DrupalDateTime($time);

    return $this;
  }

  public function setTitle(string $title): self {
    $this->title = $title;

    return $this;
  }

  public function getPost(): NodeInterface {
    $post = Node::create([
      'title' => $this->title,
      'type' => 'post',
    ]);

    if ($this->created !== NULL) {
      $post->setCreatedTime($this->created->getTimestamp());
    }

    $post->save();

    return $post;
  }

}
