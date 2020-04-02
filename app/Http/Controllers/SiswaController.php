<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use User;
use App\Mapel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari'))
        {
            $data_siswa = Siswa::where('nama_depan', 'LIKE', '%'.$request->cari.'%')->get();
        } else {
            $data_siswa = \App\Siswa::all();
        }
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    } 

    public function create(Request $request)
    {
        #dd($request->all());
       $this->validate($request, [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpg,png'
       ]);
       //Insert ke table Users
       $user = new \App\User;
       $user->role = 'siswa';
       $user->name = $request->nama_depan;
       $user->email = $request->email;
       $user->password = bcrypt('123123123');
       $user->remember_token = str_random(60);
       $user->save();

       //Insert ke table Siswa
       $request->request->add(['user_id' => $user->id ]);
       $siswa = \App\Siswa::create($request->all());
       if($request->hasFile('avatar'))
       {
           $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
           $siswa->avatar = $request->file('avatar')->getClientOriginalName();
           $siswa->save();
       }
       return redirect('/siswa')->with('sukses', 'Data berhasil diinput');
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('siswa/edit', ['siswa' => $siswa]);
    }  

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->update($request->all());
        if($request->hasFile('avatar'))
        {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil diupdate!');
    }

    public function delete($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect('/siswa')->with('sukses', 'Data berhasil dihapus');
    }

    public function profile($id)
    {
        $siswa = Siswa::find($id);
        $matkul = Mapel::all();
        return view('siswa.profile', ['siswa' => $siswa, 'matkul' => $matkul]);
    }

    public function addnilai(Request $request, $idsiswa)
    {
        $siswa = Siswa::find($idsiswa);
        if($siswa->mapel()->where('mapel_id', $request->mapel)->exists())
        {
            return redirect('siswa/'.$idsiswa.'/profile')->with('error', 'Data Mata kuliah sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);
        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses', 'Data Nilai Berhasil dimasukkan!');
    }
}
 