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
					                <th>ssn</th>
					                <th>dob</th>
					                <th>first</th>
													<th>MI</th>
													<th>last</th>
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


    $('#example').on( 'click', 'tbody td', function (e) {
        var index = $(this).index();

        if ( index === 1 ) {
            editor.bubble( this, ['fn', 'mi', 'ln'], {
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

    } );

		var testData = [{
                  "ssn": "98727748",
                  "dob": "2016-02-05",
                  "fn": "jake",
									"mi": "a",
									"ln": "butler"
                }];

    $('#example').DataTable( {
        dom: "Bfrtip",
        ajax:{
        			url: 'infograb.php',
        			type: 'POST',
        			data: {
        			json: JSON.stringify({ "data": testData })
        			},
        			dataSrc: 'data'
						},
        columns: [
						{//sets the checkbox
							data: null,
							defaultContent: '',
							className: 'select-checkbox',
							orderable: false
						 },
						{ data: "dob" },
            { data: "ssn" },
						{ data: "fn" },
						{ data: "mi" },
						{ data: "ln" },


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
