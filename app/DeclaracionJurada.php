<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DeclaracionJurada extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps=true;

    protected $fillable = [
        'firma',//imagen
        'codigo',
        'personal_clinica_id',
        'voucher_id',
        'fecha_realizacion',
        'ciudad_id'];

    protected $table = 'declaracion_juradas';

    public function voucher()
    {
        return $this->belongsTo('App\Voucher');
    }

  public function personalClinica()
    {
        return $this->belongsTo('App\PersonalClinica');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    public function antecedenteFamiliar()
    {
        return $this->hasOne('App\AntecedenteFamiliar');
    }

    public function antecedentePersonal()
    {
        return $this->hasOne('App\AntecedentePersonal');
    }

    public function antecedenteMedicoInfancia()
    {
        return $this->hasOne('App\AntecedenteMedicoInfancia');
    }

    public function antecedenteReciente()
    {
        return $this->hasOne('App\AntecedenteReciente');
    }

    public function antecedenteQuirurjico()
    {
        return $this->hasOne('App\AntecedenteQuirurjico');
    }

    public function generarDiagnostico()
    {
        // Generación de Diagnóstico
            /* La generación deldiagnostico se realiza cargando dos arrays, uno con las etiquetas y otro con los atributos.
            Luego se procede a cargar sólo los atributos que fueron cargados cuando se generó el formulario*/
            $matriz = [];
            $diagnostico = "";
            //Carga variables
                $matriz[] = [       //ANTECEDENTES FAMILIARES
                                    ' ',
                                    $this->antecedenteFamiliar->su_padre_vive,
                                    $this->antecedenteFamiliar->su_madre_vive,
                                    $this->antecedenteFamiliar->cancer,
                                    $this->antecedenteFamiliar->diabetes,
                                    $this->antecedenteFamiliar->infarto,
                                    $this->antecedenteFamiliar->hipertension_Arterial,
                                    $this->antecedenteFamiliar->detalle,
                                    //ANTECEDENTES PERSONALES
                                    ' ',
                                    $this->antecedentePersonal->fuma,
                                    $this->antecedentePersonal->bebe,
                                    $this->antecedentePersonal->actividad_fisica,
                                    //ANTECEDENTES INFANCIA
                                    ' ',
                                    $this->antecedenteMedicoInfancia->sarampion,
                                    $this->antecedenteMedicoInfancia->rebeola,
                                    $this->antecedenteMedicoInfancia->epilepsia,
                                    $this->antecedenteMedicoInfancia->varicela,
                                    $this->antecedenteMedicoInfancia->parotiditis,
                                    $this->antecedenteMedicoInfancia->cefalea_prolongada,
                                    $this->antecedenteMedicoInfancia->hepatitis,
                                    $this->antecedenteMedicoInfancia->gastritis,
                                    $this->antecedenteMedicoInfancia->ulcera_gastrica,
                                    $this->antecedenteMedicoInfancia->hemorroide,
                                    $this->antecedenteMedicoInfancia->hemorragias,
                                    $this->antecedenteMedicoInfancia->neumonia,
                                    $this->antecedenteMedicoInfancia->asma,
                                    $this->antecedenteMedicoInfancia->tuberculosis,
                                    $this->antecedenteMedicoInfancia->tos_cronica,
                                    $this->antecedenteMedicoInfancia->catarro,
                                    $this->antecedenteMedicoInfancia->detalle1_m,
                                    //ANTECEDENTES RECIENTES
                                    ' ',
                                    $this->antecedenteReciente->detalle1_reciente,
                                    $this->antecedenteReciente->detalle2_reciente,
                                    $this->antecedenteReciente->detalle3_reciente,
                                    $this->antecedenteReciente->detalle4_reciente,
                                    $this->antecedenteReciente->detalle5_reciente,
                                    $this->antecedenteReciente->detalle6_reciente,
                                    $this->antecedenteReciente->detalle7_reciente,
                                    $this->antecedenteReciente->detalle8_reciente,
                                    $this->antecedenteReciente->detalle9_reciente,
                                    $this->antecedenteReciente->detalle10_reciente,
                                    $this->antecedenteReciente->detalle11_reciente,
                                    $this->antecedenteReciente->detalle12_reciente,
                                    $this->antecedenteReciente->detalle13_reciente,
                                    $this->antecedenteReciente->detalle14_reciente,
                                    //ANTECEDENTES QUIRURJICOS
                                    ' ',
                                    $this->antecedenteQuirurjico->detalle1_q,
                                    $this->antecedenteQuirurjico->detalle2_q,
                                    $this->antecedenteQuirurjico->detalle3_q,
                                    ' ',
                                ];
            //
            //Carga Labels
                $matriz[] = [  
                    '<b>ANTECEDENTES FAMILIARES (AFECCIONES DE PADRE Y/O MADRE)</b><br>',
                    'Su padre vive: ',
                    'Su madre vive: ',
                    'Cáncer: ',
                    'Diabetes: ',
                    'Infarto: ',
                    'Hipertension Arterial: ',
                    'Ingrese algún detalle: ',

                    '<br><b>ANTECEDENTES FAMILIARES</b><br>',
                    'Fuma: ',
                    'Bebe: ',
                    'Actividad física: ',

                    '<br><b>ANTECEDENTES INFANCIA</b><br>',
                    'Sarampión: ',
                    'Rubéola: ',
                    'Epilepsias: ',
                    'Varicela: ',
                    'Parotiditis: ',
                    'Cefalea prolongadas: ',
                    'Hepatítis: ',
                    'Gastrítis: ',
                    'Ulcera Gástrica: ',
                    'Hemorroides: ',
                    'Hemorragia: ',
                    'Neumonía: ',
                    'Asma: ',
                    'Tuberculosis: ',
                    'Tos Crónica: ',
                    'Catarro: ',
                    'Otras Afecciones: ',
                    
                    '<br><b>ANTECEDENTES RECIENTES</b><br>',
                    '¿Enfermedad de los ojos, oidos , nariz o garganta?',
                    '¿Mareos, desmayos, convulsiones, dolores de cabeza, parálisis o ataques, desordenes mentales o nerviosos?',
                    '¿Insuficiencia respiratoria,  ronquera persistente, tos, asma, bronquitis, enfisema, tuberculosis o enfermedad respiratoria crónica?',
                    '¿Dolor de pecho, palpitaciones, presión sanguínea, fiebre reumática, ataque al corazón u otra enfermedad del corazón o vasos sanguíneos?',
                    '¿Ictericia, hemorragia intestinal, úlcera, colitis, diverticulosis, otras enfermedades del intestino, hígado o vesícula?',
                    '¿Azúcar, sangre o pus en la orina, enfermedad del riñón, vejiga o próstata?',
                    '¿Diabetes, Tiroides u otra enfermedad endócrinas?',
                    '¿Gota, Afecciones musculares u óseas, incluidos columna, espalda o articulaciones?',
                    '¿Deformidades, rengueras o amputaciones?',
                    '¿Enfermedades de la piel?',
                    '¿Alergias, anemias u otras enfermedades de la sangre?',
                    '¿Está Ud. Actualmente bajo observación o tratamiento?',
                    '¿Ha tenido algún cambio en su peso en el último año?',
                    'HERNIA: ',
                    
                    '<br><b>ANTECEDENTES QUIRÚRJUCOS</b><br>',
                    '¿Fue intervenido/a quirúrgicamente por alguna causa?',
                    '¿Tiene pendiente alguna cirugía? Por favor detallar Diagnóstico y fecha:',
                    '¿Padece alguna otra enfermedad no especificada en el interrogatorio anterior?',
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
        //
        return $diagnostico;
    }
}
