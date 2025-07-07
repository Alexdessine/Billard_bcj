<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Console\Command;

class UpdateLicencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-licencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $script = public_path('script/licencies.py');
    
        $process = new \Symfony\Component\Process\Process(['C:\laragon\bin\python\python-3.10\python.exe', $script]);
        $process->run();
    
        // Capture la sortie complète
        $output = $process->getOutput();
        $errorOutput = $process->getErrorOutput();
    
        if (!$process->isSuccessful()) {
            $this->error("Erreur : $errorOutput");
            \Log::error('Erreur maj licenciés : ' . $errorOutput);
            echo $errorOutput;
            return 1;
        }
    
        $this->info("Sortie : $output");
        echo $output;
        return 0;
    }
}
