<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit271c91ceace210315d7b84ff61078145
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pds\\Skeleton\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pds\\Skeleton\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/../..' . '/tests',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit271c91ceace210315d7b84ff61078145::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit271c91ceace210315d7b84ff61078145::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
