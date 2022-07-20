<?php

namespace Mailery\Widget\Datepicker;

use Mailery\Widget\Datepicker\DatepickerAssetBundle;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Form\Field\Base\InputField;
use Yiisoft\Form\Field\Base\EnrichmentFromRules\EnrichmentFromRulesTrait;
use Yiisoft\Form\Field\Base\EnrichmentFromRules\EnrichmentFromRulesInterface;
use Yiisoft\Form\Field\Base\ValidationClass\ValidationClassTrait;
use Yiisoft\Form\Field\Base\ValidationClass\ValidationClassInterface;
use Yiisoft\Form\Field\Base\Placeholder\PlaceholderInterface;
use Yiisoft\Form\Field\Base\Placeholder\PlaceholderTrait;

class Datepicker extends InputField implements EnrichmentFromRulesInterface, ValidationClassInterface, PlaceholderInterface
{

    use EnrichmentFromRulesTrait;
    use ValidationClassTrait;
    use PlaceholderTrait;

    /**
     * @param AssetManager $assetManager
     */
    public function __construct(
        private AssetManager $assetManager
    ) {}

    /**
     * @param string $type
     * @return self
     */
    public function type(string $type): self
    {
        $new = clone $this;
        $new->inputAttributes['type'] = $type;
        return $new;
    }

    /**
     * @param string $format
     * @return self
     */
    public function format(string $format): self
    {
        $new = clone $this;
        $new->inputAttributes['format'] = $format;
        return $new;
    }

    /**
     * @param bool $value
     * @return self
     */
    public function clearable(bool $value = true): self
    {
        $new = clone $this;
        $new->inputAttributes[':clearable'] = json_encode($value);
        return $new;
    }

    /**$value
     * @param string $value
     * @return self
     */
    public function closeOnSelect(string $value): self
    {
        $new = clone $this;
        $new->inputAttributes['close-on-select'] = $value;
        return $new;
    }

    /**
     * @param bool $value
     * @return self
     */
    public function disable(bool $value = true): self
    {
        $new = clone $this;
        $new->inputAttributes[':disabled'] = json_encode($value);
        return $new;
    }

    /**
     * @param array $value
     * @return self
     */
    public function hourOptions(array $value): self
    {
        $new = clone $this;
        $new->inputAttributes[':hour-options'] = json_encode($value);
        return $new;
    }

    /**
     * @param array $value
     * @return self
     */
    public function minuteOptions(array $value): self
    {
        $new = clone $this;
        $new->inputAttributes[':minute-options'] = json_encode($value);
        return $new;
    }

    /**
     * @param array $value
     * @return self
     */
    public function secondOptions(array $value): self
    {
        $new = clone $this;
        $new->inputAttributes[':second-options'] = json_encode($value);
        return $new;
    }

    /**
     * {@inheritdoc}
     */
    protected function generateInput(): string
    {
        $this->assetManager->register(DatepickerAssetBundle::class);

        $attributes = $this->getInputAttributes();

        $value = $attributes['value'] ?? $this->getFormAttributeValue();
        unset($attributes['value']);

        if (is_object($value)) {
            throw new \InvalidArgumentException('Datepicker widget value can not be an object.');
        }

        if (null !== $value) {
            $attributes['value'] = $value;
        }

        $attributes['name'] ??= $this->getInputName();
        $attributes['class-name'] = implode(' ', $attributes['class'] ?? '');
        unset($attributes['class']);

        return CustomTag::name('ui-datepicker')->attributes($attributes)->render();
    }

}
