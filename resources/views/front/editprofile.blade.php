@extends('front.layouts.dashboard')
@section('main')

  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Home</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('myprofile') }}" class="btn btn-primary">Dashboard</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        @php
            $profile = 'images/user-1.svg';
            if (Auth::user()->gender == 'Female') {
                $profile = 'images/user-2.svg';
            }
        @endphp
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
    @if(Auth::check())
        <img src="{{ asset('images/profile/' . Auth::user()->image) }}" 
             onerror="this.onerror=null;this.src='{{ asset($profile ?? 'front/assets/img/default-avatar.png') }}';" 
             alt="{{ Auth::user()->name }}" 
             class="rounded-circle p-1 bg-primary" 
             width="110" 
             height="110"
             id="profileImage">
        
        <div class="mt-3">
            <h4>{{ Auth::user()->name }}</h4>
            
            {{-- Show role name --}}
            <p class="text-secondary mb-1">
                @if(Auth::user()->role)
                    {{ Auth::user()->role->name }}
                @elseif(Auth::user()->roles && Auth::user()->roles->name)
                    {{ Auth::user()->roles->name }}
                @else
                    {{ Auth::user()->role_id ?? 'User' }}
                @endif
            </p>
            
            <form action="{{ route('profile-upload-image') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                @csrf
                
                {{-- Hidden file input --}}
                <input type="file" name="profile_image" id="profileInput" class="d-none" accept="image/*">
                
                {{-- Button to trigger file input --}}
                <button type="button" class="btn btn-outline-primary" id="uploadTriggerBtn">
                    Change Profile
                </button>
            </form>
        </div>
         @else
            <div class="text-center">
            <p>Please login to view profile</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
              </div>
                 @endif
                   </div>
                        <hr class="my-4" />
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="bx bx-id-card"></i> Code</h6>
                                <span class="text-secondary">{{ auth()->user()->code }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="bx bx-mail-send"></i> Email</h6>
                                <span class="text-secondary">{{ auth()->user()->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><i class="bx bx-phone"></i> Phone Number</h6>
                                <span class="text-secondary">{{ auth()->user()->phone_number }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile-update') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Gender</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror me-2" id="gender">
                                        <option disabled value="" @selected('' == auth()->user()->role_id)>Choose...</option>
                                        <option value="Male" @selected('Male' == auth()->user()->role_id)>Male</option>
                                        <option value="Female" @selected('Female' == auth()->user()->role_id)>Female</option>
                                        <option value="Other" @selected('Other' == auth()->user()->role_id)>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">DOB</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="date" name="dob" class="form-control" value="{{ auth()->user()->dob }}" />
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Father Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="father_name" value="{{ auth()->user()->father_name }}" />
                                    @error('father_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mother Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="mother_name" value="{{ auth()->user()->mother_name }}" />
                                    @error('mother_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadTriggerBtn = document.getElementById('uploadTriggerBtn');
    const profileInput = document.getElementById('profileInput');
    const profileForm = document.getElementById('profileForm');
    const profileImage = document.getElementById('profileImage');
    
    if (uploadTriggerBtn && profileInput) {
        uploadTriggerBtn.addEventListener('click', function() {
            profileInput.click();
        });
        profileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
                
                // Auto-submit form
                profileForm.submit();
            }
        });
    }
});
</script>


