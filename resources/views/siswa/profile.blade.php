@extends('layouts.master')
@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            @if(session('sukses'))
                <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
            @endif
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{$siswa->getAvatar()}}" width="150px" height="150px" class="img-circle" alt="Avatar">
                                <h3 class="name">{{$siswa->nama_depan}}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        15 <span>Awards</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        2174 <span>Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Detail Data Diri</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Jenis Kelamin <span>{{$siswa->jenis_kelamin}}</span></li>
                                    <li>Agama <span>{{$siswa->agama}}</span></li>
                                    <li>Alamat <span>{{$siswa->alamat}}</span></li>
                                </ul>
                            </div>
                           
                            <div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning">Edit Profile</a></div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                   <div class="profile-right">
                       <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">Tambah Nilai Siswa</button>
                        <!-- TABLE STRIPED -->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mata Kuliah</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Semester</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswa->mapel as $mapel)
                                        <tr>
                                            <td>{{$mapel->kode}}</td>
                                            <td>{{$mapel->nama}}</td>
                                            <td>{{$mapel->semester}}</td>
                                            <td>{{$mapel->pivot->nilai}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END TABLE STRIPED -->
                   </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

<!-- Modal Tambah Nilai Siswa -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/siswa/{{$siswa->id}}/addnilai" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="my-input">Mata Kuliah</label>
                        <select name="mapel" id="exampleFormControlSelect1" class="form-control">
                           @foreach($matkul as $mt)
                            <option value="{{$mt->id}}">{{$mt->nama}}</option>
                           @endforeach
                        </select>
                    </div>

                    <div class="form-group {{$errors->has('nilai') ? 'has-error' : ''}}">
                      <label>Nilai</label>
                      <input name="nilai" type="text" class="form-control" placeholder="Nilai" value="{{old('nilai')}}" >
                      @if($errors->has('nilai'))
                        <span class="help-block">{{$errors->first('nilai')}}</span>
                      @endif
                    </div>
           
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop