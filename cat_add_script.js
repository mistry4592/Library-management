$(document).ready(function() {
    var dataTable = $('#catsTable').DataTable({
        "ajax": "cat_add_curd.php",
        "columns": [
            { "data": "id" },
            { "data": "cat_name" },
            {
                "data": null,
                "render": function(data, type, row) {
                    return '<button type="button" class="btn btn-primary editCatBtn" data-id="' + row.id + '" data-name="' + row.cat_name + '">Edit</button>' +
                        '<button type="button" class="btn btn-danger deleteCatBtn" data-id="' + row.id + '" data-name="' + row.cat_name + '">Delete</button>';
                }
            }
        ]
    });

    // Show Add Category Modal
    $('#showAddCatModalBtn').click(function() {
        $('#addCatForm')[0].reset();
        $('#addCatModal').modal('show');
    });

    // Edit Category
    $('#catsTable').on('click', '.editCatBtn', function() {
        var catId = $(this).data('id');
        var catName = $(this).data('name');
        $('#editCatId').val(catId);
        $('#editCatName').val(catName);
        $('#editCatModal').modal('show');
    });

    // Delete Category
    $('#catsTable').on('click', '.deleteCatBtn', function() {
        var catId = $(this).data('id');
        var catName = $(this).data('name');
        $('#deleteCatId').val(catId);
        $('#deleteCatName').text(catName);
        $('#deleteCatModal').modal('show');
    });

    // Submit Add Category Form
    $('#addCatForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'cat_add_curd.php?action=add',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addCatModal').modal('hide');
                dataTable.ajax.reload();
            }
        });
    });

    // Submit Edit Category Form
    $('#editCatForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'cat_add_curd.php?action=edit',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editCatModal').modal('hide');
                dataTable.ajax.reload();
            }
        });
    });

    // Confirm Delete Category
    $('#confirmDeleteCatBtn').click(function() {
        var catId = $('#deleteCatId').val();
        if (catId) { // Check if catId is provided
            $.ajax({
                url: 'cat_add_curd.php?action=delete',
                type: 'POST',
                data: { catId: catId }, // Include catId in the data object
                success: function(response) {
                    $('#deleteCatModal').modal('hide');
                    alert(response); // Display the response message
                    dataTable.ajax.reload();
                }
            });
        } else {
            alert("Error: catId parameter not provided");
        }
    });
});