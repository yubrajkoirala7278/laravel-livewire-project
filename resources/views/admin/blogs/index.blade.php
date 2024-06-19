@extends('admin.layouts.master')
@section('content')
{{-- =====ADD BLOGS======================== --}}
@include('admin.blogs.create')
{{-- =====End ofADD BLOGS================== --}}

{{-- =========DISPLAY BLOGS================= --}}
    <table id="blog-table">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
{{-- =========END OF DISPLAY BLOGS=============== --}}

{{-- ========Edit Blog============================ --}}
@include('admin.blogs.edit')
{{-- ========End of Edit Blog===================== --}}

@endsection

@section('script')
<script>
    $(document).ready(function() {
        // =====setup csrf token======
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // =====Reset form============
        $('#addButton').click(function() {
            $('#ajaxForm')[0].reset();
        });

        // ========ADDING DATA TO DB(POST)=============//
        var createFormData = $('#ajaxForm')[0];
        $('#saveBtn').click(function() {
            
            // setting empty text on error message
            $('#titleError').html('');
            $('#slugError').html('');
            $('#descriptionError').html('');
            $('#imageError').html('');
            // getting form data
            var formData = new FormData(createFormData);
            // console.log(formData);
            $.ajax({
                url: "{{ route('blogs.store')}}", 
                method: 'POST', 
                processData: false, 
                contentType: false, 
                data: formData,

                success: function(response) {
                    // reload the latest row after added
                    table.draw();
                    // hide model if success
                    $('#addBlog').modal('hide');
                    // clear form after successfully submitting
                    $('#ajaxForm')[0].reset();
                    // display success message if form submitted successfully
                    toastify().success(response.success);
                }, error: function(error) {
                    // display error message in toastify
                    // toastify().success(error.responseJSON.error);
                    let errorMessage = error.responseJSON.errors;
                    // displaying error message below input field
                    if (errorMessage.title) {
                        $('#titleError').html(errorMessage.title[0]);
                    }
                    if (errorMessage.slug) {
                        $('#slugError').html(errorMessage.slug[0]);
                    }
                    if (errorMessage.description) {
                        $('#descriptionError').html(errorMessage.description[0]);
                    }
                    if (errorMessage.image) {
                        $('#imageError').html(errorMessage.image[0]);
                    }
                }
            });
        });
        // ======================================================//


        // ===========READ DATA FROM DB(READ)====================//
        var table =  $('#blog-table').DataTable({
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "ordering": false,
            searchDelay:3000,
            "ajax": {
                url: "{{ route('blogs.index') }}",
                type: 'GET',
                dataType: 'JSON'
            },
            "columns": [
                { data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false },
                { data: 'title', name: 'title', },
                { data: 'slug', name: 'slug' },
                { data: 'description', name: 'description' },
                {
                    data: "image",
                    name:"image",
                    "render": function(data, type, full, meta) {
                    return '<img src="{{ asset('storage/images/blogs/') }}/' + data + '" alt="Image" style="height:20px">';
                    }
                },
                {data: 'action',name: 'action',orderable: false,searchable: false},
            ],
            "lengthMenu": [[5, 20, 50, -1], [5, 20, 50, "All"]],
            "pagingType": "simple_numbers"
        });

       
        // ===================================================================//

        // ============Fill Current Data to form while UPDATION================//
        let slug='';
        $('body').on('click', '.editButton', function() {
                // get form slug
                 slug = $(this).data('slug');

                $.ajax({
                    url: '{{ url('admin/blogs', '') }}' + '/' + slug + '/edit',
                    method: 'GET',
                    success: function(response) {
                        // console.log(response);
                        // display model
                        $('#editBlog').modal('show');
                        // fill current data on form
                        $('#updateTitle').val(response.title);
                        $('#updateSlug').val(response.slug);
                        $('#updateDescription').val(response.description);
                        // inserted current id value in form
                        $('#blog_slug').val(response.slug);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });
        // =============================================================//


        // =====UPDATING BLOG TO DB(UPDATE/PUT)===========================//
        var updateFormData = $('#ajaxFormUpdate')[0];
        $('#updateBtn').click(function() {
            // setting empty text on error message
            $('#titleUpdateError').html('');
            $('#slugUpdateError').html('');
            $('#descriptionUpdateError').html('');
            $('#imageUpdateError').html('');
            // getting form data
            var formUpdateData = new FormData(updateFormData);
            // console.log(formData);
            $.ajax({
                url: "{{ route('blogs.update') }}",
                method: 'POST', 
                processData: false, 
                contentType: false, 
                data: formUpdateData,

                success: function(response) {
                    // reload the latest row after added
                    table.draw();
                    //    hide model if success
                    $('#editBlog').modal('hide');

                    // clear form after successfully submitting
                    $('#ajaxFormUpdate')[0].reset();

                    // display success message if form submitted
                    toastify().success(response.success);
                }, error: function(error) {
                    // console.log(error);
                    let errorMessage = error.responseJSON.errors;
                    // console.log(errorMessage);

                    // displaying error message
                    if (errorMessage.title) {
                        $('#titleUpdateError').html(errorMessage.title[0]);

                    }
                    if (errorMessage.slug) {
                        $('#slugUpdateError').html(errorMessage.slug[0]);
                    }
                    if (errorMessage.description) {
                        $('#descriptionUpdateError').html(errorMessage.description[0]);
                    }
                    if (errorMessage.image) {
                        $('#imageUpdateError').html(errorMessage.image[0]);
                    }
                }
            });
        });
        // ======================================================================//

        // =============Call function when MODAL CLOSED for CREATE FORM============//
         $('#addBlog').on('hidden.bs.modal', function() {
            // setting empty text on error message
            $('#titleError').html('');
            $('#slugError').html('');
            $('#descriptionError').html('');
            $('#imageError').html('');
        });

        // ===========Call function when MODAL CLOSED for UPDATE FORM=========//
         $('#editBlog').on('hidden.bs.modal', function() {
            // setting empty text on error message
            $('#titleUpdateError').html('');
            $('#slugUpdateError').html('');
            $('#descriptionUpdateError').html('');
            $('#imageUpdateError').html('');
        });


        // ================DELETE BLOG==============================//
         $('body').on('click', '.delButton', function() {
                let slug = $(this).data('slug');
                if (confirm('Are you sure you want to delete it')) {
                    $.ajax({
                        url: '{{ url('admin/blogs/destroy', '') }}' + '/' + slug,
                        method: 'DELETE',
                        success: function(response) {
                            // refresh the table after delete
                            table.draw();
                            // display the delete success message
                            toastify().success(response.success);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        // =====================================================================//


    });

</script>

<script>
    // Function to generate slug from the given title
    function generateSlug(title) {
        return title
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, "-")
            .replace(/^-+|-+$/g, "");
    }
    const title = document.getElementById("title");
    if (title) {
        title.addEventListener("input", function() {
            var titleValue = this.value;
            // Generate and set the slug based on the title value
            document.getElementById("slug").value = generateSlug(titleValue);
        });
    }
</script>
@endsection