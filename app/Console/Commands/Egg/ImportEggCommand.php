<?php

namespace MantaCil\Console\Commands\Egg;

use Illuminate\Console\Command;
use MantaCil\Models\Nest;
use MantaCil\Models\Egg;
use MantaCil\Services\Eggs\Sharing\EggImporterService;
use Illuminate\Http\UploadedFile;

class ImportEggCommand extends Command
{
    protected $signature = 'p:egg:import {file : The path to the JSON file to import} {nest_id=1 : The ID of the nest to import into}';

    protected $description = 'Import an egg from a JSON file directly.';

    public function handle(EggImporterService $importer)
    {
        $filePath = $this->argument('file');
        $nestId = $this->argument('nest_id');

        if (!file_exists($filePath)) {
            $this->error("The file {$filePath} does not exist.");
            return;
        }

        $uploadedFile = new UploadedFile(
            $filePath,
            basename($filePath),
            'application/json',
            null,
            true
        );

        try {
            $egg = $importer->handle($uploadedFile, $nestId);
            $this->info("Successfully imported egg: {$egg->name}");
        } catch (\Exception $e) {
            $this->error("Failed to import egg: " . $e->getMessage());
        }
    }
}
