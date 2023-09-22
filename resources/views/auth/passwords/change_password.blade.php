@extends('layouts.app')

@section('title')
    Change Password
@endsection

  
@push('css')
        
    <style>
        .label {
            margin: 0 20px 0 10px;
            padding: 3px 5px 2px;
            background-color: #F66;
        }
    </style> 

@endpush

@section('content')

<div id="page-wrapper">
    <div class="row">
    <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-lock fa-fw"></i> Change Password</h1>
    </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    
    <div class="panel panel-default" style="min-height: 200px;">
                            <div class="panel-heading">
                                <i class="fa fa-lock fa-fw"></i> Change Password
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">

                                @if(session()->has('error'))
                                <div class="notification alert alert-success  alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                            <div class="text-danger">
                                                {!! session('error') !!}
                                            </div>
                                </div>
                            @endif

                                @if(session()->has('success'))
                                <div class="notification alert alert-success  alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                            <div>
                                                {!! session('success') !!}
                                            </div>
                                </div>
                            @endif

                        <form id="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="text1" class="control-label col-lg-4">Old Password</label>
                            <div class="col-lg-8">
                            <input class="form-control" name="oldpassword" id="oldpassword" type="password">
                            @if($errors->any('oldpassword'))
                                <span class="text-danger">{{$errors->first('oldpassword')}}</span>
                            @endif
                        </div>
                        </div>
                       <div class="form-group">
                            <label for="text1" class="control-label col-lg-4">New Password</label>
                            <div class="col-lg-8">
                            <input class="form-control" name="newpassword" type="password">
                            @if($errors->any('newpassword'))
                                <span class="text-danger">{{$errors->first('newpassword')}}</span>
                            @endif
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4" style="float: right !important;">
                                <input class="btn btn-primary" type="submit" name="add" value="Change Password">
                           </div>
                        </div>
                        </form>
                        </div>
                
    </div>
    </div>
    
    
        
    
        
    </div>
    
                
                
                </div>


@endsection     
