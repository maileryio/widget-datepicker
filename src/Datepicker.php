<?php

namespace Mailery\Widget\Datepicker;

use Mailery\Widget\Datepicker\DatepickerAssetBundle;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Form\Widget\Attribute\ChoiceAttributes;
use Yiisoft\Form\Widget\Attribute\PlaceholderInterface;

class Datepicker extends ChoiceAttributes implements PlaceholderInterface
{

    /**
     * @var AssetManager
     */
    private AssetManager $assetManager;

    /**
     * @param AssetManager $assetManager
     */
    public function __construct(AssetManager $assetManager)
    {
        $this->assetManager = $assetManager;
    }

    /**
     * @param string $type
     * @return self
     */
    public function type(string $type): self
    {
        $new = clone $this;
        $new->attributes['type'] = $type;
        return $new;
    }

    /**
     * @param string $format
     * @return self
     */
    public function format(string $format): self
    {
        $new = clone $this;
        $new->attributes['format'] = $format;
        return $new;
    }

    /**
     * @param string $value
     * @return self
     */
    public function placeholder(string $value): self
    {
        $new = clone $this;
        $new->attributes['placeholder'] = $value;
        return $new;
    }

    /**
     * @param bool $value
     * @return self
     */
    public function clearable(bool $value = true): self
    {
        $new = clone $this;
        $new->attributes[':clearable'] = json_encode($value);
        return $new;
    }

    /**$value
     * @param string $value
     * @return self
     */
    public function closeOnSelect(string $value): self
    {
        $new = clone $this;
        $new->attributes['close-on-select'] = $value;
        return $new;
    }

    /**
     * @param bool $value
     * @return self
     */
    public function disable(bool $value = true): self
    {
        $new = clone $this;
        $new->attributes[':disabled'] = json_encode($value);
        return $new;
    }

    /**
     * @param array $value
     * @return self
     */
    public function hourOptions(array $value): self
    {
        $new = clone $this;
        $new->attributes[':hour-options'] = json_encode($value);
        return $new;
    }

    /**
     * @param array $value
     * @return self
     */
    public function minuteOptions(array $value): self
    {
        $new = clone $this;
        $new->attributes[':minute-options'] = json_encode($value);
        return $new;
    }

    /**
     * @param array $value
     * @return self
     */
    public function secondOptions(array $value): self
    {
        $new = clone $this;
        $new->attributes[':second-options'] = json_encode($value);
        return $new;
    }

    /**
     * {@inheritdoc}
     */
    protected function run(): string
    {
        $this->assetManager->register(DatepickerAssetBundle::class);

        $attributes = $this->build($this->attributes);

        $value = $attributes['value'] ?? $this->getAttributeValue();
        unset($attributes['value']);

        if (is_object($value)) {
            throw new \InvalidArgumentException('Datepicker widget value can not be an object.');
        }

        if (null !== $value) {
            $attributes['value'] = $value;
        }

        $attributes['class-name'] = $attributes['class'] ?? '';
        unset($attributes['class']);

        return CustomTag::name('ui-datepicker')->attributes($attributes)->render();
    }

}
