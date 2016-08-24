<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

//        $datos['countModelos'] = ;
        $datos['countModelosConfirmados'] = $em->getRepository('AppBundle:Modelo')->countModelos(2) + $em->getRepository('AppBundle:Modelo101B')->countModelosB(2);
        $datos['countModelosAbiertos'] = $em->getRepository('AppBundle:Modelo')->countModelos(1) + $em->getRepository('AppBundle:Modelo101B')->countModelosB(1);
        $datos['countModelosCerrados'] = $em->getRepository('AppBundle:Modelo')->countModelos(3) + $em->getRepository('AppBundle:Modelo101B')->countModelosB(3);
        $datos['countEmpresa'] = $em->getRepository('AppBundle:Empresa')->countEmpresas();
        $datos['countUsuario'] = $em->getRepository('AppBundle:Usuario')->countUsuarios();

//        return $this->render('default/index.html.twig');
        return $this->render('default/index.html.twig', array(
            'datos' => $datos,
        ));

    }


    /**
     * @Route("/login", name="login")
     *
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR,
            $session->get(SecurityContext::AUTHENTICATION_ERROR));
        return $this->render(':default:login.html.twig', array(
                'error' => $error,
                'last_username' => $session->get(SecurityContext::LAST_USERNAME)
            )
        );
    }

    /**
     * @Route("/prueba", name="prueba")
     */
    public function pruebaAction()
    {
        return $this->render('default/prueba.html.twig');
    }

    /**
     * Update a Modelo.
     *
     * @Route("/cerrar_periodo", name="cerrar_periodo")
     */
    public function cerrarPeriodoAction()
    {

        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Modelo101B')->updateModelosB();
        $em->getRepository('AppBundle:Modelo1007')->updateModelos();



        return $this->redirect($this->generateUrl('homepage'));
    }


    /**
     * Reporte empresas
     *
     * @Route("/imprimir_empresas", name="imprimir_empresas")
     */
    public function imprimirEmpresa()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Empresa')->findAll();

        return $this->render('AppBundle:Reportes:empresas.html.twig', array(
            'entities' => $entities,
            'state' => -1
        ));

    }

    /**
     * Reporte empresas
     *
     * @Route("/imprimir_usuarios", name="imprimir_usuarios")
     */
    public function imprimirUsuarioAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Usuario')->findAll();
        $grupo = $em->getRepository('AppBundle:Grupo')->findAll();

        return $this->render('AppBundle:Reportes:usuarios.html.twig', array(
            'entities' => $entities,
            'grupo' => $grupo[0],
        ));
    }

    /**
     * Reporte empresas
     *
     * @Route("/probando", name="probando")
     */
    public function probandoEmpresa()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Modelo101B')->findByEstado(2);
//    $fe = new \DateTime($entities[0]->getFecha());


//        dump( $entities[0]->getFecha()->format('m'));die;

//for($i=0;$i<5000;$i++)

        $empresas = array(10000);
        for ($i = 0; $i < 500; $i++) {
            $empresas[$i] = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        }
        $name = array();
        $indice = -1;
        $categories = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic');
//        dump($empresas);die;
        $j = 0;
        for ($i = 0; $i < count($entities); $i++) {
            // if($i == 0){
            $indice = -1;
            for ($j = 0; $j < count($name); $j++) {
                if ($entities[$i]->getUsuario()->getEmpresa()->getNombre() == $name[$j]) {
                    $indice = $j;
                }
                if ($indice == -1 && count($name) == 0) {
                    $indice = 0;

                    $name[0] = $entities[$i]->getUsuario()->getEmpresa()->getNombre();
                }
                if ($indice == -1 && count($name) > 0) {
                    $indice = count($name);
                    $flag = 0;
                    for($z=0;$z<count($name);$z++)
                    {
                        if($name[$z] == $entities[$i]->getUsuario()->getEmpresa()->getNombre()){
                            $flag = 1;
                        }
                    }
                    if($flag == 0)
                    $name[$indice] = $entities[$i]->getUsuario()->getEmpresa()->getNombre();
                }
            }
            if ($indice == -1) {
                $indice = 0;
                $name[0] = $entities[$i]->getUsuario()->getEmpresa()->getNombre();
            }

            switch ($entities[$i]->getFecha()->format('m')) {
                case '01':
                    if ($empresas[$indice][0])
                        $empresas[$indice][0] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][0] = $entities[$i]->getTVtCrEx();
                    break;
                case '02':
                    if ($empresas[$indice][1])
                        $empresas[$indice][1] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][1] = $entities[$i]->getTVtCrEx();
                    break;
                case '03':
                    if ($empresas[$indice][2])
                        $empresas[$indice][2] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][2] = $entities[$i]->getTVtCrEx();
                    break;
                case '04':
                    if ($empresas[$indice][3])
                        $empresas[$indice][3] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][3] = $entities[$i]->getTVtCrEx();
                    break;
                case '05':
                    if ($empresas[$indice][4])
                        $empresas[$indice][4] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][4] = $entities[$i]->getTVtCrEx();
                    break;
                case '06':
                    if ($empresas[$indice][5])
                        $empresas[$indice][5] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][5] = $entities[$i]->getTVtCrEx();
                    break;
                case '07':
                    if ($empresas[$indice][6])
                        $empresas[$indice][6] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][6] = $entities[$i]->getTVtCrEx();
                    break;
                case '08':
                    if ($empresas[$indice][7])
                        $empresas[$indice][7] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][7] = $entities[$i]->getTVtCrEx();
                    break;
                case '09':
                    if ($empresas[$indice][8])
                        $empresas[$indice][8] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][8] = $entities[$i]->getTVtCrEx();
                    break;
                case '10':
                    if ($empresas[$indice][9])
                        $empresas[$indice][9] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][9] = $entities[$i]->getTVtCrEx();
                    break;
                case '11':
                    if ($empresas[$indice][10])
                        $empresas[$indice][10] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][10] = $entities[$i]->getTVtCrEx();
                    break;
                case '12':
                    if ($empresas[$indice][11])
                        $empresas[$indice][11] += $entities[$i]->getTVtCrEx();
                    else
                        $empresas[$indice][11] = $entities[$i]->getTVtCrEx();
                    break;
                // }

            }

        }
//        dump($name);die;
        //T_VT_CR_EX


//    $impression = array(12, 25, 100, 58, 63, 30, 5, 40, 91, 10, 50, 36);
//    $click = array(6, 12, 40, 28, 31, 15, 2, 20, 45, 5, 25, 18);
//    $empresas[0] = $impression;
//    $empresas[1] = $click;
//    $name[0] = 'Copextel';
//    $name[1] = 'UCI';

        $graph_data = array('categories' => $categories, 'empresas' => $empresas, 'name' => $name);

        echo json_encode($graph_data);
        exit;
    }

    /**
     * Reporte modelo101b
     *
     * @Route("/imprimir_cmodelo101b", name="imprimir_cmodelo101b")
     */
    public function imprimirAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = null;
        if ($this->getUser()->getGrupo())
            $entities = $em->getRepository('AppBundle:Modelo101b')->modelosConsolidado(2, -1);
        else
            $entities = $em->getRepository('AppBundle:Modelo101b')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());
//        $result = $entities->toArray();
//        dump($entities);die;
        $data = array();
        $data['extNoVen'] = 0;
        $data['ext060'] = 0;
        $data['ext6190'] = 0;
        $data['extMas90'] = 0;
        $data['extTotVe'] = 0;
        $data['extEfecto'] = 0;
        $data['litJudE'] = 0;
        $data['litProtE'] = 0;
        $data['sentPentE'] = 0;
        $data['tVtCrEx'] = 0;
        $data['contravalor'] = 0;
        for ($i = 0; $i < count($entities); $i++) {

            $data['extNoVen'] += $entities[$i]->getExtNoVen();
            $data['ext060'] += $entities[$i]->getExt060();
            $data['ext6190'] += $entities[$i]->getExt6190();
            $data['extMas90'] += $entities[$i]->getExtMas90();
            $data['extTotVe'] += $entities[$i]->getExtTotVe();
            $data['extEfecto'] += $entities[$i]->getExtEfecto();
            $data['litJudE'] += $entities[$i]->getLitJudE();
            $data['litProtE'] += $entities[$i]->getLitProtE();
            $data['sentPentE'] += $entities[$i]->getSentPentE();
            $data['tVtCrEx'] += $entities[$i]->getTVtCrEx();
            $data['contravalor'] += $entities[$i]->getContravalor();
        }
        return $this->render('AppBundle:Reportes:modelo101b.html.twig', array(
            'entities' => $entities,
            'data' => $data,
        ));
    }

    /**
     * Reporte modelo1006
     *
     * @Route("/imprimir_cmodelo1006", name="imprimir_cmodelo1006")
     */
    public function imprimirModelo1006Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //dump($request->get('mes'));die;
//$request->get('mes');
        $entities = null;
        if ($this->getUser()->getGrupo())
            $entities = $em->getRepository('AppBundle:Modelo1006')->modelosConsolidado(2, -1);
        else
            $entities = $em->getRepository('AppBundle:Modelo1006')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());
//        $result = $entities->toArray();
//        dump($entities);die;
        $data = array();
        $data['impPrincipal'] = 0;
        $data['princiVdo'] = 0;
        $data['impIntcov'] = 0;
        $data['impIntmor'] = 0;

        for ($i = 0; $i < count($entities); $i++) {

            $data['impPrincipal'] += $entities[$i]->getImpPrincipal();
            $data['princiVdo'] += $entities[$i]->getPrinciVdo();
            $data['impIntcov'] += $entities[$i]->getImpIntcov();
            $data['impIntmor'] += $entities[$i]->getImpIntmor();

        }
        return $this->render('AppBundle:Reportes:modelo1006.html.twig', array(
            'entities' => $entities,
            'data' => $data,
            'mes' => -1,
        ));
    }

    /**
     * Reporte modelo1007
     *
     * @Route("/imprimir_cmodelo1007", name="imprimir_cmodelo1007")
     */
    public function imprimirModelo1007Action()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = null;
        if ($this->getUser()->getGrupo())
            $entities = $em->getRepository('AppBundle:Modelo1007')->modelosConsolidado(2, -1);
        else
            $entities = $em->getRepository('AppBundle:Modelo1007')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());
//        $result = $entities->toArray();
//        dump($entities);die;
        $data = array();
        $data['impNfrec'] = 0;
        $data['impTotpr'] = 0;
        $data['impIntcmv'] = 0;
        $data['princiVdo'] = 0;
        $data['impIntcmn'] = 0;
        $data['impIntpv'] = 0;

        for ($i = 0; $i < count($entities); $i++) {

            $data['impNfrec'] += $entities[$i]->getImpNfrec();
            $data['impTotpr'] += $entities[$i]->getImpTotpr();
            $data['impIntcmv'] += $entities[$i]->getImpIntcmv();
            $data['princiVdo'] += $entities[$i]->getPrinciVdo();
            $data['impIntcmn'] += $entities[$i]->getImpIntcmn();
            $data['impIntpv'] += $entities[$i]->getImpIntpv();

        }
        return $this->render('AppBundle:Reportes:modelo1007.html.twig', array(
            'entities' => $entities,
            'data' => $data,
            'mes' => -1
        ));
    }

    /**
     *
     * @Route("/imprimir_excel_cmodelo101b", name="imprimir_excel_cmodelo101b")
     */
    public function imprimirExcelAction(Request $request)
    {
//      dump($request->get('mes'));die;


        $em = $this->getDoctrine()->getManager();
        $entities = null;
        if ($this->getUser()->getGrupo())
            $entities = $em->getRepository('AppBundle:Modelo101b')->modelosConsolidado(2, -1);
        else
            $entities = $em->getRepository('AppBundle:Modelo101b')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());
//        dump($entities[0]->getFecha()->format('m'));die;

        $grupo = $em->getRepository('AppBundle:Grupo')->findAll();

        $phpExcelObject = $this->excelGeneral();

        //llenar los datos con el resultado de la base de datos
        $indice = 14;
        $sumA = '=SUM(A14:';

        for ($i = 0; $i < count($entities); $i++) {
            if (($entities[$i]->getFecha()->format('m') == $request->get('mes')) || $request->get('mes') == '13') {


                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . $indice, $entities[$i]->getUsuario()->getEmpresa()->getCodigo())
                    ->setCellValue('B' . $indice, $entities[$i]->getUsuario()->getEmpresa()->getNombre())
                    ->setCellValue('C' . $indice, $entities[$i]->getExtNoVen())
                    ->setCellValue('D' . $indice, $entities[$i]->getExt060())
                    ->setCellValue('E' . $indice, $entities[$i]->getExt6190())
                    ->setCellValue('F' . $indice, $entities[$i]->getExtMas90())
                    ->setCellValue('G' . $indice, $entities[$i]->getExtTotVe())
                    ->setCellValue('H' . $indice, $entities[$i]->getExtEfecto())
                    ->setCellValue('I' . $indice, $entities[$i]->getLitJudE())
                    ->setCellValue('J' . $indice, $entities[$i]->getLitProtE())
                    ->setCellValue('K' . $indice, $entities[$i]->getSentPentE())
                    ->setCellValue('L' . $indice, $entities[$i]->getTVtCrEx())
                    ->setCellValue('M' . $indice, $entities[$i]->getContravalor());

                foreach (range('A', 'M') as $column) {
                    if ($column > 'B') {
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('99FFFF');
                    }


                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');
                }
                $phpExcelObject->getActiveSheet()->getStyle('G' . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                $phpExcelObject->getActiveSheet()->getStyle('G' . $indice)->getFill()->getStartColor()->setRGB('66CC66');

                $indice++;


            }
        }
        //valores fijos en el excel
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('B' . $indice, 'TOTAL')
            ->setCellValue('C' . $indice, '=SUM(C14:C' . ($indice - 1) . ')')
            ->setCellValue('D' . $indice, '=SUM(D14:D' . ($indice - 1) . ')')
            ->setCellValue('E' . $indice, '=SUM(E14:E' . ($indice - 1) . ')')
            ->setCellValue('F' . $indice, '=SUM(F14:F' . ($indice - 1) . ')')
            ->setCellValue('G' . $indice, '=SUM(G14:G' . ($indice - 1) . ')')
            ->setCellValue('H' . $indice, '=SUM(H14:H' . ($indice - 1) . ')')
            ->setCellValue('I' . $indice, '=SUM(I14:I' . ($indice - 1) . ')')
            ->setCellValue('J' . $indice, '=SUM(J14:J' . ($indice - 1) . ')')
            ->setCellValue('K' . $indice, '=SUM(K14:K' . ($indice - 1) . ')')
            ->setCellValue('L' . $indice, '=SUM(L14:L' . ($indice - 1) . ')')
            ->setCellValue('M' . $indice, '=SUM(M14:M' . ($indice - 1) . ')')
            ->setCellValue('A10', 'CUENTAS POR COBRAR EN CUC en el exterior ')
            ->setCellValue('A7', 'MES')
            ->setCellValue('B7', date('d/m/Y'))
            ->setCellValue('A11', 'Modelo: 101B  UM /MILES SIN DECIMAL')
            ->setCellValue('A13', 'COD_ONE')
            ->setCellValue('B13', 'NOM ENTIDAD')
            ->setCellValue('C13', 'EXT_NO_VEN')
            ->setCellValue('D13', 'EXT_0_60')
            ->setCellValue('E13', 'EXT_61_90')
            ->setCellValue('F13', 'EXT_MAS90')
            ->setCellValue('G13', 'EXT_TOT_VE')
            ->setCellValue('H13', 'EXT_EFECTO')
            ->setCellValue('I13', 'LIT_JUD_E')
            ->setCellValue('J13', 'LIT_PROT_E')
            ->setCellValue('K13', 'SENT_PEN_E')
            ->setCellValue('L13', 'T_VT_CR_EX')
            ->setCellValue('M13', 'Contravalor ')
            ->setCellValue('A' . ($indice + 2), 'Confeccionado por: ' . $this->getUser()->getName());

        if ($this->getUser()->getGrupo()) {
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $grupo[0]->getFirma1())
                ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $grupo[0]->getFirma2());
        } else {
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $this->getUser()->getEmpresa()->getFirma1())
                ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $this->getUser()->getEmpresa()->getFirma2());
        }

        //unir celdas
        $phpExcelObject->setActiveSheetIndex(0)
            ->mergeCells('A10:D10')
            ->mergeCells('A11:D11')
            ->mergeCells('A' . ($indice + 2) . ':C' . ($indice + 2))
            ->mergeCells('D' . ($indice + 2) . ':F' . ($indice + 2))
            ->mergeCells('G' . ($indice + 2) . ':I' . ($indice + 2))
            ->mergeCells('A' . ($indice + 3) . ':C' . ($indice + 3))
            ->mergeCells('D' . ($indice + 3) . ':F' . ($indice + 3))
            ->mergeCells('G' . ($indice + 3) . ':I' . ($indice + 3));
        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');

        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
        //estilos de celdas

//Preferencias de color de relleno de celda

        foreach (range('A', 'M') as $column) {
            if ($column > 'B') {
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('66CC66');
            }
            $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension($column)->setWidth(15);

            //El establecimiento de marcos
            $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getBorders()->getAllBorders()->getColor()->setRGB('000000');

            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');

        }

        $phpExcelObject->getActiveSheet()->getStyle('G13')->getFont()->getColor()->setRGB('FF0000');

        $phpExcelObject->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('A10')->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('A11')->getFont()->setBold(true);

        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getFont()->setBold(true);
        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getFont()->setBold(true);


//Establecer la alineación
        $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $phpExcelObject->getActiveSheet()->getStyle('A10')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $phpExcelObject->getActiveSheet()->getStyle('A11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        return $this->exportarExcel($phpExcelObject, 'modelo101b');


    }

    public function exportarExcel($phpExcelObject, $fileName)
    {

        //Añadir una imagen
        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('ZealImg');
        $objDrawing->setDescription('Image inserted by Zeal');
        $directorioDestino = __DIR__ . '/../../../web/uploads/logo.png';
        $objDrawing->setPath($directorioDestino);
        $objDrawing->setHeight(100);
//        $objDrawing->setHeight(200);
        if ($fileName == "empresas")

            $objDrawing->setCoordinates('A1');
        else
            $objDrawing->setCoordinates('E1');
        $objDrawing->setOffsetX(10);
        $objDrawing->setRotation(15);
        $objDrawing->getShadow()->setVisible(true);
        $objDrawing->getShadow()->setDirection(36);
        $objDrawing->setWorksheet($phpExcelObject->getActiveSheet());

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        $writer->save($fileName . '.xls');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment;filename=stream-file.xls');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');

        return $response;
    }

    public function excelGeneral()
    {
        //propiedades generales del documento excel
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        //Worksheet estilo predeterminado (de forma predeterminada diferentes necesidades y Preferencias Configurar individualmente)
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->getFont()->setName('Arial');
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8);
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->getAlignment();
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $phpExcelObject->getActiveSheet()->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $phpExcelObject->getActiveSheet()->calculateColumnWidths();
        $phpExcelObject->getActiveSheet()->setTitle('Simple');

        $phpExcelObject->getProperties()->setCreator("Grupo empresarial")
            ->setLastModifiedBy("Administrador")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        return $phpExcelObject;
    }

    /**
     *
     * @Route("/imprimir_excel_cmodelo1006", name="imprimir_excel_cmodelo1006")
     */
    public function imprimirExcel1006Action(Request $request)
    {

//      dump($request->get('mes'));die;

        if ($request->get('option') == 2) {


            $em = $this->getDoctrine()->getManager();
            //dump($request->get('mes'));die;
//$request->get('mes');
            $entities = null;
            if ($this->getUser()->getGrupo())
                $entities = $em->getRepository('AppBundle:Modelo1006')->modelosConsolidado(2, -1);
            else
                $entities = $em->getRepository('AppBundle:Modelo1006')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());
//        $result = $entities->toArray();
//        dump($entities);die;
            $data = array();
            $data['impPrincipal'] = 0;
            $data['princiVdo'] = 0;
            $data['impIntcov'] = 0;
            $data['impIntmor'] = 0;
            $result = array();
$r = 0;
            for ($i = 0; $i < count($entities); $i++)
                if (($entities[$i]->getModelo()->getFecha()->format('m') == $request->get('mes')) || $request->get('mes') == '13')
                    $result[$r++] = $entities[$i];



            for ($i = 0; $i < count($result); $i++) {

                $data['impPrincipal'] += $result[$i]->getImpPrincipal();
                $data['princiVdo'] += $result[$i]->getPrinciVdo();
                $data['impIntcov'] += $result[$i]->getImpIntcov();
                $data['impIntmor'] += $result[$i]->getImpIntmor();

            }
            return $this->render('AppBundle:Reportes:modelo1006.html.twig', array(
                'entities' => $result,
                'data' => $data,
                'mes' => $request->get('mes')
            ));


        } else {


            $em = $this->getDoctrine()->getManager();
            $entities = null;
            if ($this->getUser()->getGrupo())
                $entities = $em->getRepository('AppBundle:Modelo1006')->modelosConsolidado(2, -1);
            else
                $entities = $em->getRepository('AppBundle:Modelo1006')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());

            $grupo = $em->getRepository('AppBundle:Grupo')->findAll();

            $phpExcelObject = $this->excelGeneral();
            //llenar los datos con el resultado de la base de datos
            $indice = 14;
            $sumA = '=SUM(A14:';

            for ($i = 0; $i < count($entities); $i++) {
                if (($entities[$i]->getModelo()->getFecha()->format('m') == $request->get('mes')) || $request->get('mes') == '13') {


                    $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A' . $indice, $entities[$i]->getModelo()->getUsuario()->getEmpresa()->getCodigo())
                        ->setCellValue('B' . $indice, $entities[$i]->getModelo()->getUsuario()->getEmpresa()->getNombre())
                        ->setCellValue('C' . $indice, $entities[$i]->getContrato())
                        ->setCellValue('D' . $indice, '490')
                        ->setCellValue('E' . $indice, $entities[$i]->getPrestamista())
                        ->setCellValue('F' . $indice, $entities[$i]->getPais())
                        ->setCellValue('G' . $indice, $entities[$i]->getTermino())
                        ->setCellValue('H' . $indice, $entities[$i]->getMoneda())
                        ->setCellValue('I' . $indice, $entities[$i]->getImpPrincipal())
                        ->setCellValue('J' . $indice, $entities[$i]->getAPago())
                        ->setCellValue('K' . $indice, $entities[$i]->getPrinciVdo())
                        ->setCellValue('L' . $indice, $entities[$i]->getImpIntcov())
                        ->setCellValue('M' . $indice, $entities[$i]->getImpIntmor());

                    foreach (range('A', 'M') as $column) {
                        if ($column > 'B') {
                            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('99FFFF');
                        }


                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');
                    }
//                $phpExcelObject->getActiveSheet()->getStyle('G' . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
//                $phpExcelObject->getActiveSheet()->getStyle('G' . $indice)->getFill()->getStartColor()->setRGB('66CC66');

                    $indice++;


                }
            }
            //valores fijos en el excel
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('H' . $indice, 'TOTAL')
                ->setCellValue('I' . $indice, '=SUM(I14:I' . ($indice - 1) . ')')
                ->setCellValue('K' . $indice, '=SUM(K14:K' . ($indice - 1) . ')')
                ->setCellValue('L' . $indice, '=SUM(L14:L' . ($indice - 1) . ')')
                ->setCellValue('M' . $indice, '=SUM(M14:M' . ($indice - 1) . ')')
                ->setCellValue('A9', 'COD_MODELO')
                ->setCellValue('B9', '1006')
                ->setCellValue('A10', 'COD_INSTIT')
                ->setCellValue('B10', '161')
                ->setCellValue('A7', 'MES:')
                ->setCellValue('B7', date('d/m/Y'))
                ->setCellValue('A11', 'Modelo: 1006  UM /MILES SIN DECIMAL')
                ->setCellValue('A13', 'COD_ONE')
                ->setCellValue('B13', 'NOM ENTIDAD')
                ->setCellValue('C13', 'NUM_CONTRA')
                ->setCellValue('D13', 'COD_INDIC')
                ->setCellValue('E13', 'PRESTAMISTA')
                ->setCellValue('F13', 'COD_PAIS')
                ->setCellValue('G13', 'TERMINO')
                ->setCellValue('H13', 'SIG_MONEDA')
                ->setCellValue('I13', 'IMP_PRINCI')
                ->setCellValue('J13', 'A_PAGO')
                ->setCellValue('K13', 'PRINCI_VDO')
                ->setCellValue('L13', 'IMP_INTCOV')
                ->setCellValue('M13', 'IMP_INTMOR')
                ->setCellValue('A' . ($indice + 2), 'Confeccionado por: ' . $this->getUser()->getName())
//            ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $grupo[0]->getFirma1())
//            ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $grupo[0]->getFirma2())
            ;
            if ($this->getUser()->getGrupo()) {
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $grupo[0]->getFirma1())
                    ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $grupo[0]->getFirma2());
            } else {
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $this->getUser()->getEmpresa()->getFirma1())
                    ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $this->getUser()->getEmpresa()->getFirma2());
            }

            //unir celdas
            $phpExcelObject->setActiveSheetIndex(0)
//            ->mergeCells('A10:D10')
                ->mergeCells('A11:D11')
                ->mergeCells('A' . ($indice + 2) . ':C' . ($indice + 2))
                ->mergeCells('D' . ($indice + 2) . ':F' . ($indice + 2))
                ->mergeCells('G' . ($indice + 2) . ':I' . ($indice + 2))
                ->mergeCells('A' . ($indice + 3) . ':C' . ($indice + 3))
                ->mergeCells('D' . ($indice + 3) . ':F' . ($indice + 3))
                ->mergeCells('G' . ($indice + 3) . ':I' . ($indice + 3));
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');

            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
//        //estilos de celdas
//
//Preferencias de color de relleno de celda

            foreach (range('A', 'M') as $column) {
                if ($column > 'B') {
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('66CC66');
                }
                $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getFont()->setBold(true);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFont()->setBold(true);
                $phpExcelObject->getActiveSheet()->getColumnDimension($column)->setWidth(15);

                //El establecimiento de marcos
                $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getBorders()->getAllBorders()->getColor()->setRGB('000000');

                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');

            }
//
//        $phpExcelObject->getActiveSheet()->getStyle('G13')->getFont()->getColor()->setRGB('FF0000');

            $phpExcelObject->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('A10')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('A11')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('B10')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('B9')->getFont()->setBold(true);

            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getFont()->setBold(true);

//
//Establecer la alineación
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('A10')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//        $phpExcelObject->getActiveSheet()->getStyle('A11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            return $this->exportarExcel($phpExcelObject, 'modelo1006');


        }
    }


    /**
     *
     * @Route("/imprimir_excel_cmodelo1007", name="imprimir_excel_cmodelo1007")
     */
    public function imprimirExcel1007Action(Request $request)
    {

        if ($request->get('option') == 2) {
            $em = $this->getDoctrine()->getManager();
            $entities = null;
            if ($this->getUser()->getGrupo())
                $entities = $em->getRepository('AppBundle:Modelo1007')->modelosConsolidado(2, -1);
            else
                $entities = $em->getRepository('AppBundle:Modelo1007')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());
//        $result = $entities->toArray();
//        dump($entities);die;
            $data = array();
            $data['impNfrec'] = 0;
            $data['impTotpr'] = 0;
            $data['impIntcmv'] = 0;
            $data['princiVdo'] = 0;
            $data['impIntcmn'] = 0;
            $data['impIntpv'] = 0;
            $result = array();
            $r = 0;
            for ($i = 0; $i < count($entities); $i++)
                if (($entities[$i]->getModelo()->getFecha()->format('m') == $request->get('mes')) || $request->get('mes') == '13')
                    $result[$r++] = $entities[$i];

            for ($i = 0; $i < count($result); $i++) {

                $data['impNfrec'] += $result[$i]->getImpNfrec();
                $data['impTotpr'] += $result[$i]->getImpTotpr();
                $data['impIntcmv'] += $result[$i]->getImpIntcmv();
                $data['princiVdo'] += $result[$i]->getPrinciVdo();
                $data['impIntcmn'] += $result[$i]->getImpIntcmn();
                $data['impIntpv'] += $result[$i]->getImpIntpv();

            }
            return $this->render('AppBundle:Reportes:modelo1007.html.twig', array(
                'entities' => $result,
                'data' => $data,
                'mes' => $request->get('mes')
            ));
        } else {

            $em = $this->getDoctrine()->getManager();
            $entities = null;
            if ($this->getUser()->getGrupo())
                $entities = $em->getRepository('AppBundle:Modelo1007')->modelosConsolidado(2, -1);
            else
                $entities = $em->getRepository('AppBundle:Modelo1007')->modelosConsolidado(2, $this->getUser()->getEmpresa()->getId());
            $grupo = $em->getRepository('AppBundle:Grupo')->findAll();

            $phpExcelObject = $this->excelGeneral();
            //llenar los datos con el resultado de la base de datos
            $indice = 14;
            $sumA = '=SUM(A14:';

            for ($i = 0; $i < count($entities); $i++) {
                if (($entities[$i]->getModelo()->getFecha()->format('m') == $request->get('mes')) || $request->get('mes') == '13') {
                    $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A' . $indice, $entities[$i]->getModelo()->getUsuario()->getEmpresa()->getCodigo())
                        ->setCellValue('B' . $indice, $entities[$i]->getModelo()->getUsuario()->getEmpresa()->getNombre())
                        ->setCellValue('C' . $indice, $entities[$i]->getContrato())
                        ->setCellValue('D' . $indice, '490')
                        ->setCellValue('E' . $indice, $entities[$i]->getPrestamista())
                        ->setCellValue('F' . $indice, $entities[$i]->getPais())
                        ->setCellValue('G' . $indice, $entities[$i]->getMoneda())
                        ->setCellValue('H' . $indice, $entities[$i]->getImpNfrec())
                        ->setCellValue('I' . $indice, $entities[$i]->getTermino())
                        ->setCellValue('J' . $indice, $entities[$i]->getImpTotpr())
                        ->setCellValue('K' . $indice, $entities[$i]->getImpIntcmv())
                        ->setCellValue('L' . $indice, $entities[$i]->getPrinciVdo())
                        ->setCellValue('M' . $indice, $entities[$i]->getImpIntcmn())
                        ->setCellValue('N' . $indice, $entities[$i]->getImpIntpv());

                    foreach (range('A', 'N') as $column) {
                        if ($column > 'B') {
                            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('99FFFF');
                        }
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');
                    }
                    $indice++;
                }
            }
            //valores fijos en el excel
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('G' . $indice, 'TOTAL')
                ->setCellValue('H' . $indice, '=SUM(H14:H' . ($indice - 1) . ')')
                ->setCellValue('J' . $indice, '=SUM(J14:J' . ($indice - 1) . ')')
                ->setCellValue('K' . $indice, '=SUM(K14:K' . ($indice - 1) . ')')
                ->setCellValue('L' . $indice, '=SUM(L14:L' . ($indice - 1) . ')')
                ->setCellValue('M' . $indice, '=SUM(M14:M' . ($indice - 1) . ')')
                ->setCellValue('N' . $indice, '=SUM(N14:N' . ($indice - 1) . ')')
                ->setCellValue('A9', 'COD_MODELO')
                ->setCellValue('B9', '1007')
                ->setCellValue('A10', 'COD_INSTIT')
                ->setCellValue('B10', '161')
                ->setCellValue('A7', 'MES:')
                ->setCellValue('B7', date('d/m/Y'))
                ->setCellValue('A11', 'Modelo: 1007  UM /MILES SIN DECIMAL')
                ->setCellValue('A13', 'COD_ONE')
                ->setCellValue('B13', 'NOM ENTIDAD')
                ->setCellValue('C13', 'NUM_CONTRA')
                ->setCellValue('D13', 'COD_INDIC')
                ->setCellValue('E13', 'PRESTAMISTA')
                ->setCellValue('F13', 'COD_PAIS')
                ->setCellValue('G13', 'SIG_MONEDA')
                ->setCellValue('H13', 'IMP_NFREC')
                ->setCellValue('I13', 'TERMINO')
                ->setCellValue('J13', 'IMP_TOTPR')
                ->setCellValue('K13', 'IMP_INTCMV')
                ->setCellValue('L13', 'PRINCI_VDO')
                ->setCellValue('M13', 'IMP_INTCMN')
                ->setCellValue('N13', 'IMP_INTPV')
                ->setCellValue('A' . ($indice + 2), 'Confeccionado por: ' . $this->getUser()->getName())
//            ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $grupo[0]->getFirma1())
//            ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $grupo[0]->getFirma2())
            ;
            if ($this->getUser()->getGrupo()) {
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $grupo[0]->getFirma1())
                    ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $grupo[0]->getFirma2());
            } else {
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('D' . ($indice + 2), 'Revisado por: ' . $this->getUser()->getEmpresa()->getFirma1())
                    ->setCellValue('G' . ($indice + 2), 'Aprobado por: ' . $this->getUser()->getEmpresa()->getFirma2());
            }
            //unir celdas
            $phpExcelObject->setActiveSheetIndex(0)
                ->mergeCells('A11:D11')
                ->mergeCells('A' . ($indice + 2) . ':C' . ($indice + 2))
                ->mergeCells('D' . ($indice + 2) . ':F' . ($indice + 2))
                ->mergeCells('G' . ($indice + 2) . ':I' . ($indice + 2))
                ->mergeCells('A' . ($indice + 3) . ':C' . ($indice + 3))
                ->mergeCells('D' . ($indice + 3) . ':F' . ($indice + 3))
                ->mergeCells('G' . ($indice + 3) . ':I' . ($indice + 3));
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_MEDIUM);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getAllBorders()->getColor()->setRGB('000000');

            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 3))->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_NONE);

//        estilos de celdas

            foreach (range('A', 'N') as $column) {
                if ($column > 'B') {
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('66CC66');
                }
                $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getFont()->setBold(true);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFont()->setBold(true);
                $phpExcelObject->getActiveSheet()->getColumnDimension($column)->setWidth(15);

                //El establecimiento de marcos
                $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $phpExcelObject->getActiveSheet()->getStyle($column . '13')->getBorders()->getAllBorders()->getColor()->setRGB('000000');

                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');

            }

            $phpExcelObject->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('A10')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('A11')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('B10')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('B9')->getFont()->setBold(true);

            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getFont()->setBold(true);

//Establecer la alineación
            $phpExcelObject->getActiveSheet()->getStyle('A' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('D' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('G' . ($indice + 2))->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('A10')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcelObject->getActiveSheet()->getStyle('A11')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            return $this->exportarExcel($phpExcelObject, 'modelo1007');


        }
    }

    /**
     *
     * @Route("/imprimir_excel_empresas", name="imprimir_excel_empresas")
     */
    public function imprimirExcelEmpresasAction(Request $request)
    {
        if ($request->get('option') == 2) {
            $par = -1;
            if($request->get('state') == 1)
                $par = 1;
            if($request->get('state') == 2)
                $par = 0;
            $em = $this->getDoctrine()->getManager();
if($request->get('state') == 2 || $request->get('state') == 1)
            $entities = $em->getRepository('AppBundle:Empresa')->findByEstado($par);
            else
                $entities = $em->getRepository('AppBundle:Empresa')->findAll();

            return $this->render('AppBundle:Reportes:empresas.html.twig', array(
                'entities' => $entities,
                'state' => $request->get('state')
            ));
        }else{ $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('AppBundle:Empresa')->findAll();
//dump($entities);die;
            $state = 3;
            $nameEmpresa = "Listado de empresas";
            if ($request->get('state') == 1) {
                $state = true;
                $nameEmpresa = "Listado de empresas activas";
            }
            if ($request->get('state') == 2) {
                $state = false;
                $nameEmpresa = "Listado de empresas inactivas";
            }
            $phpExcelObject = $this->excelGeneral();
            //llenar los datos con el resultado de la base de datos
            $indice = 13;

            for ($i = 0; $i < count($entities); $i++) {
                if (($entities[$i]->getEstado() == $state) || ($request->get('state') == '3')) {
                    $phpExcelObject->setActiveSheetIndex(0)
                        ->setCellValue('A' . $indice, $entities[$i]->getNombre())
                        ->setCellValue('B' . $indice, $entities[$i]->getCodigo())
                        ->setCellValue('C' . $indice, $entities[$i]->getTelefono())
                        ->setCellValue('D' . $indice, $entities[$i]->getDireccion());

                    foreach (range('A', 'D') as $column) {
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('99FFFF');

                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                        $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');
                    }
                    $indice++;
                }
            }

            //valores fijos en el excel
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('A8', 'MES:')
                ->setCellValue('B8', date('d/m/Y'))
                ->setCellValue('A9', $nameEmpresa)
                ->setCellValue('A12', 'NOMBRE')
                ->setCellValue('B12', 'CODIGO')
                ->setCellValue('C12', 'TELEFONO')
                ->setCellValue('D12', 'DIRECCION');
            //unir celdas
            $phpExcelObject->setActiveSheetIndex(0)
                ->mergeCells('A9:D9');

            foreach (range('A', 'D') as $column) {
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('66CC66');

                $phpExcelObject->getActiveSheet()->getStyle($column . '12')->getFont()->setBold(true);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFont()->setBold(true);
                $phpExcelObject->getActiveSheet()->getColumnDimension($column)->setWidth(15);

                //El establecimiento de marcos
                $phpExcelObject->getActiveSheet()->getStyle($column . '12')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $phpExcelObject->getActiveSheet()->getStyle($column . '12')->getBorders()->getAllBorders()->getColor()->setRGB('000000');

                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');

            }

            $phpExcelObject->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);

//Establecer la alineación

            $phpExcelObject->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

            return $this->exportarExcel($phpExcelObject, 'empresas');

        }





    }

    /**
     *
     * @Route("/imprimir_excel_usuarios", name="imprimir_excel_usuarios")
     */
    public function imprimirExcelUsuariosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AppBundle:Usuario')->findAll();
        $grupo = $em->getRepository('AppBundle:Grupo')->findAll();
        $nameEmpresa = "Listado de usuarios";

        $phpExcelObject = $this->excelGeneral();
        //llenar los datos con el resultado de la base de datos
        $indice = 13;

        for ($i = 0; $i < count($entities); $i++) {
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . $indice, $entities[$i]->getName())
                    ->setCellValue('B' . $indice, $entities[$i]->getUsuario());
            if($entities[$i]->getRole() == 'ROLE_SUPER')
                $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C' . $indice, 'Super Administrador');
            else if($entities[$i]->getRole() == 'ROLE_ADMIN')
                $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C' . $indice, 'Administrador');
            else if($entities[$i]->getRole() == 'ROLE_CLIENTE')
                $phpExcelObject->setActiveSheetIndex(0)->setCellValue('C' . $indice, 'Cliente');
            if($entities[$i]->getGrupo())
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('D' . $indice, $grupo[0]->getNombre());
            else
                $phpExcelObject->setActiveSheetIndex(0)->setCellValue('D' . $indice, $entities[$i]->getEmpresa()->getNombre());

                foreach (range('A', 'D') as $column) {
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('99FFFF');

                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');
                }
                $indice++;

        }

        //valores fijos en el excel
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A8', 'MES:')
            ->setCellValue('B8', date('d/m/Y'))
            ->setCellValue('A9', $nameEmpresa)
            ->setCellValue('A12', 'NOMBRE')
            ->setCellValue('B12', 'USUARIO')
            ->setCellValue('C12', 'ROL')
            ->setCellValue('D12', 'EMPRESA');
        //unir celdas
        $phpExcelObject->setActiveSheetIndex(0)
            ->mergeCells('A9:D9');

        foreach (range('A', 'D') as $column) {
            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFill()->getStartColor()->setRGB('66CC66');

            $phpExcelObject->getActiveSheet()->getStyle($column . '12')->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getFont()->setBold(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension($column)->setWidth(15);

            //El establecimiento de marcos
            $phpExcelObject->getActiveSheet()->getStyle($column . '12')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $phpExcelObject->getActiveSheet()->getStyle($column . '12')->getBorders()->getAllBorders()->getColor()->setRGB('000000');

            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $phpExcelObject->getActiveSheet()->getStyle($column . $indice)->getBorders()->getAllBorders()->getColor()->setRGB('000000');

        }

        $phpExcelObject->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);

//Establecer la alineación

        $phpExcelObject->getActiveSheet()->getStyle('A9')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        return $this->exportarExcel($phpExcelObject, 'empresas');


    }


}
