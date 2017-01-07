<?php

/*
 * This file is part of FacturaSctipts
 * Copyright (C) 2015-2016  Carlos Garcia Gomez  neorazorx@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of admin_mexico
 *
 * @author Felipe Flores fflores@balamti.com.mx
 */

require_model('impuesto.php');

/**
 * Description of admin_argentina
 *
 * @author carlos
 */
class admin_mexico extends fs_controller
{
   public $impuestos_ok;
   
   public function __construct()
   {
      parent::__construct(__CLASS__, 'Mexico', 'admin');
   }
   
   protected function private_core()
   {
      $this->check_impuestos();
       $this->traducciones();
      
      if( isset($_GET['opcion']) )
      {
         if($_GET['opcion'] == 'moneda')
         {
            $this->empresa->coddivisa = 'MXN';
            if( $this->empresa->save() )
            {
               $this->new_message('Datos guardados correctamente.');
            }
         }
         else if($_GET['opcion'] == 'pais')
         {
            $this->empresa->codpais = 'MEX';
            if( $this->empresa->save() )
            {
               $this->new_message('Datos guardados correctamente.');
            }
         }
         else if($_GET['opcion'] == 'iva')
         {
            $this->set_impuestos();
         }
      }
      else
      {
         $this->share_extensions();
      }
   }
   
   private function check_impuestos()
   {
      $this->impuestos_ok = FALSE;
      
      $imp0 = new impuesto();
      foreach($imp0->all() as $i)
      {
         if($i->codimpuesto == 'IVA')
         {
            $this->impuestos_ok = TRUE;
            break;
         }
      }
   }
   
   private function set_impuestos()
   {
      /// eliminamos los impuestos que ya existen (los de España)
      $imp0 = new impuesto();
      foreach($imp0->all() as $impuesto)
      {
         $this->desvincular_articulos($impuesto->codimpuesto);
         $impuesto->delete();
      }
      
      /// añadimos los de Mexico
      $codimp = array("IVA","ISR","IEPS");
      $desc = array("16%","30%","35%");
      $recargo = 0;
      $iva = array(16, 30, 35);
      $cant = count($codimp);
      for($i=0; $i<$cant; $i++)
      {
         $impuesto = new impuesto();
         $impuesto->codimpuesto = $codimp[$i];
         $impuesto->descripcion = $desc[$i];
         $impuesto->recargo = $recargo;
         $impuesto->iva = $iva[$i];
         $impuesto->save();
      }
      
      $this->impuestos_ok = TRUE;
      $this->new_message('Impuestos de Mexico añadidos.');
   }
   
   private function desvincular_articulos($codimpuesto)
   {
      $sql = "UPDATE articulos SET codimpuesto = null WHERE codimpuesto = "
              .$this->empresa->var2str($codimpuesto).';';
      
      if( $this->db->table_exists('articulos') )
      {
         $this->db->exec($sql);
      }
   }
   
    public function traducciones()
   {
      $clist = array();
      
      $include = array(          
          'albaran','albaranes', 'cifnif','irpf'
      );
      
      $tradMX = array(
          'recibo', 'recibos', 'R.F.C.', 'I.S.R.' 
      );
      
      $x=0;
      
      foreach($GLOBALS['config2'] as $i => $value)
      {
         if( in_array($i, $include) ){
            $clist[] = array('tradMX' => $tradMX[$x], 'nombre' => $i, 'valor' => $value);
            $x++;
         }
      }
      
      return (array) $clist;
   }
    
   private function share_extensions()
   {
      
   }
}