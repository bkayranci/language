<?php

namespace Turkalp\Language\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Database\ModelIdentifier;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Input\InputArgument;

class MakeMigrationManyToManyTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:make-migration-many-to-many {modelName} {tableName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration for language many to many table';

    /**
     * Create a new command instance.
     *
     * @param $model
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $modelName = strtolower($this->argument('modelName'));

        if ($modelName == 'language') {
            $modelName = 'language2';
        }

        $tableName = $this->argument('tableName');

        $className = 'Language'.studly_case($modelName).'ManyToManyTable';

        $content = "<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class {$className} extends Migration
{

    public function up()
    {
        Schema::create('language_{$modelName}', function (Blueprint \$table) {
            \$table->increments('id');
            \$table->integer('{$modelName}_id')->unsigned()->index();
            \$table->integer('language_id')->unsigned()->index();
            \$table->timestamps();
        });

        Schema::table('language_{$modelName}', function (Blueprint \$table) {
            \$table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            \$table->foreign('{$modelName}_id')->references('id')->on('{$tableName}')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('language_{$modelName}', function (Blueprint \$table) {
            \$table->dropForeign(['language_id']);
            \$table->dropForeign(['{$modelName}_id']);
        });
        
        Schema::dropIfExists('language_{$modelName}');
    }
    
}
";

        $path = database_path('migrations/'.str_replace('-', '_', now()->toDateString() ).'_create_language_'.$modelName.'_many_to_many_table.php');
        fwrite(fopen($path, 'w'), $content);
    }
}
