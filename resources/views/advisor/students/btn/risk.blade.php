<!-- Button to Open the Modal -->
@if($gpa == 0)
<button type="button" class="btn btn-dark btn-sm bg-gray">
    New student
</button>
@elseif($gpa <= 3.75)
<button type="button" class="btn btn-danger btn-sm">
    High risk
</button>
@elseif($gpa <= 4.5)
    <button type="button" class="btn btn-warning btn-sm">
        Mid risk
    </button>
@else
    <button type="button" class="btn btn-success btn-sm">
        No risk
    </button>
@endif
