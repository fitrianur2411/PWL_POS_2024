@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Profile Image Section -->
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <!-- Avatar -->
                        <img src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : asset('default-avatar.png') }}"
                            class="rounded-circle img-fluid mb-3 shadow" style="width: 150px; height: 150px;" alt="Avatar">
                    </div>

                    <!-- User Info -->
                    <h3 class="profile-username text-center">{{ auth()->user()->nama }}</h3>
                    <p class="text-muted text-center">{{ auth()->user()->level->level_nama }}</p>

                    <!-- Upload New Profile Picture -->
                    <ul class="list-group list-group-unbordered mb-3">
                        <form action="{{ url('/profil/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="avatar" class="btn btn-outline-primary btn-block">
                                    <i class="fas fa-upload"></i> Ganti Foto Profil
                                </label>
                                <input type="file" name="avatar" id="avatar" class="d-none" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Unggah</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- Main Content Section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><i class="fas fa-history"></i> Activity</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"><i class="fas fa-cog"></i> Settings</a></li>
                    </ul>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Activity Tab -->
                        <div class="active tab-pane" id="activity">
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                        src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : asset('images/user-placeholder.jpg') }}"
                                        alt="user image">
                                    <span class="username">
                                        <a href="#">Fitria Nur</a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                    </span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <p>Hello Word</p>
                                <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                    <span class="float-right">
                                        <a href="#" class="link-black text-sm"><i class="far fa-comments mr-1"></i> Comments (5)</a>
                                    </span>
                                </p>
                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                        </div>
                        <!-- /.tab-pane -->

                        <!-- Settings Tab -->
                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal" action="{{ url('/profile/update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" name="nama" value="{{ auth()->user()->nama }}" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" name="email" value="{{ auth()->user()->email }}" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword" name="password" value="{{ auth()->user()->Password }}" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
    document.getElementById('avatar').onchange = function () {
        this.nextElementSibling.innerHTML = this.files[0].name;
    };
</script>
@endsection
