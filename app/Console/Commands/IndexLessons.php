<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Documentation\Lessons;

class IndexLessons extends Command
{
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'lessons:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all documentation on Algolia';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app(Lessons::class)->indexAllDocuments();
    }
}
