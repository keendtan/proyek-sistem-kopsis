<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanMenuDuplicates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:dedupe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove duplicate entries from menu table keeping one per (menu,module,routing,parent_id)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Cleaning duplicate menu entries...');

        // Keep the row with the smallest id for each group
        $sql = "DELETE FROM menu
            WHERE id NOT IN (
                SELECT id_keep FROM (
                    SELECT MIN(id) AS id_keep FROM menu GROUP BY menu, module, routing, parent_id
                ) AS keepers
            )";

        DB::statement($sql);

        $this->info('Duplicate menu entries removed.');

        return Command::SUCCESS;
    }
}
