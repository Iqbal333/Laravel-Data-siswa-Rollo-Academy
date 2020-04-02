@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Inputs</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Depan</label>
                                    <input name="nama_depan" type="text" value="{{$siswa->nama_depan}}" class="form-control" placeholder="Nama Depan">
                                </div>
            
                                <div class="form-group">
                                    <label>Nama Belakang</label>
                                    <input name="nama_belakang" value="{{$siswa->nama_belakang}}" type="text" class="form-control" placeholder="Nama Belakang">
                                </div>
            
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                                        <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki-laki</option>
                                        <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
            
                                <div class="form-group">
                                    <label>Agama</label>
                                    <input name="agama" value="{{$siswa->agama}}" type="text" placeholder="Agama" class="form-control">
                                </div>
            
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Alamat</label>
                                    <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{$siswa->alamat}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Avatar</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                            
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-warning" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('content1')
         <h1>Edit Data Siswa</h1>
         @if(session('sukses'))
        <div class="alert alert-success" role="alert">
          {{session('sukses')}} 
        </div>
        @endif
         <div class="row">
            <div class="col-12">
                <form action="/siswa/{{$siswa->id}}/update" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Depan</label>
                        <input name="nama_depan" type="text" value="{{$siswa->nama_depan}}" class="form-control" placeholder="Nama Depan">
                    </div>

                    <div class="form-group">
                        <label>Nama Belakang</label>
                        <input name="nama_belakang" value="{{$siswa->nama_belakang}}" type="text" class="form-control" placeholder="Nama Belakang">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                            <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki-laki</option>
                            <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Agama</label>
                        <input name="agama" value="{{$siswa->agama}}" type="text" placeholder="Agama" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{$siswa->alamat}}</textarea>
                    </div>
                
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-warning" type="submit">Update</button>
                </form>
            </div>
         </div>
@endsection