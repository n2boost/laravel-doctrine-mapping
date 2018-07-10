<?php

namespace N2boost\LaravelDoctrineMapping\Commands;

use Doctrine\ORM\Tools\SchemaTool;
use Illuminate\Console\Command;
use N2boost\LaravelDoctrineMapping\Traits\OrmFunctions;

class SchemeTool extends Command
{
    use OrmFunctions;

    protected $signature = 'n2boost:orm:scheme-tool:update';

    protected $description = 'Create a doctrine-mapping file';

    public function handle()
    {
        $em = $this->getEntityManager();
        $metadatas = $this->getMetaData($em);

        $schemaTool = new SchemaTool($em);
        $saveMode = true;

        $sqls = $schemaTool->getUpdateSchemaSql($metadatas, $saveMode);

        if (empty($sqls)) {
            $this->info('Nothing to update - your database is already in sync with the current entity metadata.');

            return 0;
        }

        $dumpSql = true;
        $force   = true;

        if ($dumpSql) {
            $this->info('The following SQL statements will be executed:');
            $this->info("");

            foreach ($sqls as $sql) {
                echo sprintf('    %s;', $sql);
            }
            echo "\n";
        }

        if ($force) {
            $this->info('Updating database schema...');

            $schemaTool->updateSchema($metadatas, $saveMode);

            $pluralization = (1 === count($sqls)) ? 'query was' : 'queries were';

            $this->info(sprintf('    <info>%s</info> %s executed', count($sqls), $pluralization));
            $this->info('Database schema updated successfully!');
        }

        return 1;
    }
}
