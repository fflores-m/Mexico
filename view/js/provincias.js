/*
 * This file is part of FacturaSctipts
 * Copyright (C) 2016  Carlos Garcia Gomez  neorazorx@gmail.com
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
var provincia_list = [
	{value: 'AGUASCALIENTES'},
	{value: 'BAJA CALIFORNIA'},
	{value: 'BAJA CALIFORNIA SUR'},
	{value: 'CAMPECHE'},
	{value: 'CHIAPAS'},
	{value: 'CHIHUAHUA'},
	{value: 'COAHUILA'},
	{value: 'COLIMA'},
	{value: 'DISTRITO FEDERAL'},
	{value: 'DURANGO'},
	{value: 'ESTADO DE MÉXICO'},
	{value: 'GUANAJUATO'},
	{value: 'GUERRERO'},
	{value: 'HIDALGO'},
	{value: 'JALISCO'},
	{value: 'MICHOACÁN'},
	{value: 'MORELOS'},
	{value: 'NAYARIT'},
	{value: 'NUEVO LEÓN'},
	{value: 'OAXACA'},
	{value: 'PUEBLA'},
	{value: 'QUERÉTARO'},
	{value: 'QUINTANA ROO'},
	{value: 'SAN LUIS POTOSÍ'},
	{value: 'SINALOA'},
	{value: 'SONORA'},
	{value: 'TABASCO'},
	{value: 'TAMAULIPAS'},
	{value: 'TLAXCALA'},
	{value: 'VERACRUZ'},
	{value: 'YUCATÁN'},
	{value: 'ZACATECAS'},
];

$(document).ready(function() {
   $("#ac_provincia, #ac_provincia2").autocomplete({
      lookup: provincia_list,
   });
});
