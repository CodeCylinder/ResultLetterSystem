$(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});


    function openPopup() {

            window.open("/editnew.php", "WIDTH=1080,HEIGHT=790,scrollbars=no, menubar=no,resizable=yes,directories=no,location=no");  
               
           }

$(document).ready(function(){
	$('#edit').load('edit/editnew.php');
	$('table#ResultTable tr td').click(function(){
		var page =$(this).attr('href');
		$('#edit').load('content/'+page+'.php');
		return false;
	});
});
		