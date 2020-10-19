



<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#link_delete_modal_{!! $i->id !!}">
    <i class="fa fa-trash"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="link_delete_modal_{!! $i->id !!}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete Interest</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


        <!-- Modal body -->
            <div class="modal-body">
                <h5>Are you sure you want delete this interest?</h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Close</button>
                <button type="button"
                        class="btn btn-outline-danger"
                        data-dismiss="modal" onclick="deleteInter({!! $i->id !!})">Agree</button>
            </div>

        </div>
    </div>
</div>

{!! Form::open(['url' => aurl('interests/'.$i->id),'id'=>'form_course_'.$i->id,'method'=>'delete']) !!}
{!! Form::close() !!}

<script>
    function deleteInter(id) {
        $('#form_course_'+id).submit();
    }

    {{--$(document).on('click','.delete-interest-{!! $i->id !!}',function(){--}}
    {{--    alert('d');--}}
    {{--    $('#form_course_{!! $i->id !!}').submit();--}}
    {{--});--}}

</script>
