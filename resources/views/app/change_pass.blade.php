@extends('layouts.default')
@section('content')
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="page-title">Change Password</h4>
                <form method="post" action="{{ url('change-password') }}">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Old Password</label>
                            <input type="password" class="form-control" name="old_password" required="" placeholder="Old Password...">
                        </div>
                        <div class="form-group">
                            <label class="control-label">New Password</label>
                            <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New Password..." required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <input type="password" id="confirm_password" class="form-control" placeholder="Confirm password..." required="">
                            <div id="text-result"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" id="btn_submit" disabled class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->

    <script>
        $(document).ready(function(){
            $("#confirm_password").keyup(function(){
                if($("#confirm_password").val() == $("#new_password").val()){
                    console.log("sukses")
                    $("#text-result").html('<p>Password match!</p>')
                    $("#btn_submit").removeAttr('disabled');
                }else{
                    console.log("error")
                    $("#text-result").html('<p>Password not match!<p>')
                    $("#btn_submit").prop('disabled',true);
                }
            })
        })
    </script>
@endsection