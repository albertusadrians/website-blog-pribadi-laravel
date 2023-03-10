@extends('dashboard.layouts.main')
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Categories</h1>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-8">
        <div id="success_message"></div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="btnAddCategory" data-bs-target="#formModal">
            Add New Category
        </button>
        {{-- <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table> --}}
        <div id="tableCategories" class="my-3"></div>

        <table id="categoryTable" class="table table-striped table-sm my-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Image</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Category Slug</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>


    <!-- Modal: Create, Update -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formModalLabel">Add New Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <ul id="err_validation"></ul>
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                            id="category_name" name="category_name" required value="{{ old('category_name') }}">
                        <div id="invalid-category-name" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="category_slug" class="form-label">Category Slug</label>
                        <input type="text" class="form-control @error('category_slug') is-invalid @enderror"
                            id="category_slug" name="category_slug" required value="{{ old('category_slug') }}">
                        <div id="invalid-category-slug" class="invalid-feedback"></div>
                    </div>
                    <div class="input-group mb-3 category-image">
                        
                        <input type="file" class="form-control d-block" name="category_image" id="inputCategoryImage">
                        <span id="uploaded_image"></span>
                    </div>

                    <div id="preview-image">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="btnSaveCategory" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Delete -->
    <div class="modal fade" id="formDelete" tabindex="-1" aria-labelledby="formDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formDeleteLabel">Delete Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <ul id="err_validation"></ul>
                    <div class="mb-3">
                        <h4>Are you sure want to delete this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" id="yesDelete" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
