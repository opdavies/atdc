<?php

namespace Drupal\example\Builder;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\taxonomy\Entity\Term;

final class PostBuilder {

  private ?DrupalDateTime $created = NULL;

  private string $title;

  private bool $isPublished = TRUE;

  /**
   * @var string[]
   */
  private array $tags = [];

  public static function create(): self {
    return new self();
  }

  public function isNotPublished(): self {
    $this->isPublished = FALSE;

    return $this;
  }

  public function isPublished(): self {
    $this->isPublished = TRUE;

    return $this;
  }

  public function setCreatedDate(string $time = 'now'): self {
    $this->created = new DrupalDateTime($time);

    return $this;
  }

  /**
   * @param string[] $tags
   */
  public function setTags(array $tags): self {
    $this->tags = $tags;

    return $this;
  }

  public function setTitle(string $title): self {
    $this->title = $title;

    return $this;
  }

  public function getPost(): NodeInterface {
    $post = Node::create([
      'status' => $this->isPublished,
      'title' => $this->title,
      'type' => 'post',
    ]);

    if ($this->created !== NULL) {
      $post->setCreatedTime($this->created->getTimestamp());
    }

    $tagTerms = [];
    if ($this->tags !== []) {
      foreach ($this->tags as $tag) {
        $term = Term::create([
          'name' => $tag,
          'vid' => 'tags',
        ]);

        $term->save();

        $tagTerms[] = $term;
      }

      $post->set('field_tags', $tagTerms);
    }

    $post->save();

    return $post;
  }

}
