@extends('backend.layouts.app')
<!-- BEGIN: Body-->
@section('page-css')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

@section('content')
<!-- users edit start -->
<section class="users-edit">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger mb-2" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success mb-2" role="alert">
                        {{ Session::get('success')}}
                    </div>
                @endif
                <ul class="nav nav-tabs mb-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab"
                            href="#account" aria-controls="account" role="tab" aria-selected="true">
                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab"
                            href="#information" aria-controls="information" role="tab" aria-selected="false">
                            <i class="bx bx-info-circle mr-25"></i><span class="d-none d-sm-block">Information</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <!-- users edit media object start -->
                        <div class="media mb-2">
                            <a class="mr-2" href="#">
                                <img src="{{asset('images/portrait/small/avatar-s-26.jpg')}}" alt="users avatar"
                                    class="users-avatar-shadow rounded-circle" height="64" width="64">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Avatar</h4>
                                <div class="col-12 px-0 d-flex">
                                    <a href="#" class="btn btn-sm btn-primary mr-25">Change</a>
                                    <a href="#" class="btn btn-sm btn-light-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                        <!-- users edit media object ends -->
                        <!-- users edit account form start -->
                        <form method="POST" action="{{ route('backend.users.editUser', $user->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Username</label>
                                            <input data-validation-required-message="This username field is required"
                                                required placeholder="Username" class="form-control" type="text"
                                                value="{{$user->email}}">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Name</label>
                                            <input data-validation-required-message="This username field is required"
                                                required placeholder="Username" class="form-control" type="text"
                                                value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>E-mail</label>
                                            <input type="email" class="form-control" placeholder="Email"
                                                value={{$user->email}} required
                                                data-validation-required-message="This email field is required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="custom-select" id="customSelect">--}}
                                            <option selected="">{{$user->roles->pluck('name')->first()}}</option>
                                            @foreach($roles as $role)
                                                @if( $user->roles->pluck('name')->first() != $role)
                                                    <option value="{{$role}}">
                                                        {{$role}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control">
                                            <option>Active</option>
                                            <option>Banned</option>
                                            <option>Close</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save changes</button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit account form ends -->
                    </div>
                    <div class="tab-pane fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                        <!-- users edit Info form start -->
                        <form novalidate>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h5 class="mb-1"><i class="bx bx-link mr-25"></i>Social Links</h5>
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input class="form-control" type="text" value="https://www.twitter.com/">
                                    </div>
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input class="form-control" type="text" value="https://www.facebook.com/">
                                    </div>
                                    <div class="form-group">
                                        <label>Google+</label>
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>LinkedIn</label>
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input class="form-control" type="text" value="https://www.instagram.com/">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                    <h5 class="mb-1"><i class="bx bx-user mr-25"></i>Personal Info</h5>
                                    <div class="form-group">
                                        <div class="controls position-relative">
                                            <label>Birth date</label>
                                            <input type="text" class="form-control birthdate-picker" required
                                                placeholder="Birth date"
                                                data-validation-required-message="This birthdate field is required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control" id="accountSelect">
                                            <option>USA</option>
                                            <option>India</option>
                                            <option>Canada</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Languages</label>
                                        <select class="form-control" id="users-language-select2" multiple="multiple">
                                            <option value="English" selected>English</option>
                                            <option value="Spanish">Spanish</option>
                                            <option value="French">French</option>
                                            <option value="Russian">Russian</option>
                                            <option value="German">German</option>
                                            <option value="Arabic" selected>Arabic</option>
                                            <option value="Sanskrit">Sanskrit</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" required placeholder="Phone number"
                                                value="(+656) 254 2568"
                                                data-validation-required-message="This phone number field is required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label>Address</label>
                                            <input type="text" class="form-control" placeholder="Address"
                                                data-validation-required-message="This Address field is required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" placeholder="Website address">
                                    </div>
                                    <div class="form-group">
                                        <label>Favourite Music</label>
                                        <select class="form-control" id="users-music-select2" multiple="multiple">
                                            <option value="Rock">Rock</option>
                                            <option value="Jazz" selected>Jazz</option>
                                            <option value="Disco">Disco</option>
                                            <option value="Pop">Pop</option>
                                            <option value="Techno">Techno</option>
                                            <option value="Folk" selected>Folk</option>
                                            <option value="Hip hop">Hip hop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Favourite movies</label>
                                        <select class="form-control" id="users-movies-select2" multiple="multiple">
                                            <option value="The Dark Knight" selected>The Dark Knight
                                            </option>
                                            <option value="Harry Potter" selected>Harry Potter</option>
                                            <option value="Airplane!">Airplane!</option>
                                            <option value="Perl Harbour">Perl Harbour</option>
                                            <option value="Spider Man">Spider Man</option>
                                            <option value="Iron Man" selected>Iron Man</option>
                                            <option value="Avatar">Avatar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                        Save
                                        changes
                                    </button>
                                    <button type="reset" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <!-- users edit Info form ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('page-js')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>

<script src="{{asset('js/scripts/pages/page-users.js')}}"></script>
<script src="{{asset('js/scripts/navs/navs.js')}}"></script>
@endsection
