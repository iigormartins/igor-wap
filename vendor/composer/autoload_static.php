<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit44a4df860f3be9c2ab87cfc2e90e2562
{
    public static $classMap = array (
        'SimpleXLSX' => __DIR__ . '/..' . '/phpclasses/simple-xlsx/simplexlsx.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit44a4df860f3be9c2ab87cfc2e90e2562::$classMap;

        }, null, ClassLoader::class);
    }
}
