<?php

namespace App\Console\Commands;

use App\Models\Pet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearAllPets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pets:clear {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all pets from the database and delete their images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = Pet::count();
        
        if ($count === 0) {
            $this->info('No pets to clear.');
            return 0;
        }

        if (!$this->option('force')) {
            if (!$this->confirm("This will delete all {$count} pets and their images. Do you want to continue?")) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        $this->info("Clearing {$count} pets...");

        // Get all pets with images
        $pets = Pet::all();
        $deletedImages = 0;

        foreach ($pets as $pet) {
            if ($pet->image) {
                // Delete from storage
                if (Storage::disk('public')->exists($pet->image)) {
                    Storage::disk('public')->delete($pet->image);
                    $deletedImages++;
                }

                // Delete from public directory if exists
                $publicPath = public_path('images/' . $pet->image);
                if (file_exists($publicPath)) {
                    unlink($publicPath);
                }
            }
        }

        // Delete all pets
        Pet::query()->delete();

        $this->info("✓ Deleted {$count} pets");
        $this->info("✓ Deleted {$deletedImages} images");
        $this->info('All pets have been cleared from the database.');

        return 0;
    }
}
