@section('title','نقش ها')

@push('files')
    <link rel="stylesheet" href="{{url('panel/plugins/iCheck/all.css')}}">

    <script src="{{url('panel/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            increaseArea: '-10%'
        });
    </script>
@endpush
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">نقش ها</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active">مشاهده نقش ها</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header mb-3">
                                <h3 class="card-title">مشخثات نقش</h3>
                            </div>
                            <!--  /.card-header -->

                            <div class="card-body table-responsive ">
                                <form action="{{route('updateRole',$role->id)}}" method="post" class="form_ajaxi">
                                    @csrf
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">نام نقش</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}" >
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="description">توضیحات</label>
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="1">{{$role->description}}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="font-weight-bold mb-3 text-danger">
                                        دسترسی های نقش
                                        (حداقل یک دسترسی باید انتخاب شود)
                                    </div>
                                    <div class="row mb-4">


                                        @foreach($rolePermit as $permission)
                                            <div class="col-lg-3 m-1">
                                                <div class="form-check">
                                                    <label class="form-check-label">

                                                        <input type="checkbox"
                                                               @foreach ($role->permissions as $permit)
                                                                   @if($permit->name == $permission->name) checked @endif
                                                               @endforeach

                                                               class="icheckbox  form-check-input pr-5" value="{{$permission->id}}" name="permissions[]">
                                                        <span>{{$permission->display_name}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">  ثبت ویرایش  </button>
                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@extends('panel.layouts.master')
