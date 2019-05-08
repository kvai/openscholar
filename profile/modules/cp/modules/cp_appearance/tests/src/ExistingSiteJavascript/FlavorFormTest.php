<?php

namespace Drupal\Tests\cp_appearance\ExistingSiteJavascript;

use Drupal\Tests\openscholar\ExistingSiteJavascript\OsExistingSiteJavascriptTestBase;

/**
 * FlavorFormTest.
 *
 * @group functional-javascript
 * @group cp-appearance
 * @coversDefaultClass \Drupal\cp_appearance\Form\FlavorForm
 */
class FlavorFormTest extends OsExistingSiteJavascriptTestBase {

  /**
   * Test group.
   *
   * @var \Drupal\group\Entity\GroupInterface
   */
  protected $group;

  protected $defaultTheme;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    /** @var \Drupal\Core\Config\ImmutableConfig $theme_config */
    $theme_config = $this->container->get('config.factory')->get('system.theme');
    $this->defaultTheme = $theme_config->get('default');

    $this->group = $this->createGroup([
      'path' => [
        'alias' => '/cp-appearance-flavor',
      ],
    ]);
    $admin = $this->createAdminUser();

    $this->group->addMember($admin);

    $this->drupalLogin($admin);
  }

  /**
   * Tests whether flavor option appears for default theme.
   *
   * @covers ::buildForm
   *
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   * @throws \Behat\Mink\Exception\ExpectationException
   */
  public function testFlavorForDefaultTheme(): void {
    $this->visit('/cp-appearance-flavor/cp/appearance');
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->elementExists('css', 'form.cp-appearance-vibrant-flavor-form select');
    $this->assertSession()->elementExists('css', 'button[name="save-vibrant"]');
  }

  /**
   * Tests the behavior when flavor option is changed.
   *
   * @covers ::flavorChangeHandler
   *
   * @throws \Behat\Mink\Exception\DriverException
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   * @throws \Behat\Mink\Exception\ExpectationException
   * @throws \Behat\Mink\Exception\UnsupportedDriverActionException
   */
  public function testFlavorSelectionChange(): void {
    $this->visit('/cp-appearance-flavor/cp/appearance');

    // Flavor preview should be shown when selected.
    $this->getCurrentPage()->fillField('options_vibrant', 'golden_accents');
    $this->waitForAjaxToFinish();

    $this->assertSession()->elementExists('css', 'img[src="/profiles/contrib/openscholar/themes/golden_accents/screenshot.png"]');

    // Base theme screenshot should be shown when nothing selected.
    $this->getCurrentPage()->fillField('options_vibrant', '_none');
    $this->waitForAjaxToFinish();

    $this->assertSession()->elementExists('css', 'img[src="/profiles/contrib/openscholar/themes/vibrant/screenshot.png"]');
  }

  /**
   * Tests flavor save.
   *
   * @covers ::submitForm
   *
   * @throws \Behat\Mink\Exception\DriverException
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   * @throws \Behat\Mink\Exception\ExpectationException
   * @throws \Behat\Mink\Exception\UnsupportedDriverActionException
   */
  public function testFlavorSave(): void {
    $this->visit('/cp-appearance-flavor/cp/appearance');

    $this->getCurrentPage()->fillField('options_vibrant', 'golden_accents');
    $this->waitForAjaxToFinish();

    $this->getCurrentPage()->pressButton('save-vibrant');

    $this->visit('/cp-appearance-flavor');

    $this->assertSession()->responseContains('/profiles/contrib/openscholar/themes/golden_accents/css/style.css');
  }

  /**
   * Tests whether a flavor is selected as default when it is set as default.
   *
   * @covers ::buildForm
   *
   * @throws \Behat\Mink\Exception\DriverException
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   * @throws \Behat\Mink\Exception\UnsupportedDriverActionException
   */
  public function testDefaultFlavor(): void {
    $this->visit('/cp-appearance-flavor/cp/appearance');

    $this->getCurrentPage()->fillField('options_vibrant', 'golden_accents');
    $this->waitForAjaxToFinish();

    $this->getCurrentPage()->pressButton('save-vibrant');

    /** @var \Behat\Mink\Element\NodeElement $flavor_options */
    $flavor_options = $this->getCurrentPage()->findField('options_vibrant');

    $this->assertEquals('golden_accents', $flavor_options->getValue());
  }

  /**
   * {@inheritdoc}
   */
  public function tearDown() {
    /** @var \Drupal\Core\Config\Config $theme_setting_mut */
    $theme_setting_mut = $this->container->get('config.factory')->getEditable('system.theme');
    $theme_setting_mut->set('default', $this->defaultTheme)->save();

    parent::tearDown();
  }

}