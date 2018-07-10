<?php

namespace N2boost\LaravelDoctrineMapping\Commands;


use Doctrine\ORM\Tools\EntityGenerator;
use Illuminate\Console\Command;
use N2boost\LaravelDoctrineMapping\Traits\OrmFunctions;

class GenerateEntities extends Command
{
    use OrmFunctions;

    protected $signature = 'n2boost:orm:generate-entities';

    protected $description = 'Create a doctrine-mapping file';

    public function handle()
    {
        $config = config('laravel-doctrine-mapping');

        $em = $this->getEntityManager();
        $metadatas = $this->getMetaData($em);

        $classes_dir = base_path($config['entities_file_dir']);

        $destPath = $classes_dir;

        $entityGenerator = new EntityGenerator();

        $entityGenerator->setGenerateAnnotations(true);
        $entityGenerator->setGenerateStubMethods(true);
        $entityGenerator->setRegenerateEntityIfExists(true);
        $entityGenerator->setUpdateEntityIfExists(true);
//        $entityGenerator->setNumSpaces($input->getOption('num-spaces'));
//        $entityGenerator->setBackupExisting(!$input->getOption('no-backup'));

//        if ($extend = 'yml') {
//            $entityGenerator->setClassToExtend($extend);
//        }

        foreach ($metadatas as $metadata) {
            $name = $metadata->getName();
            $str = "{$name} classes generated to {$destPath}";
            $this->info($str);
        }
//

        // Generating Entities
        $entityGenerator->generate($metadatas, $destPath);

//        $this->info(sprintf('Entity classes generated to "%s"', $destPath));
    }
}
