<?php

namespace App\Http\Controllers;

use App\Models\EditKosakata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditKosakataController extends Controller
{
    //setujui perubahan detail kosakata
    public function setujui($slug, $id)
    {
        // dd($id);
        $editKosakata = EditKosakata::where('id', '=', $id)->first();

        // jika sudah diacc oleh pengurus lain
        if (isset($editKosakata->status)) {
            return back()->with('failed', 'Perubahan detail kosakata telah disetujui oleh pengurus lain');
        }

        // simpan perubahan
        EditKosakata::find($id)->update([
            'status' => now(),
            'pengurus_id' => Auth::user()->id
        ]);

        return back()->with('success', 'Perubahan detail kosakata disetujui');
    }
}
