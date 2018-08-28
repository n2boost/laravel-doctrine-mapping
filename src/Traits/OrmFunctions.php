<?php

namespace N2boost\LaravelDoctrineMapping\Traits;

use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\DisconnectedClassMetadataFactory;

trait OrmFunctions
{
    public function getEntityManager()
    {
        $config = config('laravel-doctrine-mapping');

        if (!$config) {
            echo "请先导入配置文件： laravel-doctrine-mapping";
            exit(1);
        }

        if ($config['use_connection_pool'] === 'laravel') {
            $mysql_connections = config('database.connections');
            if (isset($config['connection'])) {
              $con = $config['connection'];
            } else {
              $con = "mysql";
            }
            $mysql_connection = $mysql_connections[$con];
            $database_config = [
                'driver' => 'pdo_mysql',
                'host' => $mysql_connection['host'],
                'port' => $mysql_connection['port'],
                'user' => $mysql_connection['username'],
                'password' => $mysql_connection['password'],
                'dbname' => $mysql_connection['database'],
                'charset' => $mysql_connection['charset'],
                'collate' => $mysql_connection['collation'],
            ];
        } else {
            $mysql_connection = $config['connections'][$config['connection']];
            $database_config = $mysql_connection;
        }

        $mapping_dir = base_path($config['mapping_file_dir']) . "/" . $config['mapping_type'];
        if (! is_dir($mapping_dir)) {

            echo "配置文件所在文件夹不存在 {$mapping_dir}\n";
            exit(1);
        }

        $metadata_config = Setup::createYAMLMetadataConfiguration([
            $mapping_dir,
        ], $config['isDevMode']);

        $entityManager = EntityManager::create($database_config, $metadata_config);
        $em = $entityManager;

        return $em;
    }

    public function getMetaData($em = null): array
    {
        $cmf = new DisconnectedClassMetadataFactory();

        $cmf->setEntityManager($em);

        $metadatas = $cmf->getAllMetadata();

        return $metadatas;
    }

    public function mapOrmCommands()
    {
        $commands = [
            //                // DBAL Commands
            //                new DBALConsole\Command\ImportCommand(),
            //                new DBALConsole\Command\ReservedWordsCommand(),
            //                new DBALConsole\Command\RunSqlCommand(),
            //
            //                // ORM Commands
            //                new Command\ClearCache\CollectionRegionCommand(),
            //                new Command\ClearCache\EntityRegionCommand(),
            //                new Command\ClearCache\MetadataCommand(),
            //                new Command\ClearCache\QueryCommand(),
            //                new Command\ClearCache\QueryRegionCommand(),
            //                new Command\ClearCache\ResultCommand(),
            //                new Command\SchemaTool\CreateCommand(),
            //                new Command\SchemaTool\UpdateCommand(),
            UpdateCommand::class,
            //                new Command\SchemaTool\DropCommand(),
            //                new Command\EnsureProductionSettingsCommand(),
            //                new Command\ConvertDoctrine1SchemaCommand(),
            //                new Command\GenerateRepositoriesCommand(),
            //                new Command\GenerateEntitiesCommand(),
            //                new Command\GenerateProxiesCommand(),
            //                new Command\ConvertMappingCommand(),
            //                new Command\RunDqlCommand(),
            //                new Command\ValidateSchemaCommand(),
            //                new Command\InfoCommand(),
            //                new Command\MappingDescribeCommand(),
        ];

        return $commands;
    }
}
