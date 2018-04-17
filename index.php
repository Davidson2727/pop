<?php
	include_once 'header.php';
?>
<script src = 'https://code.jquery.com/jquery-1.12.4.js'></script>
<script src = 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script src = 'https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js'></script>
<script src = 'https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js'></script>
<script src = 'JS/dataTables.editor.min.js'></script>
<link rel = "stylesheet" href = "https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel = "stylesheet" href = "https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
<link rel = "stylesheet" href = "https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
<link rel = "stylesheet" href = "https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
<section class="main-container">
	<div class="main-wrapper">
		<h2>Home</h2>
		<?php
			if (isset($_SESSION['u_id'])) {
				$sql = "SELECT * FROM employee;";
				$result = mysqli_query($conn,$sql);
				$resultCheck = mysqli_num_rows($result);
				if($resultCheck > 0){
					echo
					"<table id='example' class='display' cellspacing='0' width='100%'>
					        <thead>
					            <tr>
					                <th></th>
					                <th>Name</th>
					                <th>Position</th>
					                <th>Office</th>
					                <th>Start date</th>
					                <th>Salary</th>
					            </tr>
					        </thead>";
				}
			}
		?>
	</div>
</section>

<script>

console.log("In the script open");


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {

	console.log("error1");
    editor = new $.fn.dataTable.Editor( {
        ajax: "infograb.php",
        table: "#example",
        fields: [ {
                label: "Social#:",
                name: "ssn"},
								{
                label: "DOB:",
                name: "dob"},
								{label: "First Name:",
                name: "fn"},
								{
                label: "Middle Initial:",
                name: "mi"},
								{
                label: "Last Name:",
                name: "ln"
            		}
        ]
    } );
		console.log("error4");

    $('#example').on( 'click', 'tbody td', function (e) {
        var index = $(this).index();
				console.log("error3");
        if ( index === 1 ) {
            editor.bubble( this, ['first_name', 'last_name'], {
                title: 'Edit name:'
            } );
        }
        else if ( index === 2 ) {
            editor.bubble( this, {
                buttons: false
            } );
        }
        else if ( index === 3 ) {
            editor.bubble( this );
        }
        else if ( index === 4 ) {
            editor.bubble( this, {
                message: 'Date must be given in the format `yyyy-mm-dd`'
            } );
        }
        else if ( index === 5 ) {
            editor.bubble( this, {
                title: 'Edit salary',
                message: 'Enter an unformatted number in dollars ($)'
            } );
        }
    } );

    $('#example').DataTable( {
        dom: "Bfrtip",
        ajax: "infograb.php",
        columns: [
            {
                data: null,
                defaultContent: '',
                className: 'select-checkbox',
                orderable: false
            },
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                return data.first_name+' '+data.last_name;
            } },
            { data: "position" },
            { data: "office" },
            { data: "start_date" },
            { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
        ],
        order: [ 1, 'asc' ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );
} );





console.log("End script");


</script>

<?php
	include_once 'footer.php';
?>
