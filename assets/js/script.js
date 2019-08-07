// $(document).ready(function () {
//     const $tableID = $('#dtHorizontalVerticalExample');

//     fetch_data();
	
// 	function fetch_data()
// 	{
// 		// setTimeout(function (){
// 			$tableID.DataTable({
//                 columnDefs: [{
//                     orderable: false,
//                     targets: "no-sort",
//                     bSort: false,
//                     order: []
//                 }],
//                 orderable: false,
//                 scrollX: true,
//                 scrollY: 400,
//                 // ajax : {
// 				// 	url:"inventory.php",
// 				// 	type:"POST"
// 				// },
//             });
//             $('.dataTables_length').addClass('bs-select');
			
// 		}

//     $tableID.on('click', '.delete', function () {
//         // $(this).parents('tr').detach();
//         // $tableID.DataTable().destroy();
//         var id = $(this).attr("id");
//         if(confirm("Are you sure you want to remove this item?"))
//         {
// 			$(this).parents('tr').detach();
//             // $(this).closest('tr').find('td').css("background-color", "#ccc");
//             // $(this).closest('tr').find('td').fadeOut('slow');
//             // $.ajax({
//             //     url:"deletetracker.php",
//             //     method:"POST",
//             //     data:{id:id},
//             //     success:function(data){
//             //         $('#table-tracker').DataTable().destroy();
//                     // fetch_data();
//             //     }
//             // });
//         }      
// 	});
	
// 	$('.hide').on('click', function(){
// 		$('.admin-nav').toggleClass('hide-nav');
// 		$('.dtHorizontalVerticalExampleWrapper').toggleClass('max-view');
// 		$('.hamburger').toggleClass('show');
// 	});

// 	$('.hamburger').on('click', function(){
// 		$('.admin-nav').toggleClass('hide-nav');
// 		$('.dtHorizontalVerticalExampleWrapper').toggleClass('max-view');
// 		$('.hamburger').toggleClass('show');
//     });
    
//     $('.add').on('click', function(){
//         var name = $('#data1').text();
//         var brand = $('#data2').text();
//         var forGenders = $('#data3').text();
//         var category = $('#data4').text();
//         var price = $('#data5').text();
//         var salePercentage = $('#data6').text();
//         var netPrice = $('#data7').text();
//         var stock = $('#data8').text();
//         var color = $('#data9').text();
//         var madeIn = $('#data10').text();
//         var materials = $('#data11').text();
//         var sizes = $('#data12').text();
//         var date = $('#data13').text();
//         var image = $('#data14').text();
//         var slug = $('#data1').text();

//         if(name != '' && brand != '' && forGenders != '' && category != '' && price != '' && salePercentage != '' && netPrice != '' && stock != '' && color != '' && madeIn != '' && materials != '' && sizes != '' && date != '' && image != ''){
//             $.ajax({
//                 url:"<?php echo base_url(); ?>",
//                 method:"POST",
//                 data:{
//                     name:name, brand:brand, forGenders:forGenders, category:category, price:price, salePercentage:salePercentage, netPrice:netPrice, stock:stock, color:color, madeIn:madeIn, materials:materials, sizes:sizes, date:date, image:image, slug:slug
//                 },
//                 success:function(data){
//                     $('#data1').text("");
//                     $('#data2').text("");
//                     $('#data3').text("");
//                     $('#data4').text("");
//                     $('#data5').text("");
//                     $('#data6').text("");
//                     $('#data7').text("");
//                     $('#data8').text("");
//                     $('#data9').text("");
//                     $('#data10').text("");
//                     $('#data11').text("");
//                     $('#data12').text("");
//                     $('#data13').text("");
//                     $('#data14').text("");
//                     $('#table-tracker').DataTable().destroy();
//                     fetch_data();
//                 }
//             });
//         }
//     });
// });