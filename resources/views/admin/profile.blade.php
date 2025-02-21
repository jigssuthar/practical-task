
@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('profile/'. $user->profile_pic) }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{$user->name}}</h3>
                <p class="text-muted text-center">{{$user->email}}</p>
                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">User deatils</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Password</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Delete account</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"  class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <!-- Post -->
                    <div class="post">
                        <div class="user-block">
                          {{-- <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image"> --}}
                          <label for="">Profile Image</label>
                          <input type="file" name="profile_pic" value="" class="form-control">
                        </div>
                    </div>
                    <div class="post">
                      <div class="user-block">
                        <label for="">Name</label> 
                        <input type="text" name="name" value="{{$user->name}}" class="form-control">
                      </div>
                    </div>
                    <div class="post">
                        <div class="user-block">
                          <label for="">Email</label>
                          <input type="text" name="email" value="{{$user->email}}" class="form-control">
                        </div>
                      </div>
                      <div class="post">
                        <div class="user-block">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                </form>
                    <!-- /.post -->

                    <!-- Post -->
                    
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                              <label for="">Current password</label>
                              <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                             <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="post">
                          <div class="user-block">
                            <x-input-label for="update_password_password" :value="__('New Password')" />
                            <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                          </div>
                        </div>
                        <div class="post">
                            <div class="user-block">
                                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                          </div>
                          <div class="post">
                            <div class="user-block">
                              <button class="btn btn-primary">Update</button>
                              @if (session('status') === 'password-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                            </div>
                          </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form method="post" action="{{ route('admin.profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                            placeholder="{{ __('Password') }}"
                        />
        
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                      </div>
                      <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-danger-button class="ms-3 btn btn-danger">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                     
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection