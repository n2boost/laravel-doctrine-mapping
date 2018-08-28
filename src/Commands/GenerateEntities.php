<?php

namespace N2boost\LaravelDoctrineMapping\Commands;


use Doctrine\ORM\Tools\EntityGenerator;
use Illuminate\Console\Command;
use N2boost\LaravelDoctrineMapping\Traits\OrmFunctions;

class GenerateEntities extends Command
{
    use OrmFunctions;

    protected $signature = 'n2boost:orm:generate-entities {--profile=default}';

    protected $description = 'Create a doctrine-mapping file';

    public function handle()
    {
        $config = config('laravel-doctrine-mapping');
        $profile_value = $this->option('profile');

        $em = $this->getEntityManager($profile_value);
        $metadatas = $this->getMetaData($em);

        $profile_data = $config['profiles'][$profile_value];
        $classes_dir = base_path($profile_data['entities_file_dir']);
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
