<?php

require_once ("/web/html/classesUSAL/class_Personas.php");
require_once ("/web/html/classesUSAL/class_derechos_varios.php");
require_once ("/web/html/classesUSAL/class_alumnos.php");
require_once ("/web/html/classesUSAL/class_carreras.php");
require_once ("/web/html/classesUSAL/class_FormsSolitram.php");
require_once ("/web/html/classes/class_Session.php");
require_once ("/web/html/classes/class_files.php");

/**
 *
 * Description of FormTesoreriaSolitram
 *
 * Extension de la clase formularios . Son formularios pero con datos extras
 * que se guardan en la tabla "TESORERIA"."FORMULARIOTESORERIA"
 *
 * TABLA :
 * ID
 * IDFORMULARIO
 * FECHAVENC
 * STUDENT
 * IMPORTE
 * CONCEPTO
 * IMPORTEFT
 * IMPORTER
 * CODCOBOL
 * NRO
 *
 * @author lquiroga
 *
 */
class FormTesoreriaSolitram extends Formularios {

    // FIXME hay que comentar y cambiar las variables para que esten con minuscula
    protected $db;
    protected $FECHAVENC;
    protected $STUDENT;
    protected $IMPORTE;
    protected $IMPORTER;
    protected $CONCEPTO;
    protected $IMPORTEFT;
    protected $CODCOBOL;
    protected $NRO;
    protected $nrotramitebpmn;

    /**
     *
     * @param class_db $db
     * @param string $tipo
     * @param int $id
     */
    public function __construct($db, $tipo = null, $id = null) {
        $this->db = $db;

        $this->set_tipo_form('Formulario Tesoreria');

        // Si no hay id o y si tipo devolvemos el html del form
        if ($tipo != null && $tipo != '' && $id == null && $id == '') {

            $this->template_html($tipo);

            $this->set_descripcion($this->obtenerNombreForm($tipo));
        }

        // Si tipo es null pero id no , devolvemos los datos del form
        if (($tipo == null || $tipo == '') && ($id != null || $id != '')) {

            $parametros = array(
                $id
            );

            $query = "SELECT
				    formulariotesoreria.*,
				    formulario.*
				FROM
				    tesoreria.formulariotesoreria
				    JOIN tesoreria.formulario ON formulariotesoreria.idformulario = formulario.id
				WHERE
				    formulariotesoreria.idformulario =:id";

            $result = $this->db->query($query, true, $parametros);

            if ($result) {

                $arr_asoc = $db->fetch_array($result);

                $this->loadData($arr_asoc);
            }
        }
    }

    /**
     *
     * loadData
     * Carga propiedades del objeta que vienen desde la DB
     *
     * @param array $fila
     *        	return objet From secretaria gral
     *
     */
    public function loadData($fila) {

        // cargo utilizo el load data de la clase padre
        parent::loadData($fila);

        // $this->set_nombre_form($nombre);

        if (isset($fila['FECHAVENC'])) {
            $this->setFECHAVENC($fila['FECHAVENC']);
        }

        if (isset($fila['STUDENT'])) {
            $this->setSTUDENT($fila['STUDENT']);
        }

        if (isset($fila['IMPORTE'])) {
            $this->setIMPORTE($fila['IMPORTE']);
        }

        if (isset($fila['IMPORTER'])) {
            $this->setIMPORTER($fila['IMPORTER']);
        }

        if (isset($fila['CONCEPTO'])) {
            $this->setCONCEPTO($fila['CONCEPTO']);
        }

        if (isset($fila['IMPORTEFT'])) {
            $this->setIMPORTEFT($fila['IMPORTEFT']);
        }

        if (isset($fila['CODCOBOL'])) {
            $this->setCODCOBOL($fila['CODCOBOL']);
        }

        if (isset($fila['NRO'])) {
            $this->setNRO($fila['NRO']);
        }

        if (isset($fila['NROTRAMITEBPMN'])) {
            $this->setNrotramitebpmn($fila['NROTRAMITEBPMN']);
        }
    }

    /*
     * **********GETTERS*******************
     */

    /**
     *
     * @return class_db el dato de la variable $db
     */
    public function getDb() {
        return $this->db;
    }

    /**
     *
     * @return mixed el dato de la variable $FECHAVENC
     */
    public function getFECHAVENC() {
        return $this->FECHAVENC;
    }

    /**
     *
     * @return mixed el dato de la variable $STUDENT
     */
    public function getSTUDENT() {
        return $this->STUDENT;
    }

    /**
     *
     * @return mixed el dato de la variable $IMPORTE
     */
    public function getIMPORTE() {
        return $this->IMPORTE;
    }

    /**
     *
     * @return mixed el dato de la variable $IMPORTER
     */
    public function getIMPORTER() {
        return $this->IMPORTER;
    }

    /**
     *
     * @return mixed el dato de la variable $CONCEPTO
     */
    public function getCONCEPTO() {
        return $this->CONCEPTO;
    }

    /**
     *
     * @return mixed el dato de la variable $IMPORTEFT
     */
    public function getIMPORTEFT() {
        return $this->IMPORTEFT;
    }

    /**
     *
     * @return mixed el dato de la variable $CODCOBOL
     */
    public function getCODCOBOL() {
        return $this->CODCOBOL;
    }

    /**
     *
     * @return mixed el dato de la variable $NRO
     */
    public function getNRO() {
        return $this->NRO;
    }

    /**
     *
     * @return mixed el dato de la variable nrotramitebpmn
     */
    public function getNrotramitebpmn() {
        return $this->nrotramitebpmn;
    }

    /*
     * **********SETTERS*******************
     */

    /**
     *
     * @param
     *        	Ambigous <class_db, unknown> a cargar en la variable $db
     */
    public function setDb($db) {
        $this->db = $db;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $FECHAVENC
     */
    public function setFECHAVENC($FECHAVENC) {
        $this->FECHAVENC = $FECHAVENC;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $STUDENT
     */
    public function setSTUDENT($STUDENT) {
        $this->STUDENT = $STUDENT;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $IMPORTE
     */
    public function setIMPORTE($IMPORTE) {
        $this->IMPORTE = $IMPORTE;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $IMPORTER
     */
    public function setIMPORTER($IMPORTER) {
        $this->IMPORTER = $IMPORTER;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $CONCEPTO
     */
    public function setCONCEPTO($CONCEPTO) {
        $this->CONCEPTO = $CONCEPTO;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $IMPORTEFT
     */
    public function setIMPORTEFT($IMPORTEFT) {
        $this->IMPORTEFT = $IMPORTEFT;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $CODCOBOL
     */
    public function setCODCOBOL($CODCOBOL) {
        $this->CODCOBOL = $CODCOBOL;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable $NRO
     */
    public function setNRO($NRO) {
        $this->NRO = $NRO;
    }

    /**
     *
     * @param
     *        	mixed a cargar en la variable nrotramitebpmn
     */
    public function setNrotramitebpmn($Nrotramitebpmn) {
        $this->nrotramitebpmn = $Nrotramitebpmn;
    }

}
