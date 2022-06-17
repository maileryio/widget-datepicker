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
     * {@inheritdoc}
     */
    protected function run(): string
    {
        $this->assetManager->register(DatepickerAssetBundle::class);

        $attributes = $this->build($this->attributes);

        return CustomTag::name('ui-datepicker')->attributes($attributes)->render();
    }

}
