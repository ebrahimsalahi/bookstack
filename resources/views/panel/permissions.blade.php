@section('title','گزارشات')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-dark">دسترسی ها</h1>
                        <ol class="breadcrumb float-sm-right mt-2 mb-2">
                            <li class="breadcrumb-item"><a href="{{route('panel')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active"> مشاهده دسترسی ها</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">

                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header mb-3">
                                <h3 class="card-title"> ویرایش دسترسی های سایت  </h3>
                            </div>
                            <!--  /.card-header -->

                            <div class="card-body">



                                    <div class="form-group">
                                        <label>یکی از دسترسی ها را انتخاب کنید</label>
                                        <select name="rolePermit" id="rolePermit" class="form-control select2 p-2" style="width: 100%;">
                                            <option selected="selected" value="0">انتخاب کنید</option>
                                            @foreach($rolePermit as $permission)
                                                <option value="{{$permission->id}}"> {{ $permission->display_name}} </option>
                                            @endforeach
                                        </select>
                                    </div>





                                <form action="{{route('updateRolePermit')}}" method="post"  id="rolePermitForm" class="form_ajaxi mb-3" enctype="multipart/form-data" style="display: none">
                                    @csrf
                                    <input type="hidden" name="permission_id" id="permission_id" value="">

                                    <textarea id="description" class="default-editor" name="description"></textarea>

                                    <button type="submit" class="btn btn-primary mt-3">ثبت تغییرات</button>
                                </form>

                            </div>





                            <div class="col-sm-6 mt-5">
                                <p>لیست کامل مجوز ها</p>
                                <table class="table table-striped">
                                    <tr>
                                        <td>نام </td>
                                        <td>نام فارسی</td>
                                        <td>تاریخ بروز رسانی</td>
                                    </tr>

                                    @foreach($rolePermit as $permission)
                                        <tr>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->display_name}}</td>
                                            <td>{{ jdate($permission->created_at)->format('%A, %d %B %Y,%H:%M') }}</td>
                                        </tr>
                                    @endforeach


                                </table>

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
