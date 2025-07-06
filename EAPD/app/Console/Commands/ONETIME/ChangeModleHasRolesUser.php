<?php

namespace App\Console\Commands\ONETIME;

use DB;
use Illuminate\Console\Command;

class ChangeModleHasRolesUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-modle-has-roles-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change morph relationships to roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement("UPDATE model_has_roles SET model_type = 'App\\\\User' WHERE model_type = 'App\\\\Models\\\\User'");
    }
}
