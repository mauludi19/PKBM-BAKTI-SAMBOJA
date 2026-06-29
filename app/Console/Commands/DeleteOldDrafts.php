<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\News;

#[Signature('app:delete-old-drafts')]
#[Description('Command description')]
class DeleteOldDrafts extends Command
{
    
    public function handle()
    {
        $deleted = News::where('is_published', false)
            ->where('created_at', '<=', now()->subDays(30))
            ->delete();

        $this->info("Berhasil menghapus {$deleted} draft.");

        return self::SUCCESS;
    }
}
