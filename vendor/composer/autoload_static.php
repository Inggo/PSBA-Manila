<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit446f722c76fec37a7f813610554b6034
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inggo\\WordPress\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inggo\\WordPress\\' => 
        array (
            0 => __DIR__ . '/../..' . '/wp',
        ),
    );

    public static $classMap = array (
        'Inggo\\WordPress\\Contracts\\Customizer' => __DIR__ . '/../..' . '/wp/Contracts/Customizer.php',
        'Inggo\\WordPress\\PSBAManila\\Theme' => __DIR__ . '/../..' . '/wp/PSBAManila/Theme.php',
        'Inggo\\WordPress\\Theme' => __DIR__ . '/../..' . '/wp/Theme.php',
        'Inggo\\WordPress\\ThemeCustomizer' => __DIR__ . '/../..' . '/wp/ThemeCustomizer.php',
        'Inggo\\WordPress\\ThemeCustomizerHelper' => __DIR__ . '/../..' . '/wp/Helpers/ThemeCustomizerHelper.php',
        'Inggo\\WordPress\\Traits\\DisplaysMessages' => __DIR__ . '/../..' . '/wp/Traits/DisplaysMessages.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit446f722c76fec37a7f813610554b6034::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit446f722c76fec37a7f813610554b6034::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit446f722c76fec37a7f813610554b6034::$classMap;

        }, null, ClassLoader::class);
    }
}
