$(document).ready(function () {
    // Data Table List User
    $("#userTable").DataTable();

    // Data Table List Category
    //$('#categoryTable').DataTable();

    var category_id = 0;
    var old_category_img = "";
    var new_category_img = null;
    console.log("Ready!");
    // fetchCategories();
    //fetchCategory()

    //var dTableCategory = new $('#categoryTable').DataTable();

    var dTableCategory = new $("#categoryTable").DataTable({
        ajax: {
            type: "GET",
            url: "/dashboard/categories/fetch-categories",
            dataType: "json",
        },
        destroy: true,
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            {
                data: "category_image",
                render: function (data) {
                    if (data != null) {
                        return (
                            '<img src="/storage/' +
                            data +
                            '" id="previewCategoryImg" class="img-preview img-fluid mb-3 col-sm-5 d-block"></img>'
                        );
                    }
                    return '<img src="" id="previewCategoryImg" class="img-preview img-fluid mb-3 col-sm-5 d-block"></img>'
                },
            },
            {
                data: "category_name",
                render: function (data) {
                    return "<strong>" + data + "</strong>";
                },
            },
            {
                data: "category_slug",
            },
            {
                data: "id",
                render: function (data) {
                    return (
                        "<button id='btnEditCategory' class='btn btn-sm btn-primary' value='" +
                        data +
                        "'><span data-feather='edit'>Edit</button>" +
                        "  <button id='btnDeleteCategory' class='btn btn-sm btn-danger' value='" +
                        data +
                        "'><span data-feather='edit'  data-bs-toggle='modal' data-bs-target='#formDelete'>Delete</button>"
                    );
                },
            },
        ],
    });

    /*function fetchCategory() {
        $.ajax({
            type: "GET",
            url: "{{ url('/dashboard/categories/fetch-categories') }}",
            dataType: "json",
            success: function(response) {
                {{-- console.log(response.categories); --}}
                $('tbody').html('');
                $.each(response.categories, function(key, item) {
                    $('tbody').append('<tr>\
                            <td>' + item.id + '</td>\
                            <td>' + item.category_name + '</td>\
                            <td>' + item.category_slug + '</td>\
                            <td>' + item.category_slug + '</td>\
                            <td><button type="button" value="' + item.category_id + '" class="btn btn-primary btn-sm">Edit</button></td>\
                            <td><button type="button" value="' + item.category_id + '" class="btn btn-danger btn-sm">Delete</button></td>\
                            </tr>')
                });
            }
        })
        console.log("kategori");
    }*/

    /*function fetchCategories() {
        console.log("function fetchCategories()");
        $.get("{{ url('/dashboard/categories/fetch-categories') }}", {}, function(data, status) {
            //$('#tableCategories').html(data);
            //console.log(data);
        });
    }*/

    $(document).on("click", "#btnSaveCategory", function (e) {
        e.preventDefault();
        var category_name_val = $("#category_name").val();
        var category_slug_val = $("#category_slug").val();
        console.log(category_name_val, category_slug_val);
        var img = $("#inputCategoryImage")[0].files;
        // console.log(img[0]);
        if (img.length != 0) {
            new_category_img = img[0];
        }
        var form_data = new FormData();
        form_data.append("category_name", category_name_val);
        form_data.append("category_slug", category_slug_val);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        if (category_id == 0) {
            form_data.append("category_image", new_category_img);
            $.ajax({
                type: "POST",
                url: "/dashboard/categories",
                data: form_data,
                contentType: false,
                dataType: "json",
                processData: false,
                // beforeSend: function () {
                //     $("#uploaded_image").html(
                //         "<label class='text-success'>Image uploading...</label>"
                //     );
                // },
                success: function (res) {
                    $("#err_validation").html("");
                    $("#success_message").addClass("alert alert-success");
                    $("#success_message").text(res.message);
                    $("#formModal").modal("hide");
                    $("#formModal").find("input").val("");
                    // fetchCategory();
                    // fetchCategories();
                    dTableCategory.ajax.reload();
                    new_category_img = null;
                    old_category_img = "";
                },
                error: function (xhr, status, error) {
                    $("#err_validation").html("");
                    $("#err_validation").addClass("alert alert-danger");
                    $.each(
                        xhr.responseJSON.errorMessage,
                        function (key, err_values) {
                            $("#err_validation").append(
                                "<li>" + err_values + "</li>"
                            );
                        }
                    );
                    new_category_img = null;
                    old_category_img = "";
                },
            });
        } else {
            if (old_category_img != "") {
                if (new_category_img != null) {
                    form_data.append("category_image", new_category_img);
                    form_data.append("old_category_image", old_category_img);
                } else {
                    form_data.append("old_category_image", old_category_img);
                }
            }
            form_data.append("_method", "PUT");
            // console.log(data.category_name + " - " + data.category_slug);
            console.log(
                form_data.get("category_name") +
                    " dan " +
                    form_data.get("category_slug")
            );
            $.ajax({
                url: "/dashboard/categories/" + category_id,
                type: "POST",
                data: form_data,
                contentType: false,
                dataType: "json",
                processData: false,
                success: function (res) {
                    $("#err_validation").html("");
                    $("#success_message").addClass("alert alert-success");
                    $("#success_message").text(res.message);
                    $("#formModal").modal("hide");
                    // fetchCategories();
                    dTableCategory.ajax.reload();
                    new_category_img = null;
                    old_category_img = "";
                },
                error: function (xhr, status, error) {
                    $("#err_validation").html("");
                    $("#err_validation").addClass("alert alert-danger");
                    $.each(
                        xhr.responseJSON.errorMessage,
                        function (key, err_values) {
                            $("#err_validation").append(
                                "<li>" + err_values + "</li>"
                            );
                        }
                    );
                    new_category_img = null;
                    old_category_img = "";
                },
            });
        }
    });

    $(document).on("click", "#btnEditCategory", function (e) {
        e.preventDefault();
        category_id = $(this).val();
        // console.log(category_id);
        $("#formModalLabel").html("Edit Category");
        $("#btnSaveCategory").html("Update");
        $.ajax({
            type: "GET",
            url: "/dashboard/categories/" + category_id,
            dataType: "json",
            success: function (response) {
                $("#formModal").modal("toggle");
                console.log(response);
                if (response.status == 404) {
                    $("#success_message").html("");
                    $("#success_message").addClass("alert alert-danger");
                    $("#success_message").text(response.message);
                } else {
                    $("#category_name").val(response.category.category_name);
                    $("#category_slug").val(response.category.category_slug);
                    old_category_img = response.category.category_image;
                    if (old_category_img != "") {
                        var img_html =
                            '<img src="/storage/' +
                            response.category.category_image +
                            '" id="previewCategoryImg" class="img-preview img-fluid mb-3 col-sm-5 d-block"></img>';
                        // $(".category-image").after(img_html);
                        $("#preview-image").html(img_html);
                    }
                }
            },
        });
    });

    $(document).on("click", "#btnAddCategory", function (e) {
        e.preventDefault();
        category_id = 0;
        $("#formModalLabel").html("Add Category");
        $("#btnSaveCategory").html("Save");
    });

    $("#formModal").on("hidden.bs.modal", function (e) {
        // Ketika Modal Dialog di Close / tertutup
        $("#formModal input, #formModal select, #formModal textarea").val(""); // Clear inputan menjadi kosong
        category_id = 0;
        $("#err_validation").remove();
        new_category_img = null;
        old_category_img = "";
    });

    $(document).on("click", "#btnDeleteCategory", function (e) {
        e.preventDefault();
        category_id = $(this).val();
        console.log(category_id);
    });

    $(document).on("click", "#yesDelete", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "DELETE",
            url: "/dashboard/categories/" + category_id,
            dataType: "json",
            success: function (res) {
                $("#success_message").addClass("alert alert-success");
                $("#success_message").text(res.message);
                $("#formDelete").modal("hide");
                category_id = 0;
                dTableCategory.ajax.reload();
            },
            error: function (xhr, status, error) {
                category_id = 0;
                $("#success_message").addClass("alert alert-danger");
                $("#success_message").text(res.message);
                dTableCategory.ajax.reload();
            },
        });
    });

    /*$("#inputCategoryImage").on("change", function (event) {
        event.preventDefault();

        var property = $("#inputCategoryImage").prop("files")[0];
        // console.log(property.name);
        var image_name = property.name;
        var image_extension = image_name.split(".").pop().toLowerCase();
        if (
            jQuery.inArray(image_extension, ["gif", "png", "jpg", "jpeg"]) == -1
        ) {
            alert("Invalid image file");
        }
        var image_size = property.size;
        if (image_size > 2000000) {
            alert("Image file size is very big!");
        } else {
            var form_data = new FormData();
            form_data.append("file", property);
        }
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: "/dashboard/categories",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#uploaded_image").html(
                    "<label class='text-success'>Image uploading...</label>"
                );
            },
            success: function (data) {
                $("#uploaded_image").html(data);
            },
        });
    });*/
});
