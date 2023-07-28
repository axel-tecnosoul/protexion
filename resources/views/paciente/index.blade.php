@extends('layouts.admin')  <!-- Extiende de layout -->

@section('navegacion')
    <li class="breadcrumb-item"><a href="/protexion/public/home">Menu Principal</a></li>
    <li class="breadcrumb-item active">Indice de Pacientes</li>
@endsection


@section('content') <!-- Contenido -->

<div class="card ">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('errors.request')
        <div class="card-header header-bg">
            <div class="card-title">
                <p style="font-size:130%"> <i class="fa fa-id-card" aria-hidden="true"></i> Indice de Pacientes</p>
            </div>
            <div class="card-tools">
                <!-- <a href= {{ route('paciente.create')}}>
                    <button class="btn fondo1">
                        <i class="fas fa-user-plus"></i> Nuevo
                    </button>
                </a> -->
                <a href="{{ route('paciente.create')}}" class="btn fondo1">
                    <i class="fas fa-user-plus"></i> Nuevo
                </a>
                <a class="btn btn-secondary" data-keyboard="false" data-target="#modal-import" data-toggle="modal">
                    <i class="fas fa-user-plus"></i> Importar Pacientes
                </a>
                <button class="btn btn-primary disabled" id="btnVisitaMasiva">
                    <i class="fas fa-stethoscope"></i> Visita masiva
                </button>
                @include('paciente.modalimport')
            </div>
        </div>
        @if(Session::has('message'))
          <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        <div class="card-body">
          hola
            <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filtrar
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">

                        @include('paciente.search')
                    </div>
                </div>
            </div> -->
            <table id="tablaDetalle" style="border:1px solid black; width:100%" class="table table-bordered table-condensed table-hover">
                <thead style="background-color:#222D32">
                    <tr  class="text-uppercase">
                        <th width="5%" style="color:#F8F9F9">
                          <div class="icheck-danger d-inline">
                              <input id="select_all" type="checkbox"/>
                              <Label for="select_all"> </Label>
                          </div>
                        </th>
                        <th width="12%" style="color:#F8F9F9">Ult. visita</th>
                        <th width="22%" style="color:#F8F9F9">Apellido y Nombre</th>
                        <th width="8%" style="color:#F8F9F9">DNI</th>
                        <th width="18%" style="color:#F8F9F9">Empresa</th>
                        <th width="10%" style="color:#F8F9F9">Foto</th><!-- de perfil -->
                        <th width="25%" style="color:#F8F9F9">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)<?php
                        //var_dump($paciente);
                        ?>
                        <tr onmouseover="cambiar_color_over(this)" onmouseout="cambiar_color_out(this)">
                            <td style="text-align: center;vertical-align: middle;">
                                <div class="icheck-danger d-inline">
                                    <input type="checkbox" name="paciente[]" value="{{$paciente->id}}" class="paciente" id="{{$paciente->id}}">
                                    <label for="{{$paciente->id}}"> </label>
                                </div>
                            </td>
                            <td style="text-align: left">{{ $paciente->ultima_visita }}</td>
                            <td style="text-align: left" class="nombre_paciente"
                              data-referencia="{{$paciente->existeReferencia()}}"
                              data-paciente-id="{{$paciente->id}}"
                              data-nombre="{{$paciente->nombreCompleto()}}"
                              data-empresa="<?php
                                if($paciente->origen == null) echo(" ");
                                else echo($paciente->origen->definicion)?>"
                              data-documento="<?php
                                if($paciente->documento == null) echo(" ");
                                else echo($paciente->documentoIdentidad())?>"
                              data-sexo="<?php
                                if($paciente->sexo == null) echo(" ");
                                else echo($paciente->sexo->definicion)?>"
                              data-domicilio="<?php
                                if($paciente->domicilio == null) echo(" ");
                                else echo($paciente->direccion())?>"
                              data-fecha-nacimiento="{{Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }} ({{Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años)"
                              data-cuil="{{ $paciente->cuil }}"
                              data-peso="{{ $paciente->peso }}"
                              data-estatura="{{ $paciente->estatura }}"
                              data-estado-civil="<?php
                                if($paciente->estadoCivil == null) echo(" ");
                                else echo($paciente->estadoCivil->definicion)?>"
                            >{{ $paciente->nombreCompleto() }}</td>
                            <td><?php
                              if($paciente->documento == null) echo(" ");
                              else echo(number_format( (intval($paciente->documento)/1000), 3, '.', '.'))?>
                            </td>
                            <td style="text-align: left"><?php
                              if($paciente->origen == null) echo(" ");
                              else echo($paciente->origen->definicion)?>
                            </td>
                            <td style="text-align: center" class="foto_paciente"><?php
                              $mostrar_imagen_default=1;
                              $foto_mostrar="imagenes/paciente/thumbnails/default.png";
                              if($paciente->imagen != null){
                                $path_foto_paciente="imagenes/paciente/";
                                
                                $path_thumbnail=$path_foto_paciente.'thumbnails/'.$paciente->imagen;
                                //$path_thumbnail=$path_foto_paciente.$paciente->imagen;
                                $path_foto_original=$path_foto_paciente.$paciente->imagen;

                                if(file_exists("../public/".$path_thumbnail)){
                                  $mostrar_imagen_default=0;
                                  $foto_mostrar=$path_thumbnail;
                                }elseif(file_exists('../public/'.$path_foto_original)){
                                  $mostrar_imagen_default=0;
                                  $foto_mostrar=$path_foto_original;
                                }
                              }?>
                              <img src="{{ asset($foto_mostrar)}}" width="50px" class="img-circle elevation-2" alt="User Image">
                            </td>

                            <td style="text-align: center" colspan="3">
                                <a href="{{URL::action('PacienteController@edit',$paciente->id)}}">
                                    <button title="editar" class="btn fondo2 btn-responsive">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                                <a class="btnShow" data-keyboard="false" data-id="{{ $paciente->id }}">
                                    <button title="editar" class="btn fondo1 btn-md">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{URL::action('PacienteController@voucher',$paciente->id)}}">
                                    <button title="carpeta"  class="btn fondo2 btn-responsive">
                                        <i style="color: rgb(255, 255, 255)" class="fas fa-folder"></i>
                                    </button>
                                </a>
                                <a class="btnDelete" data-keyboard="false" data-id="{{ $paciente->id }}">
                                    <button type="submit" class="btn fondo1 btn-responsive"><i class="fa fa-fw fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- aca colocar el modaldelete-->
            @include('paciente.modaldelete')
            <!-- aca colocar el modalhabilitar SIN USAR-->
            @include('paciente.modalhabilitar')
            <!-- aca colocar el modalshow-->
            @include('paciente.modalshow')

        </div>
    </div>
</div>
@push('scripts')
  <!-- <script src="{{asset('js/tablaDetalle.js')}}"></script> -->
  <!-- <script src="{{asset('js/datatable/datatables/jquery.dataTables.min.js')}}"></script> -->
  <script src="{{asset('js\calendar\moment.min.js')}}"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/datetime-moment.js"></script>

  <script type="text/javascript">

    $(document).on("click",".btnDelete",function(){
      console.log(this);
      let fila=$(this).parents("tr");
      let celda_paciente=fila.find(".nombre_paciente");
      console.log(celda_paciente);
      console.log(celda_paciente.data());
      let nombre_paciente=celda_paciente.html();
      let referencia=celda_paciente.data("referencia");
      console.log(referencia);
      let paciente_id=$(this).data("id");

      let modal=$("#modal-delete")
      modal.modal("show");
      modal.find("#lblPaciente").html(nombre_paciente)
      modal.find("#lblReferencia").html(referencia)
      console.log(paciente_id);
      modal.find("form").attr("action","/protexion/public/paciente/"+paciente_id)
    })

    $(document).on("click",".btnShow",function(){
      console.log(this);
      let fila=$(this).parents("tr");
      let celda_paciente=fila.find(".nombre_paciente");
      let foto_paciente=fila.find(".foto_paciente").find("img");
      foto_paciente=foto_paciente[0]
      let nombre_paciente=celda_paciente.html();

      let paciente_id=celda_paciente.data("pacienteId");
      let empresa=celda_paciente.data("empresa");
      let documento=celda_paciente.data("documento");
      let sexo=celda_paciente.data("sexo");
      let domicilio=celda_paciente.data("domicilio");
      let fechaNacimiento=celda_paciente.data("fechaNacimiento");
      let cuil=celda_paciente.data("cuil");
      let peso=celda_paciente.data("peso");
      let estatura=celda_paciente.data("estatura");
      let estadoCivil=celda_paciente.data("estadoCivil");

      $("#lblEmpresa").html(empresa);
      console.log(foto_paciente);
      console.log(foto_paciente.src);
      var foto = foto_paciente.src.replace("/thumbnails", "");
      $("#foto_paciente").attr("src",foto);
      $(".lblPaciente").html(nombre_paciente);
      $("#lblDocumento").html(documento);
      $("#lblSexo").html(sexo);
      $("#lblDomicilio").html(domicilio);
      $("#lblFechaNacimiento").html(fechaNacimiento);
      $("#lblCuil").html(cuil);
      $("#lblPeso").html(peso);
      $("#lblEstatura").html(estatura);
      $("#lblEstadoCivil").html(estadoCivil);

      let modal=$("#modal-show")
      modal.modal("show");

    })

    $("#select_all").on("click",function(){
      if(this.checked){
        $(".paciente").prop("checked",true)
      }else{
        $(".paciente").prop("checked",false)
      }
      checkPacientesCheckeados()
    })

    $(document).on("click",".paciente",function(){
      checkPacientesCheckeados()
    })

    $(document).ready(function () {
      $("#btnVisitaMasiva").on("click",function(e){
        if($(this).hasClass("disabled")){

        }else{
          let aIdPacientes=[]
          $(".paciente:checked").each(function(){
            //console.log(this.value);
            aIdPacientes.push(this.value)
          })
          //enviar(aIdPacientes.join(","))
          //$("#formVisitaMasiva").submit();
          window.location.href="voucher/create/"+encodeURIComponent(aIdPacientes.join(","))
        }
      })
    });

    function checkPacientesCheckeados(){
      if($(".paciente:checked").length>0){
        $("#btnVisitaMasiva").removeClass("disabled")
      }else{
        $("#btnVisitaMasiva").addClass("disabled")
      }
    }

    $(document).ready(function() {
      let table=$('#tablaDetalle').DataTable({
        "pageLength" : 15,
        "lengthMenu": [ 10, 15, 25, 50, 75, 100 ],
        "aaSorting":[],
        "language":{
            "info":"_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next":"Siguiente",
                "previous":"Anterior"
            },
            "loadingRecords":"Cargando...",
            "processing":"Procesando...",
            "emptyTable":"No hay datos",
            "zeroRecords":"No hay coincidencias",
            "infoEmpty":"",
            "infoFiltered":""
        },
        columnDefs: [
          //{ targets: [1], type: "date", "dateFormat": "dd/mm/yyyy"},//, "defaultContent": "01/01/1900" 
          { "targets": 1, "type": "date", "render": function(data, type, row) {
              // Si el tipo de datos es "sort" o "type", devolver la fecha sin formato
              if (type === "sort" || type === "type") {
                return data;
              }
              // Si el tipo de datos es "display", formatear la fecha con Moment.js
              else {
                if(data=="1900-01-01 00:00:00"){
                  return "";
                }else{
                  return moment(data).format("DD/MM/YYYY");
                }
              }
            }
          }
        ]
      });
      //
      var columnType = table.column( 1 ).dataSrc();
      //console.log($.fn.dataTable.moment('DD/MM/YYYY').parse('04-25-2023'));
      let columnData=table.column( 1 ).data()
      
      cambiar_color_over(celda);
    } );

    function cambiar_color_over(celda){
      celda.style.backgroundColor="#A7A7A7"
    }
    function cambiar_color_out(celda){
      celda.style.backgroundColor="#FFFFFF"
    }
  </script>
@endpush
@endsection