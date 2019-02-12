<?php

namespace Drupal\Tests\os_publications\ExistingSite;

/**
 * Tests publication views.
 *
 * @group kernel
 */
class PublicationsViewsTest extends TestBase {

  /**
   * Default filter publication type settings.
   *
   * @var array
   */
  protected $defaultFilterPublicationTypeSettings;

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->configFactory = $this->container->get('config.factory');
    /** @var \Drupal\Core\Config\ImmutableConfig $publications_settings */
    $publications_settings = $this->configFactory->get('os_publications.settings');
    $this->defaultFilterPublicationTypeSettings = $publications_settings->get('os_publications_filter_publication_types');
  }

  /**
   * Tests type display.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function testType() {
    $this->createReference([
      'title' => 'Mona Lisa',
    ]);

    $this->createReference([
      'title' => 'The Rust Programming Language',
      'type' => 'journal',
      'bibcite_year' => [
        'value' => 2010,
      ],
    ]);

    /** @var array $result */
    $result = views_get_view_result('publications', 'page_1');

    $this->assertCount(2, $result);

    $grouped_result = [];

    foreach ($result as $item) {
      $grouped_result[$item->_entity->bundle()][] = $item->_entity->label();
    }

    $this->assertCount(1, $grouped_result['artwork']);
    $this->assertCount(1, $grouped_result['journal']);
  }

  /**
   * Tests title display.
   *
   * @coversDefaultClass \Drupal\os_publications\Plugin\views\field\LabelFirstLetterExclPreposition
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function testTitle() {
    $this->createReference([
      'title' => 'The Last Supper',
    ]);

    $this->createReference([
      'title' => 'Girl with a Pearl Earring',
    ]);

    $this->createReference([
      'title' => 'Mona Lisa',
    ]);

    $this->createReference([
      'title' => 'Las Meninas',
    ]);

    /** @var array $result */
    $result = views_get_view_result('publications', 'page_2');

    $this->assertCount(4, $result);

    $grouped_result = [];
    /** @var \Drupal\os_publications\PublicationsListingHelperInterface $publications_listing_helper */
    $publications_listing_helper = $this->container->get('os_publications.listing_helper');

    foreach ($result as $item) {
      $grouped_result[$publications_listing_helper->convertLabel($item->_entity->label())][] = $item->_entity->id();
    }

    $this->assertCount(1, $grouped_result['G']);
    $this->assertCount(1, $grouped_result['M']);
    $this->assertCount(2, $grouped_result['L']);
  }

  /**
   * Tests author display.
   *
   * @coversDefaultClass \Drupal\os_publications\Plugin\views\field\AuthorLastNameFirstLetter
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   * @throws \Drupal\Core\TypedData\Exception\MissingDataException
   */
  public function testAuthor() {
    $contributor1 = $this->createContributor([
      'first_name' => 'Leonardo',
      'middle_name' => 'Da',
      'last_name' => 'Vinci',
    ]);

    $contributor2 = $this->createContributor([
      'first_name' => 'Joanne',
      'middle_name' => 'Kathleen',
      'last_name' => 'Rowling',
    ]);

    $this->createReference([
      'title' => 'Mona Lisa',
      'author' => [
        'target_id' => $contributor1->id(),
        'category' => 'primary',
        'role' => 'author',
      ],
    ]);

    $this->createReference([
      'title' => 'The Last Supper',
      'author' => [
        'target_id' => $contributor1->id(),
        'category' => 'primary',
        'role' => 'author',
      ],
    ]);

    $this->createReference([
      'title' => 'Harry Potter and the Deathly Hallows',
      'type' => 'book',
      'author' => [
        'target_id' => $contributor2->id(),
        'category' => 'primary',
        'role' => 'author',
      ],
      'bibcite_publisher' => [
        'value' => 'Bloomsbury',
      ],
    ]);

    $this->createReference([
      'title' => 'Unknown',
    ]);

    /** @var array $result */
    $result = views_get_view_result('publications', 'page_3');

    $this->assertCount(4, $result);

    $grouped_result = [];

    /** @var \Drupal\os_publications\PublicationsListingHelperInterface $publications_listing_helper */
    $publications_listing_helper = $this->container->get('os_publications.listing_helper');

    foreach ($result as $item) {
      /** @var \Drupal\bibcite_entity\Entity\ReferenceInterface $reference */
      $reference = $item->_entity;
      $grouped_result[$publications_listing_helper->convertAuthorName($reference)][] = $reference->id();
    }

    $this->assertCount(2, $grouped_result['V']);
    $this->assertCount(1, $grouped_result['R']);
    $this->assertCount(1, $grouped_result['']);
  }

  /**
   * Tests year display.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function testYear() {
    $this->createReference([
      'title' => 'Girl with a Pearl Earring',
      'bibcite_year' => [
        'value' => 1665,
      ],
    ]);

    $this->createReference([
      'title' => 'The Persistence of Memory',
      'bibcite_year' => [
        'value' => 1931,
      ],
    ]);

    $this->createReference([
      'title' => 'The Starry Night',
      'bibcite_year' => [
        'value' => 1889,
      ],
    ]);

    $this->createReference([
      'title' => 'Foobar',
      'bibcite_year' => [
        'value' => 1889,
      ],
    ]);

    /** @var array $result */
    $result = views_get_view_result('publications', 'page_4');

    $this->assertCount(4, $result);

    $grouped_result = [];

    foreach ($result as $item) {
      $grouped_result[$item->_entity->get('bibcite_year')->first()->getValue()['value']][] = $item->_entity->id();
    }

    $this->assertCount(1, $grouped_result['1665']);
    $this->assertCount(1, $grouped_result['1931']);
    $this->assertCount(2, $grouped_result['1889']);
  }

  /**
   * Tests whether publication types are filtered as per the settings.
   *
   * @covers ::os_publications_views_query_alter
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function testReferenceFilter() {
    $this->createReference([
      'title' => 'Girl with a Pearl Earring',
    ]);

    /** @var array $publications_by_type */
    $publications_by_type = views_get_view_result('publications', 'page_1');
    /** @var array $publications_by_title */
    $publications_by_title = views_get_view_result('publications', 'page_2');
    /** @var array $publications_by_author */
    $publications_by_author = views_get_view_result('publications', 'page_3');
    /** @var array $publications_by_year */
    $publications_by_year = views_get_view_result('publications', 'page_4');

    $this->assertCount(1, $publications_by_type);
    $this->assertCount(1, $publications_by_title);
    $this->assertCount(1, $publications_by_author);
    $this->assertCount(1, $publications_by_year);

    /** @var \Drupal\Core\Config\ConfigFactoryInterface $config_factory */
    $config_factory = $this->container->get('config.factory');
    /** @var \Drupal\Core\Config\Config $os_publications_settings_mut */
    $os_publications_settings_mut = $config_factory->getEditable('os_publications.settings');
    /** @var array $filter_publication_types */
    $filter_publication_types = $os_publications_settings_mut->get('os_publications_filter_publication_types');
    $os_publications_settings_mut->set('os_publications_filter_publication_types', [
      'artwork' => 0,
    ] + $filter_publication_types);
    $os_publications_settings_mut->save();

    /** @var array $publications_by_type */
    $publications_by_type = views_get_view_result('publications', 'page_1');
    /** @var array $publications_by_title */
    $publications_by_title = views_get_view_result('publications', 'page_2');
    /** @var array $publications_by_author */
    $publications_by_author = views_get_view_result('publications', 'page_3');
    /** @var array $publications_by_year */
    $publications_by_year = views_get_view_result('publications', 'page_4');

    $this->assertCount(0, $publications_by_type);
    $this->assertCount(0, $publications_by_title);
    $this->assertCount(0, $publications_by_author);
    $this->assertCount(0, $publications_by_year);
  }

  /**
   * {@inheritdoc}
   */
  public function tearDown() {
    /** @var \Drupal\Core\Config\Config $publication_settings_mut */
    $publication_settings_mut = $this->configFactory->getEditable('os_publications.settings');
    $publication_settings_mut
      ->set('os_publications_filter_publication_types', $this->defaultFilterPublicationTypeSettings)
      ->save();

    parent::tearDown();
  }

}
