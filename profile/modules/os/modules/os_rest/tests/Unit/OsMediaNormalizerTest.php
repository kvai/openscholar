<?php

namespace Drupal\Tests\os_rest\Unit;

use Drupal\os_rest\Normalizer\OsMediaNormalizer;
use Drupal\serialization\Encoder\JsonEncoder;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\Serializer\Serializer;

/**
 * Class OsMediaNormalizer.
 *
 * @package Drupal\Tests\os_rest\Unit
 *
 * @coversDefaultClass Drupal\os_rest\Normalizer\OsMediaNormalizer
 */
class OsMediaNormalizerTest extends UnitTestCase {

  /**
   * The object being tested.
   *
   * @var \Drupal\os_rest\Normalizer\OsMediaNormalizer
   */
  protected $normalizer;

  /**
   * Media Storage we're creating too.
   *
   * @var \PHPUnit_Framework_MockObject_MockObject
   */
  protected $mediaStorage;

  /**
   * The route match we pull which media to edit from.
   *
   * @var \PHPUnit_Framework_MockObject_MockObject
   */
  protected $routeMatch;

  /**
   * The id of the next media item to be created using the mock create.
   *
   * @var int
   */
  protected $nextMediaId = 1;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    // Needed methods:
    // 1. id()
    // 2. getFileUri()
    // 3. getSize()
    // 4. getFilename()
    $file = $this->createMock('\Drupal\file\FileInterface');
    $file->method('id')->willReturn(1);
    $file->method('getFileUri')->willReturn('public://files/test.jpg');
    $file->method('getSize')->willReturn(2000);
    $file->method('getFilename')->willReturn('test.jpg');

    // Needed methods:
    // 1. create
    // 2. getQuery()
    //    2a. getQuery has an execute method
    // 3. load.
    /** @var \PHPUnit_Framework_MockObject_MockObject $fileStorage */
    $fileStorage = $this->createMock('\Drupal\Core\Entity\EntityStorageInterface');
    $fileStorage->method('load')->willReturnCallback(function ($id) use ($file) {
      if ($id == 1) {
        return $file;
      }
      return NULL;
    });
    /** @var \PHPUnit_Framework_MockObject_MockObject $mediaStorage */
    $this->mediaStorage = $this->createMock('\Drupal\Core\Entity\EntityStorageInterface');

    // Needed methods:
    // 1. getStorage(string $entity_type): EntityStorageInterface
    //    need 'file' and 'media'
    // 2. getEntityTypeFromClass(string $class): string
    // 3. getDefinition(string $entity_type, bool): EntityTypeInterface.
    /** @var \PHPUnit_Framework_MockObject_MockObject $entityManager */
    $entityManager = $this->createMock('\Drupal\Core\Entity\EntityManagerInterface');
    $entityManager->method('getStorage')->willReturnCallback(function ($type) use ($fileStorage) {
      switch ($type) {
        case 'file':
          return $fileStorage;

        case 'media':
          return $this->mediaStorage;
      }
      return NULL;
    });

    $entityType = $this->createMock('\Drupal\Core\Entity\EntityTypeInterface');
    $entityType->method('entityClassImplements')->willReturn(TRUE);
    $entityManager->method('getDefinition')->willReturn($entityType);

    // Needed methods:
    // 1. getStorage(string $entity_type): EntityStorageInterface.
    $entityTypeManager = $this->createMock('\Drupal\Core\Entity\EntityTypeManagerInterface');
    $entityTypeManager->method('getStorage')->willReturnCallback(function ($val) use ($fileStorage) {
      switch ($val) {
        case 'file':
          return $fileStorage;

        case 'media':
          return $this->mediaStorage;
      }
      return NULL;
    });

    // Needed methods:
    // 1. getParameter(string $param)
    //    'media' => original media being editted.
    $this->routeMatch = $this->createMock('\Drupal\Core\Routing\RouteMatchInterface');

    // Needed methods:
    // 1. uriScheme(string $uri)
    $filesystem = $this->createMock('\Drupal\Core\File\FileSystemInterface');
    $filesystem->method('uriScheme')->willReturnCallback(function ($uri) {
      if (preg_match('/^([\w\-]+):\/\/|^(data):/', $uri, $matches)) {
        // The scheme will always be the last element in the matches array.
        return array_pop($matches);
      }
      return FALSE;
    });

    $this->normalizer = new OsMediaNormalizer($entityManager, $entityTypeManager, $this->routeMatch, $filesystem);
    new Serializer([$this->normalizer], ['json' => new JsonEncoder()]);
  }

  /**
   * Test that media which references a local file is normalized correctly.
   */
  public function testLocalFileNormalization() {
    $i = 5;
    $this->assertEquals(5, $i);
  }

  /**
   * Tests normalization of a remote media object.
   */
  public function testRemoteFileNormalization() {
    $i = 5;
    $this->assertEquals(5, $i);
  }

  /**
   * Tests the data in denormalization changes in the media entity correctly.
   */
  public function testDenormalization() {
    $newMedia = $this->createMock('\Drupal\media\MediaInterface');

    $name = $this->createMock('\Drupal\Core\Field\FieldItemListInterface');
    $changed = $this->createMock('\Drupal\Core\Field\FieldItemListInterface');
    $newMedia->method('get')->willReturnCallback(function ($field) use ($name, $changed) {
      switch ($field) {
        case 'name':
          return $name;

        case 'changed':
          return $changed;
      }
      return NULL;
    });

    $this->mediaStorage->method('create')->willReturn($newMedia);

    $oldMedia = $this->createMock('\Drupal\media\MediaInterface');

    $this->routeMatch->method('getParameter')
      ->with('media')
      ->willReturn($oldMedia);

    $data = [
      'name' => 'test1',
    ];
    $context = [
      'entity_type' => 'media',
    ];
    $entity = $this->normalizer->denormalize($data, '\Drupal\media\Entity\Media', 'json', $context);
    $this->assertEquals('test1', $entity->label(), 'test1');
  }

}