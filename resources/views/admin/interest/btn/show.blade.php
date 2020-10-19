<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#cities_delete_modal_{!! $id !!}">
    <i class="fa fa-eye"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="cities_delete_modal_{!! $id !!}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-black">
                <h3>Interested field: {!! $name !!}</h3>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-left">
                <div class="m-1">
                    <b>Code: </b>{!! $course_id['code'] !!}
                </div>
                <div class="m-1">
                    <b>Course Name: </b>{!! $course_id['name'] !!}
                </div>
                <div class="m-1">
                    <b>Credit: </b>{!! $course_id['credit'] !!} Hour/s
                </div>
                <div class="m-1">
                    <b>Prerequisite: </b>{!! $course_id['prerequisite'] !!}
                </div>
                <div class="m-1">
                    <b>Description: </b>
                    <textarea class="form-control" readonly>{!! $course_id['description'] !!}</textarea>
                </div>
            </div>

        </div>
    </div>
</div>

