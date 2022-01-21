<!-- Recibe como parametro un voucher que este relacionado con un paciente -->

<div class="card flex-fill" >
    <div class="card-header header-bg">
        <h3 class="card-title">Datos del paciente</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-7">
                <div class="added"> <input type="hidden" value="'+nombres+'">
                    <p style="font-size:100%" class="text-left"> <strong> Nombre completo:    </strong> {{$voucher->paciente->nombreCompleto()             }} </p>
                    <p style="font-size:100%" class="text-left"> <strong> CUIL:               </strong> {{$voucher->paciente->cuil                         }} </p>
                    <p style="font-size:100%" class="text-left"> <strong> Fecha de nacimiento:</strong> {{$voucher->paciente->fecha_nacimiento()           }} </p> 
                    <p style="font-size:100%" class="text-left"> <strong> Edad:               </strong> {{$voucher->paciente->edad()                       }} </p>
                    <p style="font-size:100%" class="text-left"> <strong> Domicilio:          </strong> {{$voucher->paciente->domicilio ? $voucher->paciente->domicilio->direccion : " "        }} </p>
                    <p style="font-size:100%" class="text-left"> <strong> Sexo:               </strong> {{$voucher->paciente->sexo ? $voucher->paciente->sexo->definicion : " "                 }} </p>
                    <p style="font-size:100%" class="text-left"> <strong> Origen:             </strong> {{$voucher->paciente->origen ? $voucher->paciente->origen->definicion : " "             }} </p>
                    <p style="font-size:100%" class="text-left"> <strong> Cuit de origen:     </strong> {{$voucher->paciente->origen ? $voucher->paciente->origen->cuit : " "                   }} </p>      
                    <p style="font-size:100%" class="text-left"> <strong> Turno:              </strong> {{$voucher->turno ? \Carbon\Carbon::parse($voucher->turno)->format('d/m/Y') : " "                   }} </p>      
                </div>
            </div>
            <div class="col-4">
                <div class="added"> 
                    @if($voucher->paciente->imagen==null)
                        <img class="img-thumbnail" height="200px" width="200px" src="{{ asset('imagenes/paciente/default.png')}}">
                    @else
                        <img class="img-thumbnail" height="200px" width="200px" src="{{$voucher->paciente->imagen}}">
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>