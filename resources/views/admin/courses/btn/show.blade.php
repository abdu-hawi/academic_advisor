<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#cities_delete_modal_{!! $id !!}">
    <i class="fa fa-eye"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="cities_delete_modal_{!! $id !!}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <!-- Modal body -->
            <div class="modal-body text-left">
                <div class="m-1">
                    <b>Code: </b>{!! $code !!}
                </div>
                <div class="m-1">
                    <b>Name: </b>{!! $name !!}
                </div>
                <div class="m-1">
                    <b>Credit: </b>{!! $credit !!} Hour/s
                </div>
                <div class="m-1">
                    <b>Prerequisite: </b>{!! $prerequisite !!}
                </div>
                <div class="m-1">
                    <b>Description: </b>
                    <textarea class="form-control" readonly>{!! $description !!}</textarea>
                </div>
            </div>

        </div>
    </div>
</div>

