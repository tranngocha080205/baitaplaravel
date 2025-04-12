@extends('layoutbanhang.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <h1 class="page-header">Category <small>Add</small></h1>

            <form action="#" method="POST">
                {{-- CSRF --}}
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" placeholder="Please Enter Category Name" />
                </div>
                <div class="form-group">
                    <label>Category Parent</label>
                    <select class="form-control" name="parent_id">
                        <option value="0">None</option>
                        {{-- Vòng lặp category ở đây --}}
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Category Add</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
