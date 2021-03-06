<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2418c7f8fc7d376a1855e7ce0185e6db
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Defuse\\Crypto\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Defuse\\Crypto\\' => 
        array (
            0 => __DIR__ . '/..' . '/defuse/php-encryption/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2418c7f8fc7d376a1855e7ce0185e6db::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2418c7f8fc7d376a1855e7ce0185e6db::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
