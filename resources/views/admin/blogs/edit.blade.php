<!-- ===========Modal to Update Blog=============== -->
<div class="modal fade" id="editBlog" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editBlogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form id="ajaxFormUpdate">
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    {{-- model title --}}
                    <h1 class="modal-title fs-5" id="model-title">Edit Blog</h1>
                    {{-- close button --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- get the current slug on edit --}}
                    <input type="hidden" name="blog_slug" id="blog_slug">
                    {{-- title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="updateTitle" name="title">
                        <span id="titleUpdateError" class="text-danger"></span>
                    </div>
                    {{-- slug --}}
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="updateSlug" name="slug">
                        <span id="slugUpdateError" class="text-danger"></span>
                    </div>
                    {{-- description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="updateDescription" name="description"></textarea>
                        <span id="descriptionUpdateError" class="text-danger"></span>
                    </div>
                    {{-- image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span id="imageUpdateError" class="text-danger"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- save btn --}}
                    <button type="button" class="btn btn-primary" id="updateBtn">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--======== End of Modal to Create Blog===============  --}}