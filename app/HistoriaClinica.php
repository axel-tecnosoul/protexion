<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HistoriaClinica extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;

    protected $fillable = [
        'codigo',
        'voucher_id',
        //'firma',
        'user_id',

    ];

    protected $table = 'historia_clinicas';

    public function voucher()
    {
        return $this->belongsTo('App\Voucher');
    }

    public function examenClinico()
    {
        return $this->hasOne('App\ExamenClinico');
    }

    public function cardiovascular()
    {
        return $this->hasOne('App\Cardiovascular');
    }

    public function piel()
    {
        return $this->hasOne('App\Piel');
    }

    public function osteoarticular()
    {
        return $this->hasOne('App\Osteoarticular');
    }

    public function columna()
    {
        return $this->hasOne('App\Columna');
    }

    public function cabezaCuello()
    {
        return $this->hasOne('App\CabezaCuello');
    }

    public function oftalmologico()
    {
        return $this->hasOne('App\Oftalmologico');
    }

    public function neurologico()
    {
        return $this->hasOne('App\Neurologico');
    }

    public function odontologico()
    {
        return $this->hasOne('App\Odontologico');
    }

    public function respiratorio()
    {
        return $this->hasOne('App\Respiratorio');
    }

    public function abdomen()
    {
        return $this->hasOne('App\Abdomen');
    }

    public function regionInguinal()
    {
        return $this->hasOne('App\RegionInguinal');
    }

    public function genital()
    {
        return $this->hasOne('App\Genital');
    }

    public function regionAnal()
    {
        return $this->hasOne('App\RegionAnal');
    }

    public function generarDiagnostico2()
    {

            // Generación de Diagnóstico
            /* La generación del diagnostico se realiza cargando dos arrays, uno con las etiquetas y otro con los atributos.
            Luego se procede a cargar sólo los atributos que fueron cargados cuando se generó el formulario*/
            $matriz = [];
            $diagnostico = "";
            //Carga variables
                $matriz[] = [           //Examen Clinico
                                        ' ',
                                        $this->examenClinico->peso,
                                        $this->examenClinico->estatura,
                                        $this->examenClinico->sobrepeso,
                                        $this->examenClinico->imc,
                                        //$this->examenClinico->medicacion_actual,
                                        ($this->examenClinico->medicacion_actual) ? $this->examenClinico->medicacion_actual : "No posee",

                                        //Cardiovascular
                                        ' ',
                                        $this->cardiovascular->frecuencia_cardiaca,
                                        $this->cardiovascular->tension_arterial,
                                        ($this->cardiovascular->pulso=="A") ? "Anormal" : "Normal",
                                        //$this->cardiovascular->pulso,
                                        $this->cardiovascular->observacion_varices,

                                        //Piel
                                        ' ',
                                        $this->piel->observacion1_piel,
                                        $this->piel->obs_vesicula,
                                        $this->piel->obs_ulceras,
                                        $this->piel->obs_fisuras,
                                        $this->piel->obs_prurito,
                                        $this->piel->obs_eczemas,
                                        $this->piel->obs_dertmatitis,
                                        $this->piel->obs_eritemas,
                                        $this->piel->obs_petequias,
                                        $this->piel->tejido,

                                        //OSTEOARTICULAR
                                        ' ',
                                        $this->osteoarticular->observacion1_os,
                                        $this->osteoarticular->observacion2_os,
                                        $this->osteoarticular->observacion3_os,
                                        $this->osteoarticular->observacion4_os,
                                        $this->osteoarticular->observacion_os,

                                        //COLUMNA VERTEBRAL
                                        ' ',
                                        $this->columna->observacion1_col,
                                        $this->columna->observacion2_col,
                                        $this->columna->observacion3_col,
                                        $this->columna->observacion4_col,
                                        $this->columna->observacion_col,

                                        //CABEZA Y CUELLO
                                        ' ',
                                        $this->cabezaCuello->observacion1_cc,
                                        $this->cabezaCuello->observacion2_cc,
                                        $this->cabezaCuello->observacion3_cc,
                                        $this->cabezaCuello->observacion4_cc,
                                        $this->cabezaCuello->observacion5_cc,
                                        $this->cabezaCuello->observacion6_cc,

                                        //OFTALMOLÓGICO
                                        ' ',
                                        $this->oftalmologico->observacion1_of,
                                        $this->oftalmologico->observacion2_of,
                                        $this->oftalmologico->observacion3_of,
                                        $this->oftalmologico->observacion4_of,
                                        $this->oftalmologico->observacion5_of."/10",
                                        $this->oftalmologico->observacion6_of."/10",
                                        $this->oftalmologico->pregunta7_of,
                                        $this->oftalmologico->observacion_of,

                                        //NEUROLOGICO
                                        ' ',
                                        $this->neurologico->observacion1_neu,
                                        $this->neurologico->observacion2_neu,
                                        $this->neurologico->observacion3_neu,
                                        $this->neurologico->observacion4_neu,
                                        $this->neurologico->observacion5_neu, 
                                        $this->neurologico->observacion6_neu,
                                        $this->neurologico->observacion7_neu,
                                        $this->neurologico->observacion_neu,

                                        //ODONTOLOGICO
                                        ' ',
                                        $this->odontologico->observacion1_od,
                                        $this->odontologico->observacion2_od,
                                        $this->odontologico->pregunta4_od, 
                                        $this->odontologico->pregunta5_od,
                                        $this->odontologico->superior,
                                        $this->odontologico->inferior,
                                        $this->odontologico->observacion_od,

                                        //TORAX Y APARTO RESPIRATORIO
                                        ' ',
                                        $this->respiratorio->observacion1_re,
                                        $this->respiratorio->observacion2_re,
                                        $this->respiratorio->covid19,
                                        $this->respiratorio->vacunado,

                                        //ABDOMEN
                                        ' ',
                                        $this->abdomen->observacion1_ab,
                                        $this->abdomen->observacion2_ab,
                                        $this->abdomen->observacion3_ab,
                                        $this->abdomen->observacion4_ab,
                                        $this->abdomen->observacion5_ab,
                                        $this->abdomen->observacion6_ab,
                                        $this->abdomen->observacion_ab,

                                        //REGIONES INGUINALES
                                        ' ',
                                        $this->regionInguinal->observacion1_in,
                                        $this->regionInguinal->observacion2_in,
                                        $this->regionInguinal->observacion3_in,
                                        $this->regionInguinal->observacion_in,

                                        //GENITALES
                                        ' ',
                                        $this->genital->observacion1_ge,
                                        $this->genital->observacion_ge,

                                        //REGIÓN ANAL
                                        ' ',
                                        $this->regionAnal->observacion1_an,
                                        $this->regionAnal->observacion_an,
                                        ' ',
                ];
            //
            //Carga Labels
                $matriz[] = [   '<b>EXAMEN CLÍNICO</b><br>',
                                'Peso: ',
                                'Estatura: ',
                                'Sobrepeso: ',
                                'IMC: ',
                                'Medicación actual: ',

                                '<br><b>CARDIOVASCULAR</b><br>',
                                'Frecuencia cardíaca: ',
                                'Tensión arterial: ',
                                'Pulso: ',
                                'Várices: ',

                                '<br><b>PIEL</b><br>',
                                'Cicatrices patológicas visibles: ',
                                'Vesícula: ',
                                'Ulceras: ',
                                'Fisuras: ',
                                'Prurito: ',
                                'Eczemas: ',
                                'Dermatitis: ',
                                'Eritemas: ',
                                'Petequias: ',
                                'Tejido celular subcutaneo: ',
                                
                                '<br><b>OSTEOARTICULAR</b><br>',
                                'Limitaciones funcionales: ',
                                'Amputaciones: ',
                                'Movilidad y reflejo: ',
                                'Tonicidad y fuerza muscular normal: ',
                                'Observaciones: ',

                                '<br><b>COLUMNA VERTEBRAL</b><br>',
                                'Examen normal: ',
                                'Contracturas: ',
                                'Puntos dolorosos: ',
                                'Limitaciones funcionales: ',
                                'Observaciones: ',

                                '<br><b>CABEZA Y CUELLO</b><br>',
                                'Cráneo: ',
                                'Cara: ',
                                'Nariz: ',
                                'Oídos: ',
                                'Boca: ',
                                'Cuello y Tiroides: ',

                                '<br><b>OFTALMOLÓGICO</b><br>',
                                'Pupilas: ',
                                'Corneas: ',
                                'Conjuntivas: ',
                                'Visión en colores: ',
                                'Ojo derecho: ',
                                'Ojo izquierdo: ',
                                'Usa lentes: ',
                                'Observaciones: ',

                                '<br><b>NEUROLOGICO</b><br>',
                                'Motilidad activa: ',
                                'Motilidad pasiva: ',
                                'Sensibilidad: ',
                                'Marcha: ',
                                'Reflejos osteotendinosos: ',
                                'Pares craneales: ',
                                'Taxia: ',
                                'Observaciones: ',

                                '<br><b>ODONTOLOGICO</b><br>',
                                'Encias y mucosas: ',
                                'Esmalte dental: ',
                                'Superior: ',
                                'Inferior: ',
                                'Caries: ',
                                'Faltan piezas dentarias: ',
                                'Observaciones: ',
                                
                                '<br><b>TORAX Y APARTO RESPIRATORIO</b><br>',
                                'Caja torácica: ',
                                'Pulmones: ',
                                'COVID 19: ',
                                'Vacunas: ',
                                
                                '<br><b>ABDOMEN</b><br>',
                                'Forma: ',
                                'Hígado: ',
                                'Bazo: ',
                                'Colon: ',
                                'Ruidos hidroaéreos: ',
                                'Puño percusión: ',
                                'Cicatrices quirúrjicas: ',
                                
                                '<br><b>REGIONES INGUINALES</b><br>',
                                'Tono de la pared posterior: ',
                                'Orificios superficiales: ',
                                'Orificios profundos: ',
                                'Observaciones: ',
                                
                                '<br><b>GENITALES</b><br>',
                                'Características: ',
                                'Observaciones: ',
                                
                                '<br><b>REGIÓN ANAL</b><br>',
                                'Características: ',
                                'Observaciones: ',
                                ' ',
                                ];
                
            //
            //Carga de diagnostico
            $vacio = false;
            $obs="";
            $arExcluidos=["Estatura: ","Peso: ","Ojo derecho: ","Ojo izquierdo: ","Usa lentes: ","Pulso: ","Frecuencia cardíaca: "];
            //var_dump($matriz[0]);
            
            for ($i=0; $i < sizeof($matriz[1]); $i++) {
                if ($matriz[0][$i] != null) {
                    $label=$matriz[1][$i];
                    if ($matriz[0][$i] == 1) {
                        $diagnostico = $diagnostico.$label."<b>Si</b>. ";
                        if(!in_array($label,$arExcluidos)){
                          $obs.=$label." Si\n";
                        }
                        $vacio = false;
                    }else{
                        if ($matriz[0][$i] == "") {
                            if ($vacio) {
                                $diagnostico = $diagnostico.'Sin particularidades.';
                            }
                            $vacio = true;
                            $diagnostico = $diagnostico.$label."<b>".$matriz[0][$i]."</b>";
                            //var_dump($diagnostico);
                            
                        }else{
                            $diagnostico = $diagnostico.$label." "."<b>".$matriz[0][$i]."</b>.<br> ";
                            $cargarObs=$matriz[0][$i];
                            
                            if(!in_array($label,$arExcluidos)){
                              //$cargarObs=str_replace("<br>","",$cargarObs);
                              $obs.=$label." ".$cargarObs."\n";
                            }
                            $vacio = false;
                        }
                    }
                }
            };
            //die();
            return [$diagnostico,$obs];
            //
        //
    }

    public function generarDiagnostico()
    {
      // Generación de Diagnóstico
      /* La generación del diagnostico se realiza cargando dos arrays, uno con las etiquetas y otro con los atributos.
      Luego se procede a cargar sólo los atributos que fueron cargados cuando se generó el formulario*/
      $obs=$diagnostico = "";
      //Carga variables
      $matriz = [
        "EXAMEN CLINICO"=>[
          'Peso'=>$this->examenClinico->peso,
          'Estatura'=>$this->examenClinico->estatura,
          'Sobrepeso'=>$this->examenClinico->sobrepeso,
          'IMC'=>$this->examenClinico->imc,
          'Medicación actual'=>($this->examenClinico->medicacion_actual) ? $this->examenClinico->medicacion_actual : "No posee"//$this->examenClinico->medicacion_actual,
        ],
        "CARDIOVASCULAR"=>[
          'Frecuencia cardíaca'=>$this->cardiovascular->frecuencia_cardiaca,
          'Tensión arterial'=>$this->cardiovascular->tension_arterial,
          'Pulso'=>($this->cardiovascular->pulso=="A") ? "Anormal" : "Normal",//$this->cardiovascular->pulso,
          'Várices'=>$this->cardiovascular->observacion_varices,
        ],
        "PIEL"=>[
          'Cicatrices patológicas visibles'=>$this->piel->observacion1_piel,
          'Vesícula'=>$this->piel->obs_vesicula,
          'Ulceras'=>$this->piel->obs_ulceras,
          'Fisuras'=>$this->piel->obs_fisuras,
          'Prurito'=>$this->piel->obs_prurito,
          'Eczemas'=>$this->piel->obs_eczemas,
          'Dermatitis'=>$this->piel->obs_dertmatitis,
          'Eritemas'=>$this->piel->obs_eritemas,
          'Petequias'=>$this->piel->obs_petequias,
          'Tejido celular subcutaneo'=>$this->piel->tejido,
        ],
        "OSTEOARTICULAR"=>[
          'Limitaciones funcionales'=>$this->osteoarticular->observacion1_os,
          'Amputaciones'=>$this->osteoarticular->observacion2_os,
          'Movilidad y reflejo'=>$this->osteoarticular->observacion3_os,
          'Tonicidad y fuerza muscular normal'=>$this->osteoarticular->observacion4_os,
          'Observaciones'=>$this->osteoarticular->observacion_os,
        ],
        "COLUMNA VERTEBRAL"=>[
          'Examen normal'=>$this->columna->observacion1_col,
          'Contracturas'=>$this->columna->observacion2_col,
          'Puntos dolorosos'=>$this->columna->observacion3_col,
          'Limitaciones funcionales'=>$this->columna->observacion4_col,
          'Observaciones'=>$this->columna->observacion_col,
        ],
        "CABEZA Y CUELLO"=>[
          'Cráneo'=>$this->cabezaCuello->observacion1_cc,
          'Cara'=>$this->cabezaCuello->observacion2_cc,
          'Nariz'=>$this->cabezaCuello->observacion3_cc,
          'Oídos'=>$this->cabezaCuello->observacion4_cc,
          'Boca'=>$this->cabezaCuello->observacion5_cc,
          'Cuello y Tiroides'=>$this->cabezaCuello->observacion6_cc,
        ],
        "OFTALMOLÓGICO"=>[
          'Pupilas'=>$this->oftalmologico->observacion1_of,
          'Corneas'=>$this->oftalmologico->observacion2_of,
          'Conjuntivas'=>$this->oftalmologico->observacion3_of,
          'Visión en colores'=>$this->oftalmologico->observacion4_of,
          'Ojo derecho'=>$this->oftalmologico->observacion5_of."/10",
          'Ojo izquierdo'=>$this->oftalmologico->observacion6_of."/10",
          'Usa lentes'=>$this->oftalmologico->pregunta7_of,
          'Observaciones'=>$this->oftalmologico->observacion_of,
        ],
        "NEUROLOGICO"=>[
          'Motilidad activa'=>$this->neurologico->observacion1_neu,
          'Motilidad pasiva'=>$this->neurologico->observacion2_neu,
          'Sensibilidad'=>$this->neurologico->observacion3_neu,
          'Marcha'=>$this->neurologico->observacion4_neu,
          'Reflejos osteotendinosos'=>$this->neurologico->observacion5_neu, 
          'Pares craneales'=>$this->neurologico->observacion6_neu,
          'Taxia'=>$this->neurologico->observacion7_neu,
          'Observaciones'=>$this->neurologico->observacion_neu,
        ],
        "ODONTOLOGICO"=>[
          'Encias y mucosas'=>$this->odontologico->observacion1_od,
          'Esmalte dental'=>$this->odontologico->observacion2_od,
          'Superior'=>$this->odontologico->pregunta4_od, 
          'Inferior'=>$this->odontologico->pregunta5_od,
          'Caries'=>$this->odontologico->superior,
          'Faltan piezas dentarias'=>$this->odontologico->inferior,
          'Observaciones'=>$this->odontologico->observacion_od,
        ],
        "TORAX Y APARTO RESPIRATORIO"=>[
          'Caja torácica'=>$this->respiratorio->observacion1_re,
          'Pulmones'=>$this->respiratorio->observacion2_re,
          'COVID 19'=>$this->respiratorio->covid19,
          'Vacunas'=>$this->respiratorio->vacunado,
        ],
        "ABDOMEN"=>[
          'Forma'=>$this->abdomen->observacion1_ab,
          'Hígado'=>$this->abdomen->observacion2_ab,
          'Bazo'=>$this->abdomen->observacion3_ab,
          'Colon'=>$this->abdomen->observacion4_ab,
          'Ruidos hidroaéreos'=>$this->abdomen->observacion5_ab,
          'Puño percusión'=>$this->abdomen->observacion6_ab,
          'Cicatrices quirúrjicas'=>$this->abdomen->observacion_ab,
        ],
        "REGIONES INGUINALES"=>[
          'Tono de la pared posterior'=>$this->regionInguinal->observacion1_in,
          'Orificios superficiales'=>$this->regionInguinal->observacion2_in,
          'Orificios profundos'=>$this->regionInguinal->observacion3_in,
          'Observaciones'=>$this->regionInguinal->observacion_in,
        ],
        "GENITALES"=>[
          'Características'=>$this->genital->observacion1_ge,
          'Observaciones'=>$this->genital->observacion_ge,
        ],
        "REGIÓN ANAL"=>[
          'Características'=>$this->regionAnal->observacion1_an,
          'Observaciones'=>$this->regionAnal->observacion_an,
        ]
      ];
      //Carga de diagnostico
      $vacio = false;
      $arExcluidos=["Estatura","Peso","Ojo derecho","Ojo izquierdo","Usa lentes","Pulso","Frecuencia cardíaca"];

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
              $aux2.=$label.": Si<br>";
              $mostrarNombreSeccion=1;
            }elseif ($valor == "") {
              
            }else{
                if($label!="IMC"){
                  $aux.=$label.": <b>".$valor."</b>.<br>";
                  if($label=="Observaciones"){
                    $aux2.=$valor.".<br>";
                  }else{
                    $aux2.=$label.": ".$valor.".<br>";
                  }
                  $mostrarNombreSeccion=1;
                }

                if ($label=="Estatura") {
                    $peso=$matriz["EXAMEN CLINICO"]["Peso"];
                    $estatura=$matriz["EXAMEN CLINICO"]["Estatura"];
                    if($estatura>100){
                      $estatura/=100;
                    }
                    $imc=number_format($peso/($estatura*$estatura),2);
        
                    //Calculo de IMC
                    if ($imc >= "30") {
                      $descripcionIMC='Sobrepeso';
                    } elseif ($imc <= "18") {
                      $descripcionIMC='Muy bajo';
                    } else {
                      $descripcionIMC='Normal';
                    }
                    $mostrar_imc="IMC: ".$imc.=" (".$descripcionIMC.").<br>";
                    $aux.=$mostrar_imc;
                    $aux2.=$mostrar_imc;
        
                    /*if ($historia_clinica->examenClinico->medicacion_actual) {
                        $datosAdicionales.=" Medicación actual: ".$historia_clinica->examenClinico->medicacion_actual.". ";
                    }else {
                        $datosAdicionales.=" Medicación actual: No posee. ";
                    }*/
                }
                /*if ($voucher->historiaClinica) {
                    $estatura=$historia_clinica->examenClinico->estatura;
                    if($estatura>100){
                      $estatura/=100;
                    }
                    $peso=$historia_clinica->examenClinico->peso;
                    $imc=number_format($peso/($estatura*$estatura),2);
        
                    $datosAdicionales = "IMC: ".$imc;
                    //Calculo de IMC
                    if ($imc >= "30") {
                      $descripcionIMC='Sobrepeso';
                    } elseif ($imc <= "18") {
                      $descripcionIMC='Muy bajo';
                    } else {
                      $descripcionIMC='Normal';
                    }
                    $datosAdicionales.=" (".$descripcionIMC.").";
        
                    if ($historia_clinica->examenClinico->medicacion_actual) {
                        $datosAdicionales.=" Medicación actual: ".$historia_clinica->examenClinico->medicacion_actual.". ";
                    }else {
                        $datosAdicionales.=" Medicación actual: No posee. ";
                    }
                }*/
            }

          //}
        }
        if($mostrarNombreSeccion==1){
          //CON SALTOS DE LINEA AL FINAL
          /*$aux="<b>".$seccion."</b><br>".$aux."<br>";
          $aux2="<b>".$seccion."</b><br>".$aux2."<br>";*/
          //SIN SALTOS DE LINEA AL FINAL
          $aux="<b>".$seccion."</b><br>".$aux;
          $aux2="<b>".$seccion."</b><br>".$aux2;
        }
        //echo $aux;
        $diagnostico.=$aux;
        $obs.=$aux2;
      }
      
      /*for ($i=0; $i < sizeof($matriz[1]); $i++) {
          if ($matriz[0][$i] != null) {
              $label=$matriz[1][$i];
              if ($matriz[0][$i] == 1) {
                  $diagnostico = $diagnostico.$label."<b>Si</b>. ";
                  if(!in_array($label,$arExcluidos)){
                    $obs.=$label." Si\n";
                  }
                  $vacio = false;
              }else{
                  if ($matriz[0][$i] == "") {
                      if ($vacio) {
                          $diagnostico = $diagnostico.'Sin particularidades.';
                      }
                      $vacio = true;
                      $diagnostico = $diagnostico.$label."<b>".$matriz[0][$i]."</b>";
                      //var_dump($diagnostico);
                      
                  }else{
                      $diagnostico = $diagnostico.$label." "."<b>".$matriz[0][$i]."</b>.<br> ";
                      $cargarObs=$matriz[0][$i];
                      
                      if(!in_array($label,$arExcluidos)){
                        //$cargarObs=str_replace("<br>","",$cargarObs);
                        $obs.=$label." ".$cargarObs."\n";
                      }
                      $vacio = false;
                  }
              }
          }
      };*/
      //echo $diagnostico;
      //die();
      //dd($diagnostico,$obs);
      return [$diagnostico,$obs];

    }
}
