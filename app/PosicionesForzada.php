<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosicionesForzada extends Model
{
    public $timestamps=true;

    protected $fillable = [
        'firma',
        'codigo',
        'puesto',
        'antiguedad',
        'nroTrabajo',
        'obsrvacion3_d',
        'user_id',
        'paciente_id'
    ];


    protected $table = 'posiciones_forzadas';

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function dolor()
    {
        return $this->hasOne(Dolor::class);
    }

    public function tarea()
    {
        return $this->hasOne(Tarea::class);
    }

    public function semiologica()
    {
        return $this->hasOne(Semiologica::class);
    }

    public function generarDiagnostico()
    {
                // Generación de Diagnóstico
                /* La generación deldiagnostico se realiza cargando dos arrays, uno con las etiquetas y otro con los atributos.
                Luego se procede a cargar sólo los atributos que fueron cargados cuando se generó el formulario*/
                $matriz = [];
                $diagnostico = "";
                //Carga variables
                    $matriz[] = [       
                                        //TAREAS
                                        ' ',
                                        $this->tarea->tiempo,
                                        $this->tarea->ciclo,
                                        $this->tarea->cargas,

                                        //TIPO DE TAREAS
                                        ' ',
                                        $this->tarea->pregunta1,
                                        $this->tarea->pregunta2,
                                        $this->tarea->pregunta3,
                                        $this->tarea->pregunta4,
                                        $this->tarea->pregunta5,
                                        $this->tarea->pregunta6,
                                        $this->tarea->pregunta7,
                                        $this->tarea->pregunta8,
                                        $this->tarea->observacion_tarea,
                                        
                                        //DOLOR
                                        ' ',
                                        $this->dolor->forma,
                                        $this->dolor->evolucion,
                                        $this->dolor->pregunta1_d,
                                        $this->dolor->pregunta2_d,
                                        $this->dolor->pregunta3_d,
                                        $this->dolor->pregunta4_d,
                                        $this->dolor->pregunta5_d,
                                        $this->dolor->observacion1_d,
                                        $this->dolor->observacion2_d,
                                        
                                        //CARACTERIZACIÓN SEMIOLÓGICA
                                        ' ',
                                        $this->semiologica->grado,
                                        $this->semiologica->observacion1_s,
                                        ' ',
                                    ];
                //
                //Carga Labels
                    $matriz[] = [   
                                    '<b>TAREAS</b><br>',
                                    'Tiempo de Tarea: ',
                                    'Ciclo de trabajo: ',
                                    'Manipulación manual de cargas: ',

                                    '<br><b>TIPO DE TAREAS</b><br>',
                                    'Movimiento de alcance repetidos por encima del hombro: ',
                                    'Movimiento de extensión o flexión forzados de muñeca: ',
                                    'Flexión sostenida de columna: ',
                                    'Flexión extrema del codo: ',
                                    'El cuello se mantiene flexionado: ',
                                    'Giros de columna: ',
                                    'Rotación extrema del antebrazo: ',
                                    'Flexión mantenida de dedos: ',
                                    'Otros: ',

                                    '<br><b>DOLOR</b><br>',
                                    'Por su forma de aparición: ',
                                    'Por su evolución: ',
                                    'Calambres musculares: ',
                                    'Parestesias: ',
                                    'Calor: ',
                                    'Cambios de coloración de la piel: ',
                                    'Tumefacción: ',
                                    'Puntos dolorosos: ',
                                    'Localización: ',

                                    '<br><b>CARACTERIZACIÓN SEMIOLÓGICA</b><br>',
                                    'Grado: ',
                                    'Observación: ',
                                    ' ',
                        ];
                //
                //Carga de diagnostico
                $vacio = true;
                for ($i=0; $i < sizeof($matriz[1]); $i++) {
                    if ($matriz[0][$i] != null) {
                        if ($matriz[0][$i] == 1) {
                            $diagnostico = $diagnostico.$matriz[1][$i]."<b>Si</b>. ";
                            $vacio = false;
                        }else{
                            if ($matriz[0][$i] == " ") {
                                if ($vacio) {
                                    $diagnostico = $diagnostico.'Sin particularidades.';
                                }
                                $vacio = true;
                                $diagnostico = $diagnostico.$matriz[1][$i]."<b>".$matriz[0][$i]."</b>";
                            }else{
                                $diagnostico = $diagnostico.$matriz[1][$i]." "."<b>".$matriz[0][$i]."</b>.<br> ";
                                $vacio = false;
                            }
                        }
                    }
                };
                return $diagnostico;
            }
}
