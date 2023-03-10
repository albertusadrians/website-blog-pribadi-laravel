<table id="categoryTable" class="table table-striped table-sm my-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category Name</th>
            <th scope="col">Category Slug</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->category_slug }}</td>
                <td>
                    <!-- Button trigger modal -->
                    <button id="btnEditCategory" type="button" value="{{ $category->id }}" class="badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#formModal">
                        <span data-feather="edit"></span>
                    </button>
                    <button id="btnDeleteCategory" type="button" value="{{ $category->id }}" class="badge bg-danger border-0" data-bs-toggle="modal" data-bs-target="#formDelete">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>