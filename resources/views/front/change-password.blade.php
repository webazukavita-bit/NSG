@extends('front.layouts.dashboard')
@section('main')

    <div>
        <div class="card-body">

            <div class="row justify-content-center mb-5 mt-5">
                
                <div class="col-md-6 mb-5 mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary">
                            <h5 class="mb-0 text-white">Change Password</h5>
                        </div>
                        <div class="card-body">
                             <form  action="{{ route('client-chnage-password') }}" method="POST">
                                 <input type="hidden" id="user_id" name="user_id">
                               <div class="mb-3">
                            <label for="password" class="form-label">Enter New Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="password" name="password" value="{{ old('user_id') }}" required placeholder="Enter Password"> 
                                <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Enter Confirm Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="confirm_password" name="confirm_password" required placeholder="Enter Password"> 
                                <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                            </div>
                        </div>


                                <button type="submit" class="btn btn-success mb-3 mt-3">Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

  
        </div>
    </div>
@endsection