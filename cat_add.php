<?php include 'inc/head.php'; ?>

<div class="m-5">
    <div class="card">
        <div class="card-header">
            <center>
                <h2 class="card-title">Category CRUD</h2>
            </center>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-2" id="showAddCatModalBtn">Add Category</button>
            <table id="catsTable" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modals -->
            <!-- Add Category Modal -->
            <div class="modal fade" id="addCatModal" tabindex="-1" role="dialog" aria-labelledby="addCatModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCatModalLabel">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addCatForm">
                                <div class="form-group">
                                    <label for="catName">Category Name</label>
                                    <input type="text" class="form-control" id="catName" name="catName" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<!-- Edit Category Modal -->
            <div class="modal fade" id="editCatModal" tabindex="-1" role="dialog" aria-labelledby="editCatModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCatModalLabel">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editCatForm">
                                <input type="hidden" id="editCatId" name="editCatId">
                                <div class="form-group">
                                    <label for="editCatName">Category Name</label>
                                    <input type="text" class="form-control" id="editCatName" name="editCatName" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Category Modal -->
            <div class="modal fade" id="deleteCatModal" tabindex="-1" role="dialog" aria-labelledby="deleteCatModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCatModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete category <span id="deleteCatName"></span>?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="deleteCatId"> <!-- Hidden input field to store catId -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteCatBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'inc/links.php'; ?>
<script src="cat_add_script.js"></script>
<?php include 'inc/foot.php'; ?>
