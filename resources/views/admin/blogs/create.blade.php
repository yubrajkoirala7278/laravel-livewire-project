{{-- ===========CREATE Blog (Popup button)============= --}}
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlog" id="addButton">
    Add Blog
</button>
{{-- ===========End of CREATE Blog (Popup button)======== --}}

<!-- ===========Modal to Create Blog=============== -->
<div class="modal fade" id="addBlog" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addBlogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form id="ajaxForm">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- model title --}}
                    <h1 class="modal-title fs-5" id="model-title">Add Blog</h1>
                    {{-- close button --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    {{-- slug --}}
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                        <span id="slugError" class="text-danger"></span>
                    </div>
                    {{-- description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <span id="descriptionError" class="text-danger"></span>
                    </div>
                    {{-- image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span id="imageError" class="text-danger"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- save btn --}}
                    <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--======== End of Modal to Create Blog===============  --}}