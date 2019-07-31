$(document).ready(function () {
    const $tableID = $('#dtHorizontalVerticalExample');

    fetch_data();
	
	function fetch_data()
	{
		// setTimeout(function (){
			$tableID.DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: "no-sort",
                    bSort: false,
                    order: []
                }],
                orderable: false,
                scrollX: true,
                scrollY: 400,
                // ajax : {
				// 	url:"inventory.php",
				// 	type:"POST"
				// },
            });
            $('.dataTables_length').addClass('bs-select');

			// dataTable = $('#table-tracker').DataTable({
			// 	"paging":   false,
			// 	"ordering": true,
			// 	columnDefs: [{
			// 		orderable: false,
			// 		targets: "no-sort"
			// 	}],
			// 	"info":     false,
			// 	"searching": true,
			// 	"processing" : false,
			// 	"serverSide" : true,
			// 	"order" : [],
			// 	"ajax" : {
			// 		url:"fetchtracker.php",
			// 		type:"POST"
			// 	},
			// 	"drawCallback": function( settings ) {
			// 		var rows = dataTable.rows().count() - 1;
			// 		document.getElementById("results").innerHTML = "Results: " + rows + " row/s";
			// 	}
			// });
		// }, 250);
		
		// $('#selectall').prop('indeterminate', false);
		// $('#selectall').prop('checked', false);
		// $(this).closest('tr').find('.checkbox').prop('checked', false);
		// $('#deleteall').hide( "slow", function(){});
			
		}

    $tableID.on('click', '.delete', function () {
        $(this).parents('tr').detach();
        $tableID.DataTable().destroy();
        var id = $(this).attr("id");
        if(confirm("Are you sure you want to remove this item?"))
        {
            // $(this).closest('tr').find('td').css("background-color", "#ccc");
            // $(this).closest('tr').find('td').fadeOut('slow');
            // $.ajax({
            //     url:"deletetracker.php",
            //     method:"POST",
            //     data:{id:id},
            //     success:function(data){
            //         $('#table-tracker').DataTable().destroy();
                    fetch_data();
            //     }
            // });
        }      
    });
});