<?php
/*************************************************************************
Gerardo Pazos <gerardo@sait.mx>
Copyright (c)  2015 SAIT Software
https://www.sait.mx

Released under the GNU General Public License WITHOUT ANY WARRANTY.
See LICENSE.TXT for details.

vim: expandtab sw=4 ts=4 sts=4:
**********************************************************************/
require('staff.inc.php');
$nav->setTabActive('reportes');
$ost->addExtraHeader('<meta name="tip-namespace" content="reportes.reportes" />', "$('#reportes-content').data('tipNamespace', 'reportes.reportes');");
require(STAFFINC_DIR . 'header.inc.php');
?>
<div id="reportes-content">

<script>
/*
Function : String Format
Code : http://jsfiddle.net/joquery/9KYaQ/
Date : 2/11/2015
*/
String.format = function() {
    // The string containing the format items (e.g. "{0}")
    // will and always has to be the first argument.
    var theString = arguments[0];
    
    // start with the second argument (i = 1)
    for (var i = 1; i < arguments.length; i++) {
        // "gm" = RegEx options for Global search (more than one instance)
        // and for Multiline search
        var regEx = new RegExp("\\{" + (i - 1) + "\\}", "gm");
        theString = theString.replace(regEx, arguments[i]);
    }
    
    return theString;
}


$( document ).ready(function() {

    var self = this;
    var vista = $('#reportes-content');
    
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    this.tktAgenteCloseStart = vista.find('#tktAgenteCloseStart');
    this.tktAgenteCloseEnd = vista.find('#tktAgenteCloseEnd');

    
    vista.find('#generarTktsCerradosAgente').click(function(){
        
        var tktAgenteCloseStart = self.tktAgenteCloseStart.val();
        var tktAgenteCloseEnd = self.tktAgenteCloseEnd.val();
    
       // var Reporteurl = String.format("http://192.168.0.14:8080/jasperserver/flow.html
       //?_flowId=viewReportFlow&standAlone=true&_flowId=viewReportFlow&
       //ParentFolderUri=%2FSoporte&reportUnit=%2FSoporte//%2F
       //TksCerradosAgenteFecha&decorate=no&j_username=joeuser&j_password=joeuser&start={0}&end={1}",tktAgenteCloseStart, tktAgenteCloseEnd);
       
      var Reporteurl = String.format("http://soporte.sait.mx:8080/jasperserver/flow.html?_flowId=viewReportFlow"+
      "&_flowId=viewReportFlow&ParentFolderUri=%2Fsoporte_sait_mx%2FReportes&reportUnit=%2Fsoporte_sait_mx%2FReportes%2F"+
      "TksCerradosAgenteFecha&j_username=osticket&j_password=msl01&decorate=no&start={0}&end={1}",tktAgenteCloseStart, tktAgenteCloseEnd);


        if (tktAgenteCloseStart != "" && tktAgenteCloseEnd != ""  
            && tktAgenteCloseStart < tktAgenteCloseEnd){
            window.open(Reporteurl, "_blank");
        }else{
            alert("Introduzca Fechas Correctamente");
        }
       

 
    });//function
    
    
    this.tktAgenteCloseEnd.keypress(function(e) {
    if ( e.which == 13 ) {
        e.preventDefault();
        vista.find('#generarTktsCerradosAgente').trigger('click');
    }

    });
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    this.tktUsuarioCloseStart = vista.find('#tktUsuarioCloseStart');
    this.tktUsuarioCloseEnd = vista.find('#tktUsuarioCloseEnd');
    
    vista.find('#generarTktsCerradosUsuario').click(function(){
        
        var tktUsuarioCloseStart = self.tktUsuarioCloseStart.val();
        var tktUsuarioCloseEnd = self.tktUsuarioCloseEnd.val();
    
        var Reporteurl = String.format("http://soporte.sait.mx:8080/jasperserver/flow.html?_flowId=viewReportFlow&_flowId=viewReportFlow"+
        "&ParentFolderUri=%2Fsoporte_sait_mx%2FReportes&reportUnit=%2Fsoporte_sait_mx%2FReportes%2F"+
        "TksCerradosClienteFecha&j_username=osticket&j_password=msl01&decorate=no&start={0}&end={1}",tktUsuarioCloseStart, tktUsuarioCloseEnd);
        

        if (tktUsuarioCloseEnd != "" && tktUsuarioCloseStart != ""  
            && tktUsuarioCloseStart < tktUsuarioCloseEnd){
            window.open(Reporteurl, "_blank");
        }else{
            alert("Introduzca Fechas Correctamente");
        }
       

 
    });//function
    
    
    this.tktUsuarioCloseEnd.keypress(function(e) {
    if ( e.which == 13 ) {
        e.preventDefault();
        vista.find('#generarTktsCerradosUsuario').trigger('click');
    }

    });
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        

    
    this.tktProductoCloseStart = vista.find('#tktProductoCloseStart');
    this.tktProductoCloseEnd = vista.find('#tktProductoCloseEnd');
    
    vista.find('#generarTktsCerradosProducto').click(function(){
        
        var tktProductoCloseStart = self.tktProductoCloseStart.val();
        var tktProductoCloseEnd = self.tktProductoCloseEnd.val();
    
        var Reporteurl = String.format("http://soporte.sait.mx:8080/jasperserver/flow.html?_flowId=viewReportFlow"+
        "&_flowId=viewReportFlow&ParentFolderUri=%2Fsoporte_sait_mx%2FReportes&reportUnit=%2Fsoporte_sait_mx%2FReportes%2F"+
        "TksCerradosProductoFecha&j_username=osticket&j_password=msl01&decorate=no&start={0}&end={1}",tktProductoCloseStart, tktProductoCloseEnd);
        


        if (tktProductoCloseStart != "" && tktProductoCloseEnd != "" 
            && tktProductoCloseStart < tktProductoCloseEnd){
            window.open(Reporteurl, "_blank");
        }else{
            alert("Introduzca Fechas Correctamente");
        }
       

 
    });//function
    
    
    this.tktProductoCloseEnd.keypress(function(e) {
    if ( e.which == 13 ) {
        e.preventDefault();
        vista.find('#generarTktsCerradosProducto').trigger('click');
    }

    });
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
});


</script>

<h2><?php
echo __('Reportes');
?>&nbsp;<i class="help-tip icon-question-sign" href="#ticket_activity"></i></h2>



<h3>Tickets Cerrados por Agente</h3>
Desde:
<input type="date" id="tktAgenteCloseStart">
Hasta:
<input type="date" id="tktAgenteCloseEnd">
<button class="btn btn-primary" id="generarTktsCerradosAgente" >Generar </button>
<br>

<h3>Tickets Cerrados por Cliente</h3>
Desde:
<input type="date" id="tktUsuarioCloseStart">
Hasta:
<input type="date" id="tktUsuarioCloseEnd">
<button class="btn btn-primary" id="generarTktsCerradosUsuario" >Generar </button>
<br>

<h3>Tickets Cerrados por Producto</h3>
Desde:
<input type="date" id="tktProductoCloseStart">
Hasta:
<input type="date" id="tktProductoCloseEnd">
<button class="btn btn-primary" id="generarTktsCerradosProducto" >Generar </button>
<br>

</div>
<?php
include(STAFFINC_DIR . 'footer.inc.php');
?>