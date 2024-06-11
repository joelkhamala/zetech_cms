@extends('users.finance.app')

@section('content')

<div class="container-fluid mb-4">
    <div class="mx-auto justify-content-center col-md-6 text-center" id="mydiv">
        <div>
            @if(session()->has('message'))
            {{$errclass=''}}
            <span style="display:none">
                @if(str_contains(session('message'), 'no'))
                {{ $errclass='alert-danger'}}
                @else
                {{ $errclass='alert-success'}}
                @endif
            </span>
                <div class="alert {{$errclass}} alert-dismissible fade show mb-2" role="alert"  id="mydiv">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
       <div class="float-left col-md-5">
        <h3>Students Payment Details</h3>
    </div>
    <div class="col-md-5"></div>
    <div class="float-right col-md-2">
       <a href="{{url('viewFinanceDetails')}}" class=" btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> <span class="d-none d-lg-inline">Back</span></a>
    </div>
        <div class="col-md-12 mt-4">
           <div class="card shadow-sm">
            <div class="text-center mt-2"><h4>Student Fee Payment Details</h4></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Admission No.</th>
                            <th scope="col">School Fees Balance</th>
                            <th scope="col">Gown Fees Balance</th>
                            <th scope="col">Total Fees Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <span class="d-none">{{$i=1}}</span>
                        @if($students->count()>0)
                            @foreach($finances as $finance)
                            @foreach($students as $student)
                                @if($finance->email == $student->email)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$student->admissionNumber}}</td>
                                    <td>Kshs. {{number_format($finance->school_fees) }}</td>
                                    <td>Kshs. {{number_format($finance->gown_fees) }}</td>
                                    <td><b>Kshs. {{number_format($finance->gown_fees + $finance->school_fees) }}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-center">
                                    @if(($finance->gown_fees + $finance->school_fees)>0)
                                    <div class="btn btn-warning">Student Has not Cleared Fees</div>
                                    @else
                                    <form method="POST" action="{{route('clearFinRecord', $student->student_id)}}">
                                    @csrf
                                    @method('POST')
                                        <input type="hidden" name="email" value="{{$student->email}}">
                                        <input type="hidden" name="officer_id" value="{{Auth::User()->id}}">
                                        <input type="hidden" name="clearFinance" value="yes">
                                        <button type="submit" name="clearFinance" class="btn btn-success "><i class="fas fa-check"></i> &nbsp<span class="">Clear Student</span></button>
                                    </form>
                                    @endif
                                    </td>
                                </tr>
                                <span style="display:none">
                                    {{$i++}}
                                </span>
                                @endif
                            @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11"><div class="alert alert-danger">No Student Record Found</div></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="container">
    <div class="row">
        <div class="card card-primary filterable">
            <div class="card-body">
            <div class="card-heading">
                <h3 class="card-title">Users</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table table-stripped table-light">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Last Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Username" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<style>
    .filterable {
    margin-top: 15px;
}
.filterable .card-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}

</style> -->

<script>
    $(document).on('click', '.card-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('card-collapsed')) {
		$this.parents('.card').find('.card-body').slideUp();
		$this.addClass('card-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.card').find('.card-body').slideDown();
		$this.removeClass('card-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})

// Filterable table
/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
// $(document).ready(function(){
//     $('.filterable .btn-filter').click(function(){
//         var $card = $(this).parents('.filterable'),
//         $filters = $card.find('.filters input'),
//         $tbody = $card.find('.table tbody');
//         if ($filters.prop('disabled') == true) {
//             $filters.prop('disabled', false);
//             $filters.first().focus();
//         } else {
//             $filters.val('').prop('disabled', true);
//             $tbody.find('.no-result').remove();
//             $tbody.find('tr').show();
//         }
//     });

//     $('.filterable .filters input').keyup(function(e){
//         /* Ignore tab key */
//         var code = e.keyCode || e.which;
//         if (code == '9') return;
//         /* Useful DOM data and selectors */
//         var $input = $(this),
//         inputContent = $input.val().toLowerCase(),
//         $card = $input.parents('.filterable'),
//         column = $card.find('.filters th').index($input.parents('th')),
//         $table = $card.find('.table'),
//         $rows = $table.find('tbody tr');
//         /* Dirtiest filter function ever ;) */
//         var $filteredRows = $rows.filter(function(){
//             var value = $(this).find('td').eq(column).text().toLowerCase();
//             return value.indexOf(inputContent) === -1;
//         });
//         /* Clean previous no-result if exist */
//         $table.find('tbody .no-result').remove();
//         /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
//         $rows.show();
//         $filteredRows.hide();
//         /* Prepend no-result row if all rows are filtered */
//         if ($filteredRows.length === $rows.length) {
//             $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
//         }
//     });
// });
</script>


@endsection