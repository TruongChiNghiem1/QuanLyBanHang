@extends('admin.master')

@section('content')
    <form action="{{ route('admin.users.store') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Thêm tài khoảng</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Tên</label>
                            <input type="text" class="form-control" name="name" id="inputAddress"
                                value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Email</label>
                            <input type="email" class="form-control" name="email" id="inputAddress"
                                value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputAddress">Password</label>
                            <input type="password" class="form-control" name="password"
                                id="inputAddress"value="{{ old('password') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
