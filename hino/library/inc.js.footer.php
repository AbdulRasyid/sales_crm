
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!--script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script-->
<script src="../assets/global/plugins/jquery-2.1.3.min.js" type="text/javascript"></script>

<!-- Impor . Load Divisi -->
<script type="text/javascript">
function ambil_divisi(val)
{
   $.ajax({
     type: 'post',
     url: "modul/impor/get_select_divisi.php",
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("sales").innerHTML=response; 
     }
   });
}
</script>

<!-- Prospek . Tgl DO -->
<script>
    $(document).ready(function(){
        $('#tgl_do').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>

<!-- Prospek . Tgl PO -->
<script>
    $(document).ready(function(){
        $('#tgl_po').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>

<!-- Prospek . Tgl Estimasi -->
<script>
    $(document).ready(function(){
        $('#tgl_estimasi').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>

<!-- Prospek . Tgl SPK -->
<script>
    $(document).ready(function(){
        $('#tgl_spk').Zebra_DatePicker({
            show_icon : false,
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],

        });
    });
</script>

<!-- Prospek . Load Input Analisa Lost -->
<script type="text/javascript">
function ambil_analisa(val)
{
   $.ajax({
     type: 'post',
     url: "modul/prospek/get_select_analisa.php",
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("analisa_lost").innerHTML=response; 
     }
   });
}
</script>


<!-- Prospek . Load Input Cabang Leasing -->
<script type="text/javascript">
function ambil_cabang(val)
{
   $.ajax({
     type: 'post',
     url: "modul/prospek/get_select_cabang.php",
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("id_cabang").innerHTML=response; 
     }
   });
}
</script>

<!-- Prospek . Load Edit Status Prospek -->
<script type="text/javascript">
$(document).ready(function()
{
$(".status_edit").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/prospek/get_select_status_edit.php",
data: dataString,
cache: false,
success: function(html)
{
$(".prospek_edit").html(html);
} 
});

});
});
</script>

<!-- Prospek . Load Status Prospek -->
<script type="text/javascript">
$(document).ready(function()
{
$(".status").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/prospek/get_select_status.php",
data: dataString,
cache: false,
success: function(html)
{
$(".prospek").html(html);
} 
});

});
});
</script>

<!-- Prospek . Load Metode Pembayaran Kredit -->
<script type="text/javascript">
$(document).ready(function()
{
$(".pembayaran").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/prospek/get_select_kredit.php",
data: dataString,
cache: false,
success: function(html)
{
$(".kredit").html(html);
} 
});

});
});
</script>


<!-- Prospek . Load Warna Kendaraan -->
<script type="text/javascript">
$(document).ready(function()
{
$(".model").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/prospek/get_select_warna.php",
data: dataString,
cache: false,
success: function(html)
{
$(".warna").html(html);
} 
});

});
});
</script>

<!-- Prospek . Load Merk Kendaraan -->
<script type="text/javascript">
$(document).ready(function()
{
$(".merk").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/prospek/get_select_model.php",
data: dataString,
cache: false,
success: function(html)
{
$(".model").html(html);
} 
});

});
});
</script>

<!-- Aktivitas . Tgl Aktivitas Ass -->
<script>
    $(document).ready(function(){
        $('#aktivitas_ass').Zebra_DatePicker({
            show_icon : false,
            default_position: 'below',
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            direction: [false, 7]

        });
    });
</script>

<!-- Aktivitas . Tgl Aktivitas Unit -->
<script>
    $(document).ready(function(){
        $('#aktivitas_unit').Zebra_DatePicker({
            
            show_icon : false,
            default_position: 'below',
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            direction: [false, 2]

        });
    });
</script>

<!-- Aktivitas . Tgl Kunjungan Berikut -->
<script>
    $(document).ready(function(){
        $('#knjgn_berikut').Zebra_DatePicker({
            show_icon : false,
            default_position: 'below',
            format: 'Y-m-d',
            months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
            days : ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            days_abbr :  ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
            direction: 1

        });
    });
</script>

<!-- Aktivitas . Load Input Surveyor Leasing -->
<script type="text/javascript">
$(document).ready(function()
{
$(".cabang").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/aktivitas/get_select_surveyor.php",
data: dataString,
cache: false,
success: function(html)
{
$(".surveyor").html(html);
} 
});

});
});
</script>

<!-- Aktivitas . Load Input Cabang Leasing -->
<script type="text/javascript">
$(document).ready(function()
{
$(".lembaga").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/aktivitas/get_select_cabang.php",
data: dataString,
cache: false,
success: function(html)
{
$(".cabang").html(html);
} 
});

});
});
</script>

<!-- Aktivitas . Load Input Perusahaan Leasing -->
<script type="text/javascript">
$(document).ready(function()
{
$(".aktivitas").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/aktivitas/get_select_lembaga.php",
data: dataString,
cache: false,
success: function(html)
{
$(".lembaga").html(html);
} 
});

});
});
</script>

<!-- Load Filter Salesman -->
<script type="text/javascript">
$(document).ready(function()
{
$(".supervisor").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/customer/get_select.php",
data: dataString,
cache: false,
success: function(html)
{
$(".salesman").html(html);
} 
});

});
});
</script>

<!-- Load Sub Segmen -->
<script type="text/javascript">
$(document).ready(function()
{
$(".main_segmen").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/customer/get_select.php?act=sub_segmen",
data: dataString,
cache: false,
success: function(html)
{
$(".sub_segmen").html(html);
} 
});

});
});
</script>

<!-- Load Kota -->
<script type="text/javascript">
$(document).ready(function()
{
$(".provinsi").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/customer/get_select.php?act=kota",
data: dataString,
cache: false,
success: function(html)
{
$(".kota").html(html);
} 
});

});
});
</script>

<!-- Load Kecamatan -->
<script type="text/javascript">
$(document).ready(function()
{
$(".kota").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/customer/get_select.php?act=kecamatan",
data: dataString,
cache: false,
success: function(html)
{
$(".kecamatan").html(html);
} 
});

});
});
</script>

<!-- Load Kelurahan -->
<script type="text/javascript">
$(document).ready(function()
{
$(".kecamatan").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "modul/customer/get_select.php?act=kelurahan",
data: dataString,
cache: false,
success: function(html)
{
$(".kelurahan").html(html);
} 
});

});
});
</script>


<?php if ($_SESSION['username'] == 'gede.artika') { ?> 

<script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'aktivitas-tim',
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Aktivitas Harian Tim Anda',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Selama 1 Minggu Terakhir',
                        x: -20
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Tanggal Aktivitas'
                        }
                    },
                    yAxis: {
                        min: 0,
                        max: 10,
                        tickInterval: 2,
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: ' Customers'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        floating: 'true',
                        verticalAlign: 'top',
                        borderWidth: 0,
                        y:50
                    },
                    series: []
                };
                $.getJSON("modul/dashboard/data-aktivitas-tim-gede.php", function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    options.series[1] = json[2];
                    options.series[2] = json[3];
                    options.series[3] = json[4];
                    var chart = new Highcharts.Chart(options);
                });
            });
</script>

<script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'prospek-tim',
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Penjualan Anda Tim Anda',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Selama Tahun ini',
                        x: -20
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Bulan Penjualan'
                        }
                    },
                    yAxis: {
                        min: 1,
                        max: 15,
                        tickInterval: 3,
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: ' Unit'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        floating: 'true',
                        verticalAlign: 'top',
                        borderWidth: 0,
                        y:50
                    },
                    series: []
                };
                $.getJSON("modul/dashboard/data-prospek-tim-gede.php", function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    options.series[1] = json[2];
                    options.series[2] = json[3];
                    options.series[3] = json[4];
                    var chart = new Highcharts.Chart(options);
                });
            });
</script>

<?php } elseif ($_SESSION['username'] == 'didie.prastowo') { ?>

<script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'aktivitas-tim',
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Aktivitas Harian Tim Anda',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Selama 1 Minggu Terakhir',
                        x: -20
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Tanggal Aktivitas'
                        }
                    },
                    yAxis: {
                        min: 0,
                        max: 10,
                        tickInterval: 2,
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: ' Customers'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        floating: 'true',
                        verticalAlign: 'top',
                        borderWidth: 0,
                        y:50
                    },
                    series: []
                };
                $.getJSON("modul/dashboard/data-aktivitas-tim-didie.php", function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    options.series[1] = json[2];
                    options.series[2] = json[3];
                    options.series[3] = json[4];
                    options.series[4] = json[5];
                    options.series[5] = json[6];
                    var chart = new Highcharts.Chart(options);
                });
            });
</script>

<script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'prospek-tim',
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Penjualan Anda',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Selama Tahun ini',
                        x: -20
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Bulan Penjualan Tim Anda'
                        }
                    },
                    yAxis: {
                        min: 1,
                        max: 15,
                        tickInterval: 3,
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: ' Unit'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        floating: 'true',
                        verticalAlign: 'top',
                        borderWidth: 0,
                        y:50
                    },
                    series: []
                };
                $.getJSON("modul/dashboard/data-prospek-tim-didie.php", function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    options.series[1] = json[2];
                    options.series[2] = json[3];
                    options.series[3] = json[4];
                    options.series[4] = json[5];
                    options.series[5] = json[6];
                    var chart = new Highcharts.Chart(options);
                });
            });
</script>

<?php } ?>

<script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'aktivitas-unit',
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Aktivitas Harian Anda',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Selama 1 Minggu Terakhir',
                        x: -20
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Tanggal Aktivitas'
                        }
                    },
                    yAxis: {
                        min: 0,
                        max: 15,
                        tickInterval: 3,
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: ' Customers'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'string',
                        verticalAlign: 'bottom',
                        borderWidth: 0
                    },
                    series: []
                };
                $.getJSON("modul/dashboard/data-aktivitas.php", function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    var chart = new Highcharts.Chart(options);
                });
            });
</script>

<script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    chart: {
                        renderTo: 'prospek-unit',
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Penjualan Anda',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Selama Tahun ini',
                        x: -20
                    },
                    xAxis: {
                        categories: [],
                        title: {
                            text: 'Bulan Penjualan'
                        }
                    },
                    yAxis: {
                        min: 1,
                        max: 15,
                        tickInterval: 3,
                        title: {
                            text: ''
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        valueSuffix: ' Unit'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'string',
                        verticalAlign: 'bottom',
                        borderWidth: 0
                    },
                    series: []
                };
                $.getJSON("modul/dashboard/data-prospek.php", function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    var chart = new Highcharts.Chart(options);
                });
            });
</script>


<script src="../assets/global/plugins/highcharts/js/highcharts.js"></script>
<script src="../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/jquery-validation/js/localization/messages_id.js"> </script>
<script type="text/javascript" src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/zebradatepicker/zebra_datepicker.js" type="text/javascript"></script>

<script type="text/javascript" src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="../assets/admin/pages/scripts/table-managed.js"></script>
<script src="../assets/admin/pages/scripts/form-wizard.js"></script>
<script src="../assets/admin/pages/scripts/components-pickers.js"></script>
<script>
      $(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
      TableManaged.init();
      FormWizard.init();
      ComponentsPickers.init();
      });
   </script>
