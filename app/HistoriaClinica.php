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

    public function respitario()
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

    public function generarDiagnostico()
    {

            // Generación de Diagnóstico
            /* La generación deldiagnostico se realiza cargando dos arrays, uno con las etiquetas y otro con los atributos.
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
                                        $this->examenClinico->medicacion_actual,

                                        //Cardiovascular
                                        ' ',
                                        $this->cardiovascular->frecuencia_cardiaca,
                                        $this->cardiovascular->tension_arterial,
                                        $this->cardiovascular->pulso,
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
                                        $this->oftalmologico->observacion5_of,
                                        $this->oftalmologico->observacion6_of,
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
                                        $this->respitario->observacion1_re,
                                        $this->respitario->observacion2_re,

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
                                'Sobrepeso:',
                                'IMC: ',
                                'Medicación adicional: ',

                                '<br><b>CARDIOVASCULAR</b><br>',
                                'Fecruencia cardíaca: ',
                                'Tensión arterial:',
                                'Pulso:',
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
            //
        //
    }
}
