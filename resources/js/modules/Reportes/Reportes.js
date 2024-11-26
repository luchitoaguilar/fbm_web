
var vm = new Vue({
    el: '#reportes-app',
    data: {
        //accounting: accounting,
        auth: auth,
        errorBag: {},
        isLoading: false,
        unidades: {},
        reporte:{},
        tiposContrato: {}
    }, 
    methods: {
    getUnidades () {
      axios.get( urlListUnidad )
          .then( result => vm.unidades = result.data.data );
    },
    getTipoContratos () {
        axios.get('/TipoContrato/list')
            .then( result => vm.tiposContrato = result.data.data );
    },
    showFormulario (id) {

      switch (id) { 
          case 1: 
              vm.reporte={};
              vm.reporte.Numero=1;
              vm.reporte.Archivo="PersonalPorGenero.jrxml";
              $('#frm-formulario_1').modal('show'); break;
          case 2:
              vm.reporte={};
              vm.reporte.Numero=2;
              vm.reporte.Archivo="PersonalFormacion.jrxml";
              $('#frm-formulario_2').modal('show'); break;
          case 3:
              vm.reporte={};
              vm.reporte.Numero=3;
              vm.reporte.Archivo="PersonalMilitar.jrxml";
              $('#frm-formulario_3').modal('show'); break;		
          case 4: 
              vm.reporte={};
              vm.reporte.Numero=4;
              vm.reporte.Archivo="PersonalDependiente.jrxml";
              $('#frm-formulario_4').modal('show'); break;
          case 5: 
              vm.reporte={};
              vm.reporte.Numero=5;
              vm.reporte.Archivo="PersonalPosgrado.jrxml";
              $('#frm-formulario_5').modal('show'); break;
          case 6: 
              vm.reporte={};
              vm.reporte.Numero=6;
              vm.reporte.Archivo="PersonalIdiomaNativo.jrxml";
              $('#frm-formulario_6').modal('show'); break;
          case 7: 
              vm.reporte={};
              vm.reporte.Numero=7;
              vm.reporte.Archivo="PersonalLey1178.jrxml";
              $('#frm-formulario_7').modal('show'); break;
          case 8: 
              vm.reporte={};
              vm.reporte.Numero=8;
              vm.reporte.Archivo="PersonalResFunPublica.jrxml";
              $('#frm-formulario_8').modal('show'); break;
          case 9: 
              this.inicializar();
              vm.reporte={};

              vm.reporte.Numero=9;
              vm.reporte.Archivo="PersonalRelaParentesco.jrxml";
              $('#frm-formulario_9').modal('show'); break;
          case 10:
              vm.reporte={};
              vm.reporte.Numero=10;
              vm.reporte.Archivo="PersonalmasAntiguo.jrxml";
              $('#frm-formulario_10').modal('show'); break;
          case 11:
              vm.reporte={};
              vm.reporte.Numero=11;
              vm.reporte.Archivo="PersonalDoblePercepcion.jrxml";
              $('#frm-formulario_11').modal('show'); break;
          case 12:
              vm.reporte={};
              vm.reporte.Numero=12;
              vm.reporte.Archivo="PersonalSubiosusDatos.jrxml";
              $('#frm-formulario_12').modal('show'); break;
          case 13:                    
              vm.reporte={};
              vm.reporte.Numero=13;
              vm.reporte.Archivo="PersonalUnidadOrganizacional.jrxml";
              $('#frm-formulario_13').modal('show'); break;
          case 14:
              vm.reporte={};
              vm.reporte.Numero=14;
              vm.reporte.Archivo="DirectoresNacionales.jrxml";
              $('#frm-formulario_14').modal('show'); break;
          case 15:
              vm.reporte={};
              vm.reporte.Numero=15;
              vm.reporte.Archivo="DirectoresUnidadesAcademicas.jrxml";
              $('#frm-formulario_15').modal('show'); break;
          case 16:
              vm.reporte={};
              vm.reporte.Numero=16;
              vm.reporte.Archivo="JefesdeUnidad.jrxml";
              $('#frm-formulario_16').modal('show'); break;
          case 17:
              vm.reporte={};
              vm.reporte.Numero=17;
              vm.reporte.Archivo="ResponsablesdeArea.jrxml";
              $('#frm-formulario_17').modal('show'); break;
          case 18:
              vm.reporte={};
              vm.reporte.Numero=18;
              vm.reporte.Archivo="EncargadosdeArea.jrxml";
              $('#frm-formulario_18').modal('show'); break;
          case 19:
              vm.reporte={};
              vm.reporte.Numero=19;
              vm.reporte.Archivo=".jrxml";
              vm.reporte.Titulo="Reporte Salud del personal"; 
              $('#frm-formulario_19').modal('show'); 
              //$("#UAS > option[value=1]").attr("selected",true); 
              break;
          case 20:              
                vm.reporte={};
                vm.reporte.Numero=20;
                vm.reporte.Archivo=".jrxml";
                vm.reporte.Titulo="Reporte Novedades del personal Militar"; 
                $('#frm-formulario_19').modal('show'); break;
      }     
  },
  
    imprimirFormularioPDF () {  
        axios.get( urlReportePDF, {params: {Unidad: vm.reporte.Unidad, Sexo: vm.reporte.Sexo , Archivo: vm.reporte.Archivo, 'Usuario': vm.reporte.Usuario }})
        .then( result => {
        
        vm.reporte.url = result.data.url;   
        var url=vm.reporte.url;
        var a = document.createElement("a");
        a.href = url;
        a.target="_blank";
        a.click();

    })
        .catch( error => {
        console.log( error );
        })
    },
   
    imprimirFormularioXLXS(){        
        axios.get( urlReporteXLXS, {params: {Unidad: vm.reporte.Unidad, Sexo: vm.reporte.Sexo , Archivo: vm.reporte.Archivo , Numero : vm.reporte.Numero , Usuario: vm.reporte.Usuario, Inicio: vm.reporte.FechaInicio, Fin: vm.reporte.FechaFin}})
        .then( result => {
        vm.reporte.url = result.data.url; 
        var url=vm.reporte.url;
        var a = document.createElement("a");
        a.href = url;
        a.target="_blank";
        a.click();
    })
        .catch( error => {
        console.log( error );
        })
    },

    },

    mounted () {
    
      this.getUnidades();
      this.getTipoContratos();
  }
    
  });
