<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IluminacionDireccionado extends Model
{
    protected $fillable = [ 'firma','puesto','antiguedad','direccion_completa','observaciones','voucher_id','enfermedades','transtornos_congenitos',
                            //'enfermedades_profecionales','exposicion_anterior','exposicion_actual','cefaleas','vision_doble','mareo_vertigo',
    'enfermedades_profecionales','exposicion_anterior','exp_actual_empresa','exp_actual_actividad','exp_actual_puesto','exp_actual_antiguedad','exp_actual_horario','cefaleas','vision_doble','mareo_vertigo',
    'conjuntivitis','vision_borrosa','inseguridad_de_pie','no_centrados','pupilas_anormales','conjuntivas_anormales',
    'corneas_anormales','motilidad_anormal','nistagmus_ausente','informe_ocular','av_correccion','av_sin_correccion'];

    public function voucher()
    {
        return $this->hasOne('App\Voucher', 'id', 'voucher_id');
    }

    public function generarDiagnostico2()
    {
            // Generación de Diagnóstico
                /* La generación deldiagnostico se realiza cargando dos arrays, uno con las etiquetas y otro con los atributos.
                Luego se procede a cargar sólo los atributos que fueron cargados cuando se generó el formulario*/
                $matriz = [];
                $diagnostico = "";
                //Carga variables
                    $matriz[] = [       //ANTECEDENTES
                                        ' ',
                                        $this->enfermedades,
                                        $this->transtornos_congenitos,
                                        $this->enfermedades_profecionales,
                                        $this->exposicion_anterior,
                                        $this->exposicion_actual,
                                        //"Empresa: ".$this->exp_actual_empresa.", actividad:".$this->exp_actual_actividad.", puesto:".$this->exp_actual_puesto.", antiguedad".$this->exp_actual_antiguedad." y horario: ".$this->exp_actual_horario,

                                        //EXAMEN CLINICO
                                        ' ',
                                        $this->cefaleas,
                                        $this->vision_doble,
                                        $this->mareo_vertigo,
                                        $this->conjuntivitis,
                                        $this->vision_borrosa,
                                        $this->inseguridad_de_pie,

                                        //EXAMEN OCULAR
                                        ' ',
                                        $this->no_centrados,
                                        $this->pupilas_anormales,
                                        $this->conjuntivas_anormales,
                                        $this->corneas_anormales,
                                        $this->motilidad_anormal,
                                        $this->nistagmus_ausente,
                                        $this->informe_ocular,
                                        $this->av_correccion,
                                        $this->av_sin_correccion,
                                        $this->observaciones,
                                        ' ',

                                    ];
                //
                //Carga Labels
                    $matriz[] = [  
                                    //ANTECEDENTES
                                    '<b>ANTECEDENTES</b><br>',
                                    'Enfermedades: ',
                                    'Transtornos congenitos: ',
                                    'Enfermedades profecionales: ',
                                    'Exposicion al riesgo anterior: ',
                                    'Exposicion al riesgo actual: ',


                                    //EXAMEN CLINICO
                                    '<br><b>EXAMEN CLINICO</b><br>Presencia de:<br>',
                                    'Cefaleas: ',
                                    'Visión doble: ',
                                    'Mareo / vértigo: ',
                                    'Conjuntivitis: ',
                                    'Vision borrosa: ',
                                    'Inseguridad en posición de pie: ',


                                    //EXAMEN OCULAR
                                    '<br><b>EXAMEN OCULAR</b><br>Ojos:<br>',
                                    'No centrados: ',
                                    'Pupilas anormales: ',
                                    'Conjuntivas anormales: ',
                                    'Corneas anormales: ',
                                    'Motilidad anormal: ',
                                    'Nistagmus ausente: ',
                                    'Informe ocular: ',
                                    'Agudeza visual con corrección: ',
                                    'Agudeza visual sin correccion: ',
                                    'Observaciones: ',
                                     ' ',

                        ];
                //
            //Carga de diagnostico
            $vacio = false;
            for ($i=0; $i < sizeof($matriz[1]); $i++) {
                if ($matriz[0][$i] != null) {
                    if ($matriz[0][$i] == 1) {
                        $diagnostico = $diagnostico.$matriz[1][$i].". ";
                        $vacio = false;
                    }else{
                        if ($matriz[0][$i] == " ") {
                            if ($vacio) {
                                $diagnostico = $diagnostico.'Sin particularidades.';
                            }
                            $vacio = true;
                            $diagnostico = $diagnostico.$matriz[1][$i]."<b>".$matriz[0][$i]."</b>";
                        }else{
                            $diagnostico = $diagnostico.$matriz[1][$i]." "."<b>".$matriz[0][$i]."</b><br>. ";
                            $vacio = false;
                        }
                    }
                }
            };
        return $diagnostico;
    }

    public function generarDiagnostico()
    {
      // Generación de Diagnóstico
      /* La generación deldiagnostico se realiza cargando dos arrays, uno con las etiquetas y otro con los atributos.
      Luego se procede a cargar sólo los atributos que fueron cargados cuando se generó el formulario*/
      $diagnostico = "";
      //Carga variables
      $matriz = [
        "ANTECEDENTES"=>[
          'Enfermedades'=>$this->enfermedades,
          'Transtornos congenitos'=>$this->transtornos_congenitos,
          'Enfermedades profecionales'=>$this->enfermedades_profecionales,
          'Exposicion al riesgo anterior'=>$this->exposicion_anterior,
          'Exposicion al riesgo actual'=>$this->exposicion_actual,
          //"Empresa: ".$this->exp_actual_empresa.", actividad:".$this->exp_actual_actividad.", puesto:".$this->exp_actual_puesto.", antiguedad".$this->exp_actual_antiguedad." y horario: ".$this->exp_actual_horario,
        ],
        "EXAMEN CLINICO"=>[
          'Cefaleas'=>$this->cefaleas,
          'Visión doble'=>$this->vision_doble,
          'Mareo / vértigo'=>$this->mareo_vertigo,
          'Conjuntivitis'=>$this->conjuntivitis,
          'Vision borrosa'=>$this->vision_borrosa,
          'Inseguridad en posición de pie'=>$this->inseguridad_de_pie,
        ],
        "EXAMEN OCULAR"=>[
          'No centrados'=>$this->no_centrados,
          'Pupilas anormales'=>$this->pupilas_anormales,
          'Conjuntivas anormales'=>$this->conjuntivas_anormales,
          'Corneas anormales'=>$this->corneas_anormales,
          'Motilidad anormal'=>$this->motilidad_anormal,
          'Nistagmus ausente'=>$this->nistagmus_ausente,
          'Informe ocular'=>$this->informe_ocular,
          'Agudeza visual con corrección'=>$this->av_correccion,
          'Agudeza visual sin correccion'=>$this->av_sin_correccion,
          'Observaciones'=>$this->observaciones,
        ]
      ];
      //Carga de diagnostico

      foreach ($matriz as $seccion => $valores) {
        //var_dump($seccion);
        //var_dump($valores);
        $aux2=$aux="";
        $mostrarNombreSeccion=0;
        foreach ($valores as $label => $valor) {
          //if(!in_array($label,$arExcluidos)){
          if($valor==1){
            //$aux.=$label.": "" Si\n".
            $aux.=$label.": <b>Si</b><br>";
            if($seccion=="EXAMEN OCULAR" and !in_array($label,['Agudeza visual con corrección','Agudeza visual sin correccion'])){
              $aux2.=$label.": Si<br>";
            }
            $mostrarNombreSeccion=1;
          }elseif ($valor == "") {
              
          }else{
              $aux.=$label.": <b>".$valor."</b>.<br> ";
              if($seccion=="EXAMEN OCULAR" and in_array($label,['Informe ocular','Observaciones'])){
                if($label=='Observaciones'){
                  $aux2.=$valor."<br>";
                }else{
                  $aux2.=$label.": ".$valor."<br>";
                }
              }
              $mostrarNombreSeccion=1;
          }

          //}
        }
        if($mostrarNombreSeccion==1){
          $aux="<b>".$seccion."</b><br>".$aux."<br>";
          $aux2="<b>".$seccion."</b><br>".$aux2."<br>";
        }
        //echo $aux;
        $diagnostico.=$aux;
      }
            /*$vacio = false;
            for ($i=0; $i < sizeof($matriz[1]); $i++) {
                if ($matriz[0][$i] != null) {
                    if ($matriz[0][$i] == 1) {
                        $diagnostico = $diagnostico.$matriz[1][$i].". ";
                        $vacio = false;
                    }else{
                        if ($matriz[0][$i] == " ") {
                            if ($vacio) {
                                $diagnostico = $diagnostico.'Sin particularidades.';
                            }
                            $vacio = true;
                            $diagnostico = $diagnostico.$matriz[1][$i]."<b>".$matriz[0][$i]."</b>";
                        }else{
                            $diagnostico = $diagnostico.$matriz[1][$i]." "."<b>".$matriz[0][$i]."</b><br>. ";
                            $vacio = false;
                        }
                    }
                }
            };*/
        //return $diagnostico;
        return [$diagnostico,$aux2];
    }
    
}
