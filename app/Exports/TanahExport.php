<?php

namespace App\Exports;

use App\Models\Tanah;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
class TanahExport implements FromView
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $user = User::findOrFail($this->id);
        if($user->can('pimpinan')){
            $tanah = Tanah::with('user')->get();

        }else{
            $tanah = Tanah::with('user')->where('user_id',$this->id)->get();
        }
        
   
         return view('exports.tanah', [
            'tanah' => $tanah
        ]);
    }
}
