<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Task</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css') }}" type="text/css">
</head>

<body>
<!-- Sidenav -->

<!-- Main content -->
<div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>

            </div>
            <div class="col-lg-6 col-5 text-right">
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <form id="fromsubmit" method="post" action="{{ route('save') }}">
        @csrf
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Student Details</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="appendData">
                        <thead class="thead-light">
                        <tr style="text-align: center">
                            <th scope="col" class="sort">S.No</th>
                            <th scope="col" class="sort">Student Name</th>
                            <th scope="col" class="sort">Mark 1</th>
                            <th scope="col" class="sort">Mark 2</th>
                            <th scope="col" class="sort">Mark 3</th>
                            <th scope="col" class="sort">Total</th>
                            <th scope="col" class="sort">Rank</th>
                            <th scope="col" class="sort">Action</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <tr id="item_details1">
                            <td> </td>
                            <td>
                                <input class="form-control" type="text" name="student_name[]" id="student_name1">

                            </td>
                            <td>
                                <input class="form-control" type="text" name="mark_one[]" id="mark_one1">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="mark_two[]" id="mark_two1">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="mark_three[]" id="mark_three1" onkeyup="totalcalc(1)" onchange="totalcalc(1)">
                            </td>
                            <td>
                                <input class="form-control total" type="text" name="total[]" id="total1">
                            </td>
                            <td>
                                <input class="form-control Rank" type="text" name="rank[]" id="rank1">
                            </td>
                            <td>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->


            </div>
            <div class="row justify-content-end">
                <button style="margin-right: 10px" onclick="addItem();addSerialNumber();">ADD</button>
                <button>SAVE</button>
            </div>
        </div>

    </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<!-- Argon JS -->
<script src="{{ asset('assets/js/argon.js') }}"></script>
</body>

</html>
<script>

    var addSerialNumber = function () {
        $('table tr').each(function(index) {
            $(this).find('td:nth-child(1)').html(index+1);
        });
    };

    addSerialNumber();

    var sl = 2;

    function addItem() {

        $("#appendData tbody").append('<tr id="item_details' + sl + '">\n' +
            '                            <td >\n' +
            '                              \n' +
            '                            </td>\n' +
            '                            <td >\n' +
            '                             <input class="form-control" type="text" name="student_name[]" id="student_name' + sl + '">\n' +
            '                            </td>\n' +
            '                            <td >\n' +
            '                             <input class="form-control" type="text" name="mark_one[]" id="mark_one' + sl + '">\n' +
            '                            </td>\n' +
            '                            <td >\n' +
            '                             <input class="form-control" type="text" name="mark_two[]" id="mark_two' + sl + '">\n' +
            '                            </td>\n' +
            '                            <td >\n' +
            '                             <input class="form-control" type="text" name="mark_three[]" id="mark_three' + sl + '" onkeyup="totalcalc(' + sl + ')" onchange="totalcalc(' + sl + ')">\n' +
            '                            </td>\n' +
            '                            <td >\n' +
            '                             <input class="form-control total" type="text"  name="total[]" id="total' + sl + '">\n' +
            '                            </td>\n' +
            '                            <td >\n' +
            '                             <input class="form-control Rank" type="text" name="rank[]" id="rank' + sl + '">\n' +
            '                            </td>\n' +
            '                            <td> <a href="javascript:void(0)" onclick="removeItem(' + sl + ')" class="badge badge-primary" title="Remove">Delete</a></td>\n' +
            '                        </tr>');

        sl++;

    }


    function removeItem(id){
        $("tr").remove("#item_details"+id);
    }

    $(document).ready(function () {

        $("#fromsubmit").submit(function (e) {

            $('.error-message').remove();

            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (data) {

                    },
                error: function (err) {


                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        // display errors on each form field
                        toastr.warning('Please fill all the fields', 'Warning', {"progressBar": true})
                    }
                }
            });
            e.preventDefault(); // avoid to execute the actual submit of the form.
        });
    });

    function totalcalc(id) {
        var mark1 = $('#mark_one' + id).val();
        var mark2 = $('#mark_two' + id).val();
        var mark3 = $('#mark_three' + id).val();
        var total= Number(mark1) + Number(mark2) + Number(mark3);
        $('.error-message').remove();
            $('#total' + id).val(total);
    }
    
</script>
