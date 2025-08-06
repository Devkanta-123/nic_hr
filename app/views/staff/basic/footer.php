<footer class="main-footer">
    <strong>Copyright &copy; 2025 <a href="#" target="_blank">
          NIC HR</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- DataTables -->
<link rel="stylesheet" href="assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" />

<!-- DataTables -->
<script src="assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>

<script>
    $('.select2').select2();

    function onError(rc) {
        console.log(rc);
    }

    $(function() {
        // debugger;
        let sess = JSON.parse(sessionStorage.getItem("session"));
        if (sess!=null && sess.length>0)
            loadSelect("#session",sess,false);

        var url = window.location;
        var title="";
        // for single sidebar menu
        title = $('ul.nav-sidebar a').filter(function () {
            document.title = this.innerText;
            return this.href == url;
        }).addClass('active')
            .text();


        if (title!=undefined && title!=""){
            document.title = (title.trim()).replace(/ +(?= )/g,'');
        }

        // for sidebar menu and treeview
        title = $('ul.nav-treeview a').filter(function () {

            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview")
            .css({'display': 'block'})
            .addClass('menu-open').prev('a')
            .addClass('active')
            .text();
            // .css("background-color", "rgb(94 114 228 / 38%)");


        if (title!=undefined && title!=""){
            document.title = (title.trim()).replace(/ +(?= )/g,'');
        }
    });

    $("#session").change(function (){
        let obj = {};
        obj.Module = "Settings";
        obj.Page_key = "changeSession";
        let json = {};
        json.SessionID=$("#session option:selected").val();
        obj.JSON = json;
        TransportCall(obj,onSucessMaster);
    });

    function onSucessMaster(rc) {
        debugger;
        if (rc.return_code) {
            switch (rc.Page_key) {
                case "changeSession":
                    if(rc.return_data){
                        notify('success',"Session Changed");
                    }else {
                        notify('error',"Could not change session");
                    }
                    break;
                default:
                    alert(rc.Page_key);
            }
        } else {
            alert("Error");
        }
        // alert(JSON.stringify(args));
    }

// for nav-link
//     $("ul li a.nav-link").each(function() {
//         if (this.href == document.URL){
//             if ($(this).parent().hasClass("has-treeview") || $(this).parent().parent().parent().hasClass("has-treeview")){
//                 $(this).parent().parent().siblings().addClass('active');
//                 // $(this).addClass('active');
//                 $(this).css("background-color", "rgb(94 114 228 / 38%)");
//                 $(this).parent().parent().parent().addClass('menu-open');
//             }else{
//                 $(this).addClass('active');
//             }
//         }
//     });




</script>
</body>

</html>