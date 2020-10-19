<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#show_student_{!! $id !!}">
    <i class="fa fa-eye"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="show_student_{!! $id !!}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-green"><h5><b>Advisor name:</b> {!! $name !!}</h5>
{{--                <a href="{!! aurl('plans/'.$id.'/edit/'.$name) !!}">--}}
{{--                    <input type="button" class="btn btn-outline-light btn-sm" value="Edit">--}}
{{--                </a>--}}
            </div>

            <!-- Modal body -->
            <div class="modal-body text-left">

                <table class="table">
                    <tbody>
                    <tr>
                        <td class="col-2"><b>Name: </b></td>
                        <td>{!! $name !!}</td>
                    </tr>
                    <tr>
                        <td class="col-2"><b>Email: </b></td>
                        <td>{!! $email !!}</td>
                    </tr>
                    <tr>
                        <td class="col-2"><b>Phone: </b></td>
                        <td>{!! $phone !!}</td>
                    </tr>
                    <tr>
                        <td class="col-2"><b>Room No.: </b></td>
                        <td>{!! $room_no !!}</td>
                    </tr>
                    <tr>
                        <td class="col-2"><b>Office open from: </b></td>
                        <td>{!! $office_from !!}</td>
                    </tr>
                    <tr>
                        <td class="col-2"><b>Office open to: </b></td>
                        <td>{!! $office_to !!}</td>
                    </tr>
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</div>

