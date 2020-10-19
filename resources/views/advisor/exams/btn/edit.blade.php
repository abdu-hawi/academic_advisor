<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#edit_exam_{!! $id !!}">
    <i class="fa fa-edit"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="edit_exam_{!! $id !!}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body text-left">
                {!! Form::open(['url'=>advisorURL('exams/'.$id),'method'=>'put']) !!}


                <div><b>Event Name: </b></div>
                <div class="mb-0">
{{--                    {!! Form::select('course_id',App\Model\Course::select(DB::raw('CONCAT(code, " - ", name) AS full_name, id'))--}}
{{--                            ->where('code','!=','699')->pluck('full_name', 'id'),$course['id'],--}}
{{--                            ['class'=>"form-control",'placeholder'=>"Select course", 'required']) !!}--}}
                    <textarea class="form-control @error('name') is-invalid @enderror"
                              name="name" required>{!! $name !!}</textarea>
                </div>

                <div><b>Date: </b></div>
                <div class="mb-0">
                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                           name="date" value="{!! $date !!}" required>
                </div>

{{--                <div><b>Time: </b></div>--}}
{{--                <div class="mb-3">--}}
{{--                    <input type="time" class="form-control @error('time') is-invalid @enderror"--}}
{{--                           name="time" value="{!! $time !!}" required>--}}
{{--                </div>--}}

                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-dark btn-block mt-2">Update</button>
                    </div>
                    <!-- /.col -->
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

