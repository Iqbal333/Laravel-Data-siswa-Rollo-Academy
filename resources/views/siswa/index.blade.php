@extends('layouts.master')
@section('content')
         @if(session('sukses'))
        <div class="alert alert-success" role="alert">
          {{session('sukses')}} 
        </div>
        @endif
          <div class="row">
              <div class="col-6">
                <h1>Belajar Data siswa</h1> 
              </div>

              <div class="col-6">
                  <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data Siswa
                </button>
              </div>
              
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>Nama Depan</th> 
                    <th>Nama Belakang</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
        
                @foreach($data_siswa as $siswa)
                <tr>
                    <td>{{ $siswa->nama_depan }}</td>
                    <td>{{ $siswa->nama_belakang }}</td>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                    <td>{{ $siswa->agama }}</td>
                    <td>{{ $siswa->alamat }}</td>
                    <td>
                      <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                      <a href="/siswa/{{$siswa->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')">Delete</a>
                    </td>
                </tr>
        
                @endforeach
            </table>
          </div>
      </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                  <form action="/siswa/create" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Nama Depan</label>
                      <input name="nama_depan" type="text" class="form-control" placeholder="Nama Depan">
                      <small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                      <label>Nama Belakang</label>
                      <input name="nama_belakang" type="text" class="form-control" placeholder="Nama Belakang">
                      <small class="form-text text-muted" id="emailHelp">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                      <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Agama</label>
                      <input name="agama" type="text" placeholder="Agama" class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Alamat</label>
                      <textarea name="alamat" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group"> 
                      <label for="exampleInputPassword1">Password</label>
                      <input name="password " type="password" id="exampleInputPassword1" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" id="exampleCheck1" class="form-check-input">
                      <label for="exampleCheck1" class="form-check-label">Check me out</label>
                    </div>
                  
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Submit</button>
              </form>
                </div>
            </div>
            </div>
        </div>
@endsection