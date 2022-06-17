<?php

declare(strict_types=1);

namespace Mailery\Widget\Datepicker;

use Mailery\Web\Assets\VueAssetBundle;
use Yiisoft\Assets\AssetBundle;

class DatepickerAssetBundle extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public ?string $basePath = '@public/assets/@maileryio/widget-datepicker-assets';

    /**
     * {@inheritdoc}
     */
    public ?string $baseUrl = '@assetsUrl/@maileryio/widget-datepicker-assets';

    /**
     * {@inheritdoc}
     */
    public ?string $sourcePath = '@npm/@maileryio/widget-datepicker-assets/dist';

    /**
     * {@inheritdoc}
     */
    public array $js = [
        'main.umd.min.js',
    ];

    /**
     * {@inheritdoc}
     */
    public array $depends = [
        VueAssetBundle::class,
    ];
}
