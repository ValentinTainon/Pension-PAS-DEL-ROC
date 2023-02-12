<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Services\FileUploader;

return static function (ContainerConfigurator $containerConfigurator) {
    $services = $containerConfigurator->services();

    $services->set(FileUploader::class)
        ->arg('$targetDirectory', '%ordonnances_directory%')
    ;
};