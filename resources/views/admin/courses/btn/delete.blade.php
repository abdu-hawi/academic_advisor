<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#link_delete_modal_{!! $id !!}">
    <i class="fa fa-trash"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="link_delete_modal_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete Link</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


        <!-- Modal body -->
            <div class="modal-body">
                <h5>Are sure you want delete Course</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-danger delete-link-{!! $id !!}" data-dismiss="modal">Agree</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => aurl('courses/'.$id),'id'=>'form_delete_link_'.$id,'method'=>'delete']) !!}
{!! Form::close() !!}

<script>
    $(document).on('click','.delete-link-{!! $id !!}',function(){
        $('#form_delete_link_{!! $id !!}').submit();
    });
</script>
