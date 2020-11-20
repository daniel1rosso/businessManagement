<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genera_pdf extends MY_Controller {

    public function pdf_ficha_medica($idPasajero = null) {  
        //-- INFO USUARIO --//
        //$userdata = $this->session->all_userdata();
        
        //-- ERRORES --/
        $errores = array(
            "1" => "SESION FINALIZADA",
            "2" => "ACCESO DENEGADO"
        );
        
        //-- VALIDACIONES --//
        /*if(!$this->is_login() || $userdata['idNivel'] != 6) {			
            echo $errores[1];
        }else{
            if($userdata['idPasajero']!=$idPasajero){
                echo $errores[2];
            }else{*/
                //--- DATOS PASAJERO y FICHA MEDICA ---//
                $result = $this->app_model->get_pasajero_by_id2($idPasajero);   
                $result1 = $this->app_model->actualizo_impresa_ficha_medica($idPasajero);   
                
                //-- CONFIG VARIABLES --//
                    //-- FECHAS -//
                    $dateFechaNac = date_create($result[0]['fechaNacimiento']);
                    $fechaNac = date_format($dateFechaNac, 'd/m/Y');
                    $edad = -(date_format($dateFechaNac, 'Y')-date("Y"));
                    
                    $dateFechaNacPadre = date_create($result[0]['fechaPadre']);
                    $fechaNacPadre = date_format($dateFechaNacPadre, 'd/m/Y');
                
                    $dateFechaNacContac = date_create($result[0]['fechaContact1']);
                    $fechaNacContac = '';
                    //$fechaNacContac = date_format($dateFechaNacContac, 'd/m/Y');
                    
                    //-- ENFERMEDADES --//
                    $sarampion = ($result[0]['sarampion']==1) ? 'SI' : 'NO';
                    $rubeola = ($result[0]['rubeola']==1) ? 'SI' : 'NO';
                    $menonucleosis = ($result[0]['menonucleosis']==1) ? 'SI' : 'NO';
                    $enuresis = ($result[0]['enuresis']==1) ? 'SI' : 'NO';
                    $asma = ($result[0]['asma']==1) ? 'SI' : 'NO';
                    $desmayos = ($result[0]['desmayos']==1) ? 'SI' : 'NO';
                    $bronquitis = ($result[0]['bronquitis']==1) ? 'SI' : 'NO';
                    $hepatitis = ($result[0]['hepatitis']==1) ? 'SI' : 'NO';
                    $poliomelitis = ($result[0]['poliomelitis']==1) ? 'SI' : 'NO';
                    $tetanos = ($result[0]['tetanos']==1) ? 'SI' : 'NO';
                    $meningitis = ($result[0]['meningitis']==1) ? 'SI' : 'NO';
                    $hidatidosis = ($result[0]['hidatidosis']==1) ? 'SI' : 'NO';
                    $epilepsia = ($result[0]['epilepsia']==1) ? 'SI' : 'NO';
                    $brucelosis = ($result[0]['brucelosis']==1) ? 'SI' : 'NO';
                    $colecistitis = ($result[0]['colecistitis']==1) ? 'SI' : 'NO';
                    $nefritis = ($result[0]['nefritis']==1) ? 'SI' : 'NO';
                    $parasitointestinal = ($result[0]['parasitointestinal']==1) ? 'SI' : 'NO';
                    $paperas = ($result[0]['paperas']==1) ? 'SI' : 'NO';
                    $afeccNariz = ($result[0]['afeccNariz']==1) ? 'SI' : 'NO';
                    $varicela = ($result[0]['varicela']==1) ? 'SI' : 'NO';
                    $afeccOjos = ($result[0]['afeccOjos']==1) ? 'SI' : 'NO';
                    $resfrios = ($result[0]['resfrios']==1) ? 'SI' : 'NO';
                    $otitis = ($result[0]['otitis']==1) ? 'SI' : 'NO';
                    $diabetes = ($result[0]['diabetes']==1) ? 'SI' : 'NO';
                    $anginas = ($result[0]['anginas']==1) ? 'SI' : 'NO';
                    $convulsiones = ($result[0]['convulsiones']==1) ? 'SI' : 'NO';
                    $fiebreReumaticas = ($result[0]['fiebreReumaticas']==1) ? 'SI' : 'NO';
                    $eurinarias = ($result[0]['eurinarias']==1) ? 'SI' : 'NO';
                    $pulmonia = ($result[0]['pulmonia']==1) ? 'SI' : 'NO';
                    $epistaxis = ($result[0]['epistaxis']==1) ? 'SI' : 'NO';
                    $preurecia = ($result[0]['preurecia']==1) ? 'SI' : 'NO';
                    $tifoidea = ($result[0]['tifoidea']==1) ? 'SI' : 'NO';
                    $bocio = ($result[0]['bocio']==1) ? 'SI' : 'NO';
                    $ulcera = ($result[0]['ulcera']==1) ? 'SI' : 'NO';
                    $celiaco = ($result[0]['celiaco']==1) ? 'SI' : 'NO';//NUEVO
                    $otrasEnfermedades = (!empty($result[0]['otrasEnfermedades'])) ? $result[0]['otrasEnfermedades'] : '-';
                    
                    //-- ALERGIAS --//
                    $medicamentos = ($result[0]['medicamentos']==1) ? 'SI' : 'NO';
                    $comidas = ($result[0]['comidas']==1) ? 'SI' : 'NO';//SACAR
                    $antibioticos = ($result[0]['antibioticos']==1) ? 'SI' : 'NO';//SACAR
                    $insectos = ($result[0]['insectos']==1) ? 'SI' : 'NO';//NUEVO
                    $alimentos = ($result[0]['alimentos']==1) ? 'SI' : 'NO';//NUEVO
                    
                    //-- INTERVENCIONES QUIRURGICAS --//
                    $apendicitis = ($result[0]['apendicitis']==1) ? 'SI' : 'NO';
                    $amigdalas = ($result[0]['amigdalas']==1) ? 'SI' : 'NO';
                    $hernia = ($result[0]['hernia']==1) ? 'SI' : 'NO';
                    $otrasOperaciones = (!empty($result[0]['otrasOperaciones'])) ? $result[0]['otrasOperaciones'] : '-';
                    
                    //-- VACUNAS --//
                    $antitetanica = ($result[0]['antitetanica']==1) ? 'SI '.$result[0]['mesAntitetanica']."/".$result[0]['anioAntitetanica'] : 'NO';
                    $antidifterica = ($result[0]['antidifterica']==1) ? 'SI '.$result[0]['mesAntidifterica']."/".$result[0]['anioAntidifterica'] : 'NO';
                    $antivariolica = ($result[0]['antivariolica']==1) ? 'SI' : 'NO';//SACAR
                    $antiturberculosa = ($result[0]['antiturberculosa']==1) ? 'SI '.$result[0]['mesAntiturberculosa']."/".$result[0]['anioAntiturberculosa'] : 'NO';
                    $antipoliomelitica  = ($result[0]['antipoliomelitica']==1) ? 'SI '.$result[0]['mesAntipoliomelitica']."/".$result[0]['anioAntipoliomelitica'] : 'NO';
                    $antisaranpionosa  = ($result[0]['antisaranpionosa']==1) ? 'SI '.$result[0]['mesAntisaranpionosa']."/".$result[0]['anioAntisaranpionosa'] : 'NO';
                    
                    //-- DATOS EXTRAS --//
                    $lentesContacto = ($result[0]['lentesContacto']==1) ? 'SI' : 'NO';
                    $tomaAlcohol = ($result[0]['tomaAlcohol']==1) ? 'SI' : 'NO';
                    $fuma = ($result[0]['fuma']==1) ? 'SI' : 'NO';
                    $protesisDentaria = ($result[0]['protesisDentaria']==1) ? 'SI' : 'NO';
                    $afeccionesOdontologicas  = ($result[0]['afeccionesOdontologicas']==1) ? 'SI' : 'NO';
                    $partoNormal  = ($result[0]['partoNormal']==1) ? 'SI' : 'NO';//SACAR
                    
                //-- CARGO LIBRERIAS --//
                $this->load->library('fpdf/fpdf');
                $this->load->library('fpdi/fpdi');

                //-- INICIAR FPDI --//
                $pdf = new FPDI();

                //-- ESTABLECER EL ARCHIVO DE ORIGEN --//
                $pdf->setSourceFile('assets/pdf/Entretur_FichaMedica.pdf');        

                //-- PRIMER PAGINA --//
                $pdf->AddPage();
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0, 210);

                    //-- UBICACION DE DATOS Y PROPIEDADES DEL TEXTO --//
                    $pdf->SetFont('Arial');
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFontSize(10);      
                    
                    //--CABECERA--//
                        //-- N CONTRATO --//
                        $pdf->SetXY(118, 25.4);
                        $pdf->Write(0, $result[0]['nroContrato']);   

                    //-- DATOS PERSONALES --//
                        //-- FOTO PERFIL --//
                        if($result[0]['foto']){
                            $pdf->Image('uploads/pasajero/'.$result[0]['foto'] , 176 ,7,25,26);
                        }
                        
                        //-- NOMBRE --//
                        $pdf->SetXY(10, 72);
                        $pdf->Write(0, utf8_decode($result[0]['apellido'])." ".utf8_decode($result[0]['nombre']));

                        //-- FECHA NAC --//
                        $pdf->SetXY(44, 81.5);
                        $pdf->Write(0, $fechaNac);  
                        
                        //-- EDAD --//
                        $pdf->SetXY(20, 86);
                        $pdf->Write(0, $edad);                       
 
                        //-- TELEFONO --//
                        $pdf->SetXY(86, 82);
                        $pdf->Write(0, $result[0]['caracteristicaTel'].' '.$result[0]['numeroTel']); 

                        //-- CELULAR --//
                        $pdf->SetXY(84, 86.5);
                        $pdf->Write(0, $result[0]['caracteristicaCel'].' '.$result[0]['numeroCel']);                         
 
                        //-- DNI --/
                        $pdf->SetXY(18, 77);
                        $pdf->Write(0, $result[0]['dni']);

                        //-- LOCALIDAD --//
                        $pdf->SetXY(88, 77);
                        $pdf->Write(0, utf8_decode($result[0]['localidad']));              
 
                        //-- DIRECCION --//
                        $pdf->SetXY(88, 72.5);
                        $pdf->Write(0, utf8_decode($result[0]['direccion']));    
                        
                    //-- COLEGIO --//
                        //-- NOMBRE --/
                        $pdf->SetXY(10, 57.5);
                        $pdf->Write(0, utf8_decode($result[0]['nombreColegio']));
                        
                        //-- PROVINCIA --/
                        //$pdf->SetXY(101, 57.5);
                        //$pdf->Write(0, utf8_decode($result[0]['provinciaColegio']));
                        
                        //-- LOCALIDAD --/
                        $pdf->SetXY(87.5, 58);
                        $pdf->Write(0, utf8_decode($result[0]['localidadColegio']));
                        
                        //-- CURSO --/
                        $pdf->SetXY(147, 58);
                        $pdf->Write(0, utf8_decode($result[0]['curso']));
                        
                        //-- DIVISION --/
                        $pdf->SetXY(167, 58);
                        $pdf->Write(0, utf8_decode($result[0]['division']));
                        
                        //-- TURNO --/
                        $pdf->SetXY(185, 58);
                        $pdf->Write(0, utf8_decode($result[0]['turno']));
                        
                    //-- COBERTURA MEDICA --//
                        //-- OBRA SOCIAL --/
                        $pdf->SetXY(31, 152.5);
                        $pdf->Write(0, utf8_decode($result[0]['obraSocial']));
                        
                        //-- TEL. URGENCIA --/
                        $pdf->SetXY(44, 157);
                        $pdf->Write(0, $result[0]['caracteristicaTelContac1'].' '.$result[0]['numeroTelContact1']);
                        
                        //-- NUM. AFILIADO --/
                        $pdf->SetXY(123,152.5 );
                        $pdf->Write(0, $result[0]['nroAfiliado']);
                        
                        //-- MEDICO DE CABECERA --/
                        $pdf->SetXY(133, 157);
                        $pdf->Write(0, utf8_decode($result[0]['nombApellMed']));
                       
                    //-- DATOS PADRE/TUTOR --//
                        //-- NOMBRE TUTOR --/
                        $pdf->SetXY(42, 103);
                        $pdf->Write(0, utf8_decode($result[0]['apellidoPadre'])." ".utf8_decode($result[0]['nombrePadre']));
                        
                        //-- CELULAR --/
                        $pdf->SetXY(118, 112);
                        $pdf->Write(0, $result[0]['caracteristicaCelPadre'].' '.$result[0]['numeroCelPadre']);
                        
                        //-- TELEFONO --/
                        $pdf->SetXY(121, 107.5);
                        $pdf->Write(0, $result[0]['caracteristicaTelPadre'].' '.$result[0]['numeroTelPadre']);
                        
                        //-- FECHA NAC --/
                        $pdf->SetXY(45, 107.5);
                        $pdf->Write(0, $fechaNacPadre);
   
                        //-- DIRECCION --/
                        $pdf->SetXY(123, 103);
                        $pdf->Write(0, utf8_decode($result[0]['direccionPadre']));
                        
                        //-- LOCALIDAD --/
                        $pdf->SetXY(29, 112);
                        $pdf->Write(0, utf8_decode($result[0]['localidadPadre']));
                        
                        //-- CP --/
                        //$pdf->SetXY(113, 137);
                        //$pdf->Write(0, "");

                    //-- CONTACTO URGENCIA --//
                        //-- NOMBRE --/
                        $pdf->SetXY(41, 127.5);
                        $pdf->Write(0, utf8_decode($result[0]['apellidoContac1'])." ".utf8_decode($result[0]['nombreContac1']));

                        //-- CELULAR --/
                        $pdf->SetXY(24, 132.5);
                        $pdf->Write(0, $result[0]['caracteristicaCelContact1'].' '.$result[0]['numeroCelContact1']);                        

                        //-- FECHA NAC --/
                        //$pdf->SetXY(48, 167);
                        //$pdf->Write(0, $fechaNacContac);                        
                        
                        //-- TELEFONO --/
                        $pdf->SetXY(26, 136.5);
                        $pdf->Write(0, $result[0]['caracteristicaTelContac1'].' '.$result[0]['numeroTelContact1']);

                        //-- DIRECCION --/
                        $pdf->SetXY(124, 162);
                        $pdf->Write(0, utf8_decode($result[0]['direccionContac1'])); 
                        
                    //-- ENFERMEDADES --//
                        //-- PRIMER COLUMNA --//
                        $pdf->SetXY(42, 172.5);
                        $pdf->Write(0, $sarampion); 
                        
                        $pdf->SetXY(42, 177);
                        $pdf->Write(0, $ulcera);                         
                        
                        $pdf->SetXY(42, 186.5);
                        $pdf->Write(0,  $rubeola); 
                        
                        $pdf->SetXY(42, 181.5);
                        $pdf->Write(0, $menonucleosis);
                        
                        $pdf->SetXY(42, 195.5);
                        $pdf->Write(0, $enuresis); 
                        
                        $pdf->SetXY(42, 191);
                        $pdf->Write(0, $asma); 
                        
                        $pdf->SetXY(42, 204.5);
                        $pdf->Write(0, $desmayos); 
                        
                        $pdf->SetXY(42, 200.5);
                        $pdf->Write(0, $bronquitis); 
                        
                        $pdf->SetXY(42, 214);
                        $pdf->Write(0, $hepatitis); 
                        
                        $pdf->SetXY(42, 209.5);
                        $pdf->Write(0, $poliomelitis); 
                        
                        $pdf->SetXY(42, 219);
                        $pdf->Write(0, $meningitis);
                        
                        $pdf->SetXY(42, 223);
                        $pdf->Write(0, $bocio);                         
                        
                        //-- SEGUNDA COLUMNA --//
                        $pdf->SetXY(112, 172.5);
                        $pdf->Write(0, $tetanos); 
                        
                        $pdf->SetXY(112, 177);
                        $pdf->Write(0, $epilepsia); 
                        
                        $pdf->SetXY(112, 181.5);
                        $pdf->Write(0, $hidatidosis);   
                        
                        $pdf->SetXY(112, 186.5);
                        $pdf->Write(0, $colecistitis);                         
                        
                        $pdf->SetXY(112, 191);
                        $pdf->Write(0, $brucelosis); 
                        
                        $pdf->SetXY(112, 204.5);
                        $pdf->Write(0, $nefritis); 
                        
                        $pdf->SetXY(112, 195.5);
                        $pdf->Write(0, $parasitointestinal); 
                        
                        $pdf->SetXY(112, 200.5);
                        $pdf->Write(0, $celiaco); 
                        
                        $pdf->SetXY(112, 209.5);
                        $pdf->Write(0, $paperas); 
                        
                        $pdf->SetXY(112, 214);
                        $pdf->Write(0, $afeccNariz); 
                        
                        $pdf->SetXY(112, 219);
                        $pdf->Write(0, $varicela);  
                        
                        $pdf->SetXY(112, 223);
                        $pdf->Write(0, $tifoidea);                         
 
                        
                        //-- TERCERA COLUMNA --//
                        $pdf->SetXY(180, 172.5);
                        $pdf->Write(0, $afeccOjos);

                        $pdf->SetXY(180, 177);
                        $pdf->Write(0, $resfrios);                        
                        
                        $pdf->SetXY(180, 191);
                        $pdf->Write(0, $anginas); 

                        $pdf->SetXY(180, 181.5);
                        $pdf->Write(0, $otitis);
                        
                        $pdf->SetXY(180, 186.5);
                        $pdf->Write(0, $diabetes);                        
                        
                        $pdf->SetXY(180, 195.5);
                        $pdf->Write(0, $convulsiones); 
                        
                        $pdf->SetXY(180, 200.5);
                        $pdf->Write(0, $fiebreReumaticas); 
                        
                        $pdf->SetXY(180, 204.5);
                        $pdf->Write(0, $eurinarias); 
                        
                        $pdf->SetXY(180, 209.5);
                        $pdf->Write(0, $pulmonia); 
                        
                        $pdf->SetXY(180, 214);
                        $pdf->Write(0, $epistaxis); 
                        
                        $pdf->SetXY(180, 219);
                        $pdf->Write(0, $preurecia);                    
                        
                        
                        $pdf->SetXY(10, 232);
                        $pdf->Write(0, $otrasEnfermedades); 
                        
                //-- Footer Datos --//
                        //-- NOMBRE COMPLETO--//
                        $pdf->SetXY(17, 252);
                        $pdf->Write(0, utf8_decode($result[0]['apellido'])." ".utf8_decode($result[0]['nombre']));

                        //-- DNI --//
                        $pdf->SetXY(27, 259);
                        $pdf->Write(0, $result[0]['dni']);
                        
                        //-- N CONTRATO --//
                        $pdf->SetXY(41, 265);
                        $pdf->Write(0, $result[0]['nroContrato']);                        
                        
                        
                //-- SEGUNDA PAGINA --//
                $pdf->AddPage();
                $tplIdx = $pdf->importPage(2);
                $pdf->useTemplate($tplIdx, 0, 0, 210);	
                    
                    //-- UBICACION DE DATOS Y PROPIEDADES DEL TEXTO --//
                    $pdf->SetFont('Arial');
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFontSize(10);            

                    //-- ALERGIAS --//
                    $pdf->SetXY(34, 62);
                    $pdf->Write(0, $medicamentos);  
                
                    $pdf->SetXY(34, 66.5);
                    $pdf->Write(0, $insectos);  
                    
                    $pdf->SetXY(34, 71.5);
                    $pdf->Write(0, $alimentos);  
                    
                    $pdf->SetXY(22, 75);
                    $pdf->Write(0, utf8_decode($result[0]['otrasAlergias']));
                    
                    //-- INTERVENCIONES QUIRURGICAS --//
                    $pdf->SetXY(29, 31);
                    $pdf->Write(0, $apendicitis);  
               
                    $pdf->SetXY(29, 35.5);
                    $pdf->Write(0, $amigdalas);  
               
                    $pdf->SetXY(29, 40);
                    $pdf->Write(0, $hernia);  
                    
                    $pdf->SetXY(23, 44);
                    $pdf->Write(0, $otrasOperaciones);  
                    
                    //-- VACUNAS --//
                    $pdf->SetXY(31, 93.5);
                    $pdf->Write(0, $antitetanica);  
                    
                    //$pdf->SetXY(33, 84);
                    //$pdf->Write(0, $antivariolica);  
                    
                    $pdf->SetXY(49, 107);
                    $pdf->Write(0, $antipoliomelitica);  
 
                    $pdf->SetXY(31, 98);
                    $pdf->Write(0, $antidifterica);  
                    
                    $pdf->SetXY(47, 102.5);
                    $pdf->Write(0, $antiturberculosa);  
                    
                    $pdf->SetXY(57, 111.5);
                    $pdf->Write(0, $antisaranpionosa); 
 
                    //-- DATOS EXTRAS --//
                        //-- GRUPO --//
                        $pdf->SetXY(39, 130);
                        $pdf->Write(0, utf8_decode($result[0]['grupoSanguineo'])); 
                        //-- FACTOR --//
                        $pdf->SetXY(23, 134.5);
                        $pdf->Write(0, utf8_decode($result[0]['factor'])); 
                        
                        //-- PROTESIS --//
                        $pdf->SetXY(114, 134.5);
                        $pdf->Write(0, $protesisDentaria); 
                        
                        //-- FUMA --//
                        $pdf->SetXY(93, 130);
                        $pdf->Write(0, $fuma); 
                        
                        //-- PARTO --//
                        //$pdf->SetXY(52, 128);
                        //$pdf->Write(0, $partoNormal); 

                        //-- ALTURA --//
                        $pdf->SetXY(22, 139.5);
                        $pdf->Write(0, $result[0]['altura']); 

                        //-- PESO --//
                        $pdf->SetXY(21, 144);
                        $pdf->Write(0, $result[0]['peso']); 

                        //-- LENTES --//
                        $pdf->SetXY(114, 144);
                        $pdf->Write(0, $lentesContacto); 

                        //-- ALCOHOL --//
                        $pdf->SetXY(105, 139.5);
                        $pdf->Write(0, $tomaAlcohol); 

                        //-- AFECCIONES --//
                        $pdf->SetXY(171, 130);
                        $pdf->Write(0, $afeccionesOdontologicas);                     

                        //-- AGREGADOS ALERGIA --//
                        //$pdf->SetXY(11, 140);
                        //$pdf->Write(0, utf8_decode($result[0]['detallesAlergias'])."-detall aler"); 

                        //-- DETALLE DATOS EXTRAS --//
                        $pdf->SetXY(11, 152.5);
                        $pdf->Write(0, utf8_decode($result[0]['detalleMedicamentos']));  
                        //-- CERTIFICO QUE --//
                            //-- NOMBRE COMPLETO --//
                            $pdf->SetXY(52, 203.5);
                            $pdf->Write(0, utf8_decode($result[0]['nombre']).' '.utf8_decode($result[0]['apellido']));                        
                
                    //-- BOX DATOS --//     

                        //-- NOMBRE COMPLETO --//
                        $pdf->SetXY(26.5, 252);
                        $pdf->Write(0, utf8_decode($result[0]['nombre']).' '.utf8_decode($result[0]['apellido']));
                        
                        
                        //-- DNI --//
                        $pdf->SetXY(37, 259);
                        $pdf->Write(0, $result[0]['dni']);
                        
                        //-- N CONTRATO --//
                        $pdf->SetXY(50, 265);
                        $pdf->Write(0, $result[0]['nroContrato']);
                        
                //-- MUESTRO PDF --//
                $pdf->Output();        
            }
        //}
    //}
    
    public function pdf_marbete($idPasajero = null) {  
        //-- INFO USUARIO --//
        $userdata = $this->session->all_userdata();
        
        //-- ERRORES --/
        $errores = array(
            "1" => "SESION FINALIZADA",
            "2" => "ACCESO DENEGADO"
        );
        
        //-- VALIDACIONES --//
        if(!$this->is_login() || $userdata['idNivel'] != 6) {			
            echo $errores[1];
        }else{
            if($userdata['idPasajero']!=$idPasajero){
                echo $errores[2];
            }else{
                //--- DATOS PASAJERO ---//
                $result = $this->app_model->get_pasajero_by_id2($idPasajero);   
                
                //-- CARGO LIBRERIAS --//
                $this->load->library('fpdf/fpdf');
                $this->load->library('fpdi/fpdi');

                //-- INICIAR FPDI --//
                $pdf = new FPDI();

                //-- ESTABLECER EL ARCHIVO DE ORIGEN --//
                $pdf->setSourceFile('assets/pdf/Entretur_Marbete.pdf');        

                //-- PRIMER PAGINA --//
                $pdf->AddPage();
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0, 210);

                    //-- UBICACION DE DATOS Y PROPIEDADES DEL TEXTO --//
                    $pdf->SetFont('Arial');
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFontSize(12);            

                    //-- DATOS MARBETE --//
                        $pdf->RotatedText(133,44,$result[0]['nroContrato'],180);
                        $pdf->RotatedText(133,63,$result[0]['nombreColegio'],180);
                        $pdf->RotatedText(133,82,$result[0]['dni'],180);
                        $pdf->RotatedText(133,101,$result[0]['apellido']." ".$result[0]['nombre'],180);

                        $pdf->SetXY(75, 195);
                        $pdf->Write(0,$result[0]['apellido']." ".$result[0]['nombre']);
                        
                        $pdf->SetXY(75, 214);
                        $pdf->Write(0,$result[0]['dni']);
                       
                        $pdf->SetXY(75, 233);
                        $pdf->Write(0,$result[0]['nombreColegio']);
                        
                        $pdf->SetXY(75, 252);
                        $pdf->Write(0,$result[0]['nroContrato']);
                //-- MUESTRO PDF --//
                $pdf->Output();        
            }
        }
    }  
  
    public function pdf_pulseras() {  
        //-- INFO USUARIO --//
        $userdata = $this->session->all_userdata();
        
        //-- ERRORES --/
        $errores = array(
            "1" => "SESION FINALIZADA",
            "2" => "ACCESO DENEGADO"
        );
        
        //-- VALIDACIONES --//
        if(!$this->is_login()) {			
            echo $errores[1];
        }else{
            if($userdata['idNivel'] == 6){
                echo $errores[2];
            }else{
                //-- CARGO LIBRERIAS --//
                $this->load->library('fpdf/fpdf');
                $this->load->library('fpdi/fpdi');
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');                
                
                //-- INICIAR FPDI --//
                $pdf = new FPDI();

                //--- GENERO BARCODE ---//
                for ($i = 1; $i <= 10; $i++) {
                    /*
                        $uniqid = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                        $numeroPulsera = substr($uniqid, 0, 5);
                        $barcode = Zend_Barcode::factory(
                            'code128', 
                            'image', 
                            array(
                                'text' => $numeroPulsera, 
                                'barHeight'=>100, 
                                'barThinWidth'=>3, 
                                'barThickWidth'=>3, 
                                'font'=>5, 
                                'fontSize'=>15, 
                                'factor'=>1,
                                'withBorder'=>true,
                                'withQuietZones'=>true,
                            ), 
                            array(
                                'imageType' => 'png'
                            )
                        );
                        imagepng($barcode->draw(), './uploads/codigos/barcode_'.$numeroPulsera.'.png');  
                        $arrayPulsera[$i] = $numeroPulsera;
                    */
                    
                    //$uniqid = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                    $uniqid = uniqid(mt_rand(), true);
                    $numeroPulsera = substr($uniqid, 0, 5);                    
                    
                    //cargamos la librería	
                    $this->load->library('ciqrcode');
                    //configuraciones
                    $params['data'] = $numeroPulsera;
                    $params['level'] = 'H';
                    $params['size'] = 10;
                    //carpeta
                    $params['savename'] = './uploads/codigos/barcode_'.$numeroPulsera.'.png';
                    //genero el código qr
                    $this->ciqrcode->generate($params); 

                    $arrayPulsera[$i] = $numeroPulsera;                    
                }
                //-- ESTABLECER EL ARCHIVO DE ORIGEN --//
                $pdf->setSourceFile('assets/pdf/Pulseras.pdf');        

                //-- PRIMER PAGINA --//
                $pdf->AddPage();
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0, 210);

                    //-- UBICACION DE DATOS Y PROPIEDADES DEL TEXTO --//
                    $pdf->SetFont('Arial');
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFontSize(12);            

                    //-- DATOS PULSERA --//
                        $pdf->RotatedText(18,140,$arrayPulsera[1],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[1].'.png',4,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',4,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',4,235,0,17,90);

                        $pdf->RotatedText(38,140,$arrayPulsera[2],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[2].'.png',24,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',24,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',24,235,0,17,90);

                        $pdf->RotatedText(59,140,$arrayPulsera[3],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[3].'.png',45,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',45,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',45,235,0,17,90);

                        $pdf->RotatedText(80,140,$arrayPulsera[4],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[4].'.png',66,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',66,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',66,235,0,17,90);

                        $pdf->RotatedText(100,140,$arrayPulsera[5],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[5].'.png',86,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',86,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',86,235,0,17,90);

                        $pdf->RotatedText(121,140,$arrayPulsera[6],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[6].'.png',107,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',107,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',107,235,0,17,90);

                        $pdf->RotatedText(141,140,$arrayPulsera[7],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[7].'.png',127,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',127,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',127,235,0,17,90);

                        $pdf->RotatedText(162,140,$arrayPulsera[8],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[8].'.png',148,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',148,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',148,235,0,17,90);

                        $pdf->RotatedText(182,140,$arrayPulsera[9],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[9].'.png',168,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',168,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',168,235,0,17,90);

                        $pdf->RotatedText(203,140,$arrayPulsera[10],180);
                        $pdf->RotatedImage('./uploads/codigos/barcode_'.$arrayPulsera[10].'.png',189,163,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_entretur.png',189,250,0,17,90);
                        $pdf->RotatedImage('./uploads/logo/logo_pulsera.png',189,235,0,17,90);
                        
                //-- MUESTRO PDF --//
                $pdf->Output();                                
            }
        }
    }     
    
    public function pdf_grilla_pulseras() {  
        //-- INFO USUARIO --//
        $userdata = $this->session->all_userdata();
        
        //-- ERRORES --/
        $errores = array(
            "1" => "SESION FINALIZADA",
            "2" => "ACCESO DENEGADO"
        );
        
        //-- VALIDACIONES --//
        if(!$this->is_login()) {			
            echo $errores[1];
        }else{
            if($userdata['idNivel'] == 6){
                echo $errores[2];
            }else{
                //-- CARGO LIBRERIAS --//
                $this->load->library('html2pdf');
                
                $this->html2pdf->folder('./uploads/pulseras/');
                $this->html2pdf->filename('pulseras.pdf');
                $this->html2pdf->paper('a4', 'portrait');
                
                $this->html2pdf->html('
                    <table  style="height: 963.779528px; margin-left:-30px;margin-top:25px;">
                        <tbody>
                            <tr>
                                <td style="width: 71.811024px;border:1px solid;">
                                   
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>    
                                
                                <td style="width: 71.811024px;border:1px solid;">
                                </td>    
                            </tr>
                        </tbody>
                    </table>
                ');
                
                $this->html2pdf->create('save');                   
            }
        }
    }   
    //public function ingreso_cuenta_corriente($codPulseraPasajero,$importe,$selectOperacion,$saldo) {  
    public function ingreso_cuenta_corriente($codPulseraPasajero,$importe,$selectOperacion,$saldo) {  
        //-- INFO USUARIO --//
        //$userdata = $this->session->all_userdata();

        //$codPulseraPasajero=25689;
        //$importe=300;
        //$selectOperacion="egreso";
        //$saldo=5410;
        
        if(!empty($codPulseraPasajero)){
        //Traigo el idPasajero por el codigo de pulsera para verificar que tenga registros en cuentas corrientes
        $result = $this->app_model->get_pasajero_by_codPulsera($codPulseraPasajero);
        
                    
                //-- CARGO LIBRERIAS --//
                $this->load->library('fpdf/fpdf');
                $this->load->library('fpdi/fpdi');

                //-- INICIAR FPDI --//
                $pdf = new FPDI();
                if ($selectOperacion == "ingreso"){
                    //-- ESTABLECER EL ARCHIVO DE ORIGEN --//
                    $pdf->setSourceFile('assets/pdf/Ingreso_Entretur.pdf'); 
                    $saldo = $saldo+$importe;
                }else{
                    //-- ESTABLECER EL ARCHIVO DE ORIGEN --//
                    $pdf->setSourceFile('assets/pdf/Egreso_Entretur.pdf'); 
                    $saldo = $saldo-$importe;
                }
      

                //-- PRIMER PAGINA --//
                $pdf->AddPage();
                $tplIdx = $pdf->importPage(1);
                $pdf->useTemplate($tplIdx, 0, 0, 210);

                    //-- UBICACION DE DATOS Y PROPIEDADES DEL TEXTO --//
                    $pdf->SetFont('Arial');
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFontSize(10);      
                    
                    //--TICKET--//
                        //-- Fecha  --//
                            //-- Dia  --//
                        $pdf->SetXY(75, 25.5);
                        $pdf->Write(0, date('d'));  
                        
                        $pdf->SetXY(158.5, 25.5);
                        $pdf->Write(0, date('d'));  
                            //-- Mes  --//
                        $pdf->SetXY(81.5, 25.5);
                        $pdf->Write(0, date('m'));  
                        
                        $pdf->SetXY(164.5, 25.5);
                        $pdf->Write(0, date('m'));                        
                            //-- Anio  --//
                        $pdf->SetXY(88.5, 25.5);
                        $pdf->Write(0, date('y'));  
                        
                        $pdf->SetXY(171.5, 25.5);
                        $pdf->Write(0, date('y'));  
                        //-- Nombre  --//
                        $pdf->SetXY(50, 39);
                        $pdf->Write(0, $result[0]['nombrePas']." ".$result[0]['apellidoPas']);  
                        
                        $pdf->SetXY(132.5, 39);
                        $pdf->Write(0, $result[0]['nombrePas']." ".$result[0]['apellidoPas']);   
                        //-- N Colegio --//
                        $pdf->SetXY(41.5, 44.5);
                        $pdf->Write(0, $result[0]['nombreColegio']);  
                        
                        $pdf->SetXY(125, 44.5);
                        $pdf->Write(0, $result[0]['nombreColegio']);  
                        
                        //-- N CONTRATO --//
                        $pdf->SetXY(43, 54.5);
                        $pdf->Write(0, $result[0]['nroContrato']); 
                        
                        $pdf->SetXY(126, 54.5);
                        $pdf->Write(0, $result[0]['nroContrato']);  
                        
                        //-- Importe --//
                        $pdf->SetXY(59, 59.5);
                        $pdf->Write(0, $importe);  
                        
                        $pdf->SetXY(142, 59.5);
                        $pdf->Write(0, $importe);  
                        
                        //-- Saldo --//
                        $pdf->SetXY(81, 59.5);
                        $pdf->Write(0, '$'.' '.$saldo);  
                        
                        $pdf->SetXY(164, 59.5);
                        $pdf->Write(0, '$'.' '.$saldo);  
                        
  


                        
                        
                //-- MUESTRO PDF --//
                $pdf->Output();        
        }    
    }    
      
    
}
