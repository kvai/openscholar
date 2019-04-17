<?php

namespace Drupal\cp_appearance\Form;

use Drupal\Component\Utility\Html;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Extension\Extension;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\cp_appearance\ThemeSelectorBuilderInterface;
use Ds\Map;

/**
 * Flavor selection form.
 */
class FlavorForm implements FormInterface {

  use StringTranslationTrait;
  use DependencySerializationTrait;

  /**
   * The theme for which the form will be created.
   *
   * @var \Drupal\Core\Extension\Extension
   */
  protected $theme;

  /**
   * Available flavors of the theme.
   *
   * Flavor name and its information mapping.
   *
   * @var \Ds\Map
   */
  protected $flavors;

  /**
   * Theme selector builder service.
   *
   * @var \Drupal\cp_appearance\ThemeSelectorBuilderInterface
   */
  protected $themeSelectorBuilder;

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Creates a new FlavorForm object.
   *
   * @param \Drupal\Core\Extension\Extension $theme
   *   The theme for which the form will be created.
   * @param \Ds\Map $flavors
   *   Available flavors of the theme.
   * @param \Drupal\cp_appearance\ThemeSelectorBuilderInterface $theme_selector_builder
   *   Theme selector builder service.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config factory.
   */
  public function __construct(Extension $theme, Map $flavors, ThemeSelectorBuilderInterface $theme_selector_builder, ConfigFactoryInterface $config_factory) {
    $this->theme = $theme;
    $this->flavors = $flavors;
    $this->themeSelectorBuilder = $theme_selector_builder;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return "cp_appearance_{$this->theme->getName()}_flavor_form";
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $options = [
      '_none' => $this->t('None'),
    ];

    /** @var \Drupal\Core\Extension\Extension $flavor */
    foreach ($this->flavors->values() as $flavor) {
      $options[$flavor->getName()] = $flavor->info['name'];
    }

    $form["options_{$this->theme->getName()}"] = [
      '#type' => 'select',
      '#title' => $this->t('Flavors'),
      '#options' => $options,
      '#ajax' => [
        'callback' => '::flavorChangeHandler',
      ],
    ];

    $form["save_{$this->theme->getName()}"] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#name' => Html::cleanCssIdentifier("save-{$this->theme->getName()}"),
      '#attributes' => [
        'style' => 'display: none',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    /** @var string $selection */
    $selection = $form_state->getValue("options_{$this->theme->getName()}");
    /** @var \Drupal\Core\Config\Config $theme_settings_mut */
    $theme_settings_mut = $this->configFactory->getEditable('system.theme');

    // TODO: Show a feedback message that settings have been saved.
    $theme_settings_mut
      ->set('default', $selection)
      ->save();
  }

  /**
   * Flavor option change handler.
   *
   * @ingroup forms
   */
  public function flavorChangeHandler(array &$form, FormStateInterface $form_state): AjaxResponse {
    $response = new AjaxResponse();
    /** @var string $selection */
    $selection = $form_state->getValue("options_{$this->theme->getName()}");

    // It would not make sense if user has not chosen a flavor, and still seeing
    // the option to save settings.
    // This also prevents adding multiple save buttons every time option is
    // changed.
    /** @var string $button_identifier */
    $button_identifier = Html::cleanCssIdentifier("save-{$this->theme->getName()}");
    $response->addCommand(new CssCommand("button[name=$button_identifier]", [
      'display' => 'none',
    ]));

    if ($selection !== '_none') {
      /** @var \Drupal\Core\Extension\Extension $flavor */
      $flavor = $this->flavors->get($selection);
      /** @var array $info */
      $info = $flavor->info;
      /** @var string|null $screenshot_uri */
      $screenshot_uri = $this->themeSelectorBuilder->getScreenshotUri($flavor);

      $response->addCommand(new CssCommand("button[name=$button_identifier]", [
        'display' => 'block',
      ]));
    }
    else {
      // Revert everything to normal is user has not chosen a flavor.
      /** @var array $info */
      $info = $this->theme->info;
      /** @var string|null $screenshot_uri */
      $screenshot_uri = $this->themeSelectorBuilder->getScreenshotUri($this->theme);
    }

    /** @var string $theme_selector_identifier */
    $theme_selector_identifier = Html::cleanCssIdentifier("theme-selector-{$this->theme->getName()}");
    $response->addCommand(new ReplaceCommand("#$theme_selector_identifier .theme-screenshot img", [
      '#theme' => 'image',
      '#uri' => $screenshot_uri ?? '',
      '#alt' => $this->t('Screenshot for @theme theme', ['@theme' => $info['name']]),
      '#title' => $this->t('Screenshot for @theme theme', ['@theme' => $info['name']]),
      '#attributes' => ['class' => ['screenshot']],
    ]));

    return $response;
  }

}
