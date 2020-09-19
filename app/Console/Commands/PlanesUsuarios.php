<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class PlanesUsuarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planes:usuarios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $user = User::get();
        $Fecha = Carbon::now('GMT-5');
        $FechaActual = $Fecha->toDateString();
        
        foreach($user as $s){
           $prueba[]= $s->fecha_inicio;
            
            if($s->tipo_plan == 'basico' &&  $s->fecha_inicio->addDays(90)->toDateString() >= $FechaActual){

                $userD= User::findOrFail($s->id);
                Auth::setUser($userD);
                Auth::logout();
                $userD->delete();
            
            }elseif($s->tipo_plan == 'medio' &&  $s->fecha_inicio->addDays(182)->toDateString() >= $FechaActual){

                $userD= User::findOrFail($s->id);
                Auth::setUser($userD);
                Auth::logout();
                $userD->delete();
               

            }elseif($s->tipo_plan == 'completo' &&  $s->fecha_inicio->addDays(364)->toDateString() >= $FechaActual){

                $userD= User::findOrFail($s->id);
                Auth::setUser($userD);
                Auth::logout();
                $userD->delete();
          

            }
             
        }
    
    }
}
