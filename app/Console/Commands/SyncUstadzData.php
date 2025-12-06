<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncUstadzData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ustadz:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Ustadz data with Users and assign Santri';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting Ustadz data sync...');
        
        // 1. Sync existing Ustadz with Users
        $ustadzList = \App\Models\Ustadz::whereNull('user_id')->get();
        foreach ($ustadzList as $ustadz) {
            $user = \App\Models\User::where('name', $ustadz->nama)
                                    ->orWhere('email', 'like', '%' . strtolower(str_replace(' ', '', $ustadz->nama)) . '%')
                                    ->first();
            
            if ($user) {
                $ustadz->user_id = $user->id;
                $ustadz->save();
                $this->info("✓ Linked Ustadz '{$ustadz->nama}' to User '{$user->name}'");
            }
        }
        
        // 2. Get first Ustadz (or create one if none exists)
        $firstUstadz = \App\Models\Ustadz::first();
        
        if (!$firstUstadz) {
            $this->error('No Ustadz found in database. Please create at least one Ustadz first.');
            return Command::FAILURE;
        }
        
        // 3. Assign all Santri without ustadz_id to first Ustadz
        $orphanedSantri = \App\Models\Santri::whereNull('ustadz_id')->orWhere('ustadz_id', 0)->get();
        foreach ($orphanedSantri as $santri) {
            $santri->ustadz_id = $firstUstadz->id;
            $santri->save();
        }
        $this->info("✓ Assigned {$orphanedSantri->count()} Santri to Ustadz '{$firstUstadz->nama}'");
        
        // 4. Assign all Hafalan without ustadz_id to first Ustadz
        $orphanedHafalan = \App\Models\Hafalan::whereNull('ustadz_id')->orWhere('ustadz_id', 0)->get();
        foreach ($orphanedHafalan as $hafalan) {
            $hafalan->ustadz_id = $firstUstadz->id;
            $hafalan->save();
        }
        $this->info("✓ Assigned {$orphanedHafalan->count()} Hafalan records to Ustadz '{$firstUstadz->nama}'");
        
        $this->info('✅ Sync completed successfully!');
        return Command::SUCCESS;
    }
}
