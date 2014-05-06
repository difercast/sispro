<?php

/** 
*
* @Sistema de gestión de reparaciones de equipos informáticos de la empresa Sisprocompu
* @versión: 1.0      @modificado: 23 de marzo del 2014
* @autor: Diego Castillo.
*
*/

class Empresa extends Eloquent
{
	protected $table = "empresas";

   /**
   * Función para validar el Ruc ingresado
   * 
   * @param id ruc
   * @return true->si el ruc es correcto
   **/
   public function validarRuc($strRuc)
   {
      $ruc = $strRuc;
      $digitoProvincia = substr($ruc,0,2);
      $tercerDigito = substr($ruc,2,1);
      $ultimodigito = substr($ruc,9,1);
      $ultimosDigitos = substr($ruc,10,3);
      
      if(strlen($ruc) == 13)
      {
         if($digitoProvincia >=1 && $digitoProvincia <= 24)
         {
            if($tercerDigito < 6 && $ultimosDigitos == 001)
            {
               //Extraemos lo pares
               $par2 = substr($ruc,1,1);
               $par4 = substr($ruc,3,1);
               $par6 = substr($ruc,5,1);
               $par8 = substr($ruc,7,1);
               $sumapares =  $par2 + $par4 + $par6 + $par8;

               //Ectraemos los valores impares
               $impar1 = substr($ruc,0,1);
               $impar1 = $impar1 * 2;
               if($impar1 > 9){ $impar1 = ($impar1 - 9);}
               
               $impar3 = substr($ruc,2,1);
               $impar3 = $impar3 * 2;
               if($impar3 > 9){ $impar3 = ($impar3 - 9);}

               $impar5 = substr($ruc,4,1);
               $impar5 = $impar5 * 2;
               if($impar5 > 9){ $impar5 = ($impar5 - 9);}

               $impar7 = substr($ruc,6,1);
               $impar7 = $impar7 * 2;
               if($impar7 > 9){ $impar7 = ($impar7 - 9);}

               $impar9 = substr($ruc,8,1);
               $impar9 = $impar9 * 2;
               if($impar9 > 9){ $impar9 = ($impar9 - 9);}

               $sumaImpares = $impar1 + $impar3 + $impar5 + $impar7 + $impar9;

               $sumaTotal = $sumaImpares + $sumapares;

               $primerDigito = substr($sumaTotal,0,1);
               $primerDigito = (($primerDigito + 1)* 10);

               $digitoValidador = $primerDigito - $sumaTotal;
               if($digitoValidador == 10)
               {
                  $digitoValidador = 0;
               }

               //Comparamos el digito validador con el último digito de la cédula
               if($digitoValidador == $ultimodigito)
               {
                  return true;
               }
                  
            }
            else
            {
               return false;
            }             
         }
         else
         {
            return false;
         }

      }
      else
         {
            return false;
         }      

   }
	
}