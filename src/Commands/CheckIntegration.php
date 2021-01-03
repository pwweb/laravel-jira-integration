<?php

/**
 * PWWEB\Jira\Commands.
 *
 * Definition of the Jira integration check artisan command.
 *
 * @author    FP <fp@pw-websolutions.com>
 * @author    RAB <rab@pw-websolutions.com>
 * @copyright 2021 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace PWWEB\Jira\Commands;

use Illuminate\Console\Command;

class CheckIntegration extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'pwweb:jira:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Jira integration';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Not yet implemented.');
    }
}
