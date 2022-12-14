<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit09f2a98fb2eb9333eb3ae4fa67317c03
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'PhpOffice\\PhpSpreadsheet\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'PhpOffice\\PhpSpreadsheet\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpspreadsheet/src/PhpSpreadsheet',
        ),
    );

    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'org\\bovigo\\vfs' => 
            array (
                0 => __DIR__ . '/..' . '/mikey179/vfsStream/src/main/php',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit09f2a98fb2eb9333eb3ae4fa67317c03::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit09f2a98fb2eb9333eb3ae4fa67317c03::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit09f2a98fb2eb9333eb3ae4fa67317c03::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
