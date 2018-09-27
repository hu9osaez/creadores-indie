<?php namespace CreadoresIndie\Console\Commands;

use CreadoresIndie\Models\Discussion;
use Illuminate\Console\Command;

class RecountReplies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ci:recount-replies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recount replies for each discussion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $discussions = Discussion::withCount('replies as rc')->get();

        $discussions->each(function (Discussion $discussion) {
            $discussion->update([
                'replies_count' => $discussion->rc
            ]);
        });
    }
}
